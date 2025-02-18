<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Topik;
use App\Models\Soal;
use App\Models\Upik;

class UjianController extends Controller
{
    public function index()
    {
        $ujian = Ujian::all();
        $topik = Topik::all();
        return view('ujian.index', compact('ujian', 'topik'));
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
}
