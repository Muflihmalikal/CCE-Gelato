<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'asal_sekolah' => 'required',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'asal_sekolah' => $request->asal_sekolah
        ]);

        return redirect()->route('kelas.index')->with('success', 'kelas Berhasil ditambahkan');
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'asal_sekolah' => 'required',
        ]);
        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'kelas berhasil diubah.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index');
    }
}
