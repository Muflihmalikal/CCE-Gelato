<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Topik;
use App\Models\Soal;
use App\Models\Upik;
use Illuminate\Support\Carbon as SupportCarbon;

class UjianController extends Controller
{
    public function index()
    {
        $ujian = Ujian::all();
        $topik = Topik::all();
        return view('admin.ujian.index', compact('ujian', 'topik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        Ujian::create($request->all());

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dibuat.');
    }

    public function update(Request $request, Ujian $ujian)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        $ujian->update($request->all());
        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil diubah.');
    }

    public function show($id)
    {
        $ujian = Ujian::with('topik.soal')->findOrFail($id);
        $topiks = Topik::all();
        return view('admin.upik.index', compact('ujian', 'topiks'));
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->route('ujian.index');
    }
    public function tampilkanSoal($ujian_id, $index)
    {
        $ujian = Ujian::findOrFail($ujian_id);
        $soal = Soal::where('ujian_id', $ujian_id)->skip($index)->first();

        if (!$soal) {
            return redirect('/ujian/selesai')->with('error', 'Soal sudah habis.');
        }

        $totalSoal = Soal::where('ujian_id', $ujian_id)->count();
        $waktu_selesai = SupportCarbon::parse($ujian->waktu_selesai)->format('Y-m-d H:i:s');

        return view('ujian.soal', compact('soal', 'ujian_id', 'index', 'totalSoal', 'waktu_selesai'));
    }
}
