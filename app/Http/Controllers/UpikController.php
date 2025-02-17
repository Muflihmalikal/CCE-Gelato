<?php

namespace App\Http\Controllers;

use App\Models\Upik;
use Illuminate\Http\Request;

class UpikController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ujian_id' => 'required|integer|exists:ujian,id',
            'topik_id' => 'required|integer|exists:topik,id',
        ]);

        if (Upik::where('ujian_id', $request->ujian_id)->where('topik_id', $request->topik_id)->exists()) {
            return redirect()->back()->with('error', 'Data topik sudah terdapat pada Ujian, silakan cek kembali.');
        } else {
            Upik::create([
                'ujian_id' => $request->ujian_id,
                'topik_id' => $request->topik_id,
            ]);
            return redirect()->back()->with('success', 'Data Berhasil Ditambhkan');
        }
    }
    public function hapusTopik($ujian_id, $topik_id)
    {
        // Cari data yang sesuai di tabel Upik
        $upik = Upik::where('ujian_id', $ujian_id)->where('topik_id', $topik_id)->first();

        if ($upik) {
            $upik->delete(); // Hapus data
            return redirect()->back()->with('success', 'Topik berhasil dihapus dari ujian.');
        } else {
            return redirect()->back()->with('error', 'Topik tidak ditemukan dalam ujian.');
        }
    }
}
