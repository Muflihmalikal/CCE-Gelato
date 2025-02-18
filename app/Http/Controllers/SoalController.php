<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Topik;

class SoalController extends Controller
{
    public function index(Request $request)
    {
        $topik = Topik::all();
        $topik_terpilih = $request->topik_id ? Topik::find($request->topik_id) : null;
        $soal = Soal::when($request->topik_id, function ($query, $topik_id) {
            return $query->where('topik_id', $topik_id);
        })->get();

        return view('admin.soal.index', compact('topik', 'topik_terpilih', 'soal'));
    }


    public function filterByTopik($id)
    {
        $topik = Topik::all();
        $soal = Soal::where('topik_id', $id)->get();
        return view('admin.soal.index', compact('soal', 'topik'));
    }

    public function create()
    {
        $topik = Topik::all(); // Ambil semua topik untuk dropdown
        return view('admin.soal.create', compact('topik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topik_id' => 'required|exists:topik,id',
            'teks_soal' => 'required|string',
            'tipe' => 'required|in:pilihan_ganda,jawaban_singkat,essay',
            'jawaban_benar' => 'required|string',
        ]);

        Soal::create([
            'topik_id' => $request->topik_id,
            'teks_soal' => $request->teks_soal,
            'tipe' => $request->tipe,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan');
    }


    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus');
    }
}
