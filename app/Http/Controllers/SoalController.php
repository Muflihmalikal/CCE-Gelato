<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Topik;

class SoalController extends Controller
{
    public function index()
    {
        $topik = Topik::all(); // Ambil semua topik
        return view('admin.soal.index', compact('topik'));
    }

    // Ambil data soal berdasarkan ID topik (untuk DataTables)
    public function getSoalByTopik($topik_id)
    {
        $soal = Soal::where('topik_id', $topik_id)->get();
        return response()->json($soal->isEmpty() ? [] : $soal);
    }

    // Simpan soal baru
    public function store(Request $request)
    {
        $request->validate([
            'topik_id' => 'required',
            'pertanyaan' => 'required',
            'tipe_soal' => 'required',
            'jawaban_benar' => 'required'
        ]);

        Soal::create([
            'topik_id' => $request->topik_id,
            'pertanyaan' => $request->pertanyaan,
            'tipe_soal' => $request->tipe_soal,
            'jawaban_benar' => $request->jawaban_benar
        ]);

        return response()->json(['success' => true]);
    }

    // Update soal
    public function update(Request $request, $id)
    {
        $request->validate([
            'topik_id' => 'required',
            'pertanyaan' => 'required',
            'tipe_soal' => 'required',
            'jawaban_benar' => 'required'
        ]);

        $soal = Soal::findOrFail($id);
        $soal->update([
            'topik_id' => $request->topik_id,
            'pertanyaan' => $request->pertanyaan,
            'tipe_soal' => $request->tipe_soal,
            'jawaban_benar' => $request->jawaban_benar
        ]);

        return response()->json(['success' => true, 'message' => 'Soal berhasil diperbarui']);
    }

    // Hapus soal
    public function destroy($id)
    {
        Soal::destroy($id);
        return response()->json(['success' => true]);
    }
}
