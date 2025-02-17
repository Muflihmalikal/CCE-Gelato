<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topik;

class TopikController extends Controller
{
    public function index()
    {
        $topik = Topik::all();
        return view('admin.topik.index', compact('topik'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_topik' => 'required|string|max:255',
            'batas_waktu' => 'required|integer',
            'acak_soal' => 'boolean',
            'acak_jawaban' => 'boolean',
        ]);

        Topik::create($request->all());

        return redirect()->route('topik.index')->with('success', 'topik berhasil dibuat.');
    }
    public function update(Request $request, Topik $topik)
    {
        $request->validate([
            'nama_topik' => 'required|string|max:255',
            'batas_waktu' => 'required|integer',
            'acak_soal' => 'boolean',
            'acak_jawaban' => 'boolean',
        ]);

        $topik->update($request->all());
        return redirect()->route('topik.index')->with('success', 'topik berhasil diubah.');
    }
    public function destroy(Topik $topik)
    {
        $topik->delete();
        return redirect()->route('topik.index')->with('success', 'Topik Berhasil dihapus');
    }
}
