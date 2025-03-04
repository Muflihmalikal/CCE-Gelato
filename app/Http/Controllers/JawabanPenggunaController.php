<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JawabanPengguna;
use App\Models\PilihanJawaban;
use App\Models\Soal;

class JawabanPenggunaController extends Controller
{
    public function simpanJawaban(Request $request)
    {
        foreach ($request->jawaban as $soal_id => $jawaban) {
            $siswa = session('siswa');
            $soal = Soal::find($soal_id);
            $benar = ($soal->tipe == 'pilihan_ganda') ?
                PilihanJawaban::where('soal_id', $soal_id)->where('benar', true)->first()->teks_pilihan == $jawaban :
                strtolower(trim($soal->jawaban_benar)) == strtolower(trim($jawaban));

            JawabanPengguna::create([
                'pengguna_id' => $siswa->id,
                'soal_id' => $soal_id,
                'jawaban' => $jawaban,
                'benar' => $benar
            ]);
        }

        return redirect()->route('ujian.index')->with('success', 'Jawaban berhasil disimpan');
    }
}
