<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JawabanPengguna;
use App\Models\Soal;
use App\Models\Nilai;

class NilaiController extends Controller
{
    public function hitungNilai($user_id, $topik_id)
    {
        // Ambil semua jawaban user dalam topik tertentu
        $jawabanUser = JawabanPengguna::where('user_id', $user_id)
            ->whereHas('soal', function ($query) use ($topik_id) {
                $query->where('topik_id', $topik_id);
            })->get();

        // Hitung jumlah benar
        $totalSoal = $jawabanUser->count();
        $jawabanBenar = 0;

        foreach ($jawabanUser as $jawaban) {
            $soal = Soal::find($jawaban->soal_id);
            if ($soal && strtolower(trim($jawaban->jawaban)) == strtolower(trim($soal->jawaban_benar))) {
                $jawaban->benar = 1;
                $jawabanBenar++;
            } else {
                $jawaban->benar = 0;
            }
            $jawaban->save();
        }

        // Hitung skor (misalnya 100 untuk semua benar)
        $skor = ($totalSoal > 0) ? round(($jawabanBenar / $totalSoal) * 100) : 0;

        // Simpan skor ke database
        Nilai::updateOrCreate(
            ['user_id' => $user_id, 'topik_id' => $topik_id],
            ['skor' => $skor]
        );

        return response()->json([
            'user_id' => $user_id,
            'topik_id' => $topik_id,
            'total_soal' => $totalSoal,
            'jawaban_benar' => $jawabanBenar,
            'skor' => $skor
        ]);
    }
}
