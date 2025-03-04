<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Topik;
use App\Models\Soal;
use App\Models\PilihanJawaban;
use App\Models\JawabanPengguna;
use App\Models\Nilai;
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
    // public function tampilkanSoal($ujian_id, $index)
    // {
    //     $ujian = Ujian::findOrFail($ujian_id);
    //     $soal = Soal::where('ujian_id', $ujian_id)->skip($index)->first();

    //     if (!$soal) {
    //         return redirect('/ujian/selesai')->with('error', 'Soal sudah habis.');
    //     }

    //     $totalSoal = Soal::where('ujian_id', $ujian_id)->count();
    //     $waktu_selesai = SupportCarbon::parse($ujian->waktu_selesai)->format('Y-m-d H:i:s');

    //     return view('ujian.soal', compact('soal', 'ujian_id', 'index', 'totalSoal', 'waktu_selesai'));
    // }
    // public function tampilkanSoal($topik_id)
    // {
    //     $soal = Soal::where('topik_id', $topik_id)->with('pilihanJawaban')->get();
    //     return view('ujian.soal', compact('soal', 'topik_id'));
    // }

    public function selesaiUjian(Request $request)
    {
        $siswa = session('siswa');
        $topik_id = $request->topik_id;
        $jawabanPengguna = json_decode($request->jawaban, true);

        if (!$jawabanPengguna) {
            return response()->json([
                'error' => 'error',
                'message' => 'Anda belum menjawab soal apa pun.'
            ], 400);
        }

        foreach ($jawabanPengguna as $soalId => $jawaban) {
            $soal = Soal::find($soalId);
            $benar = false;

            if ($soal) {
                if ($soal->tipe === 'pilihan_ganda') {
                    $pilihanBenar = PilihanJawaban::where('soal_id', $soal->id)->where('benar', 1)->first();
                    $benar = $pilihanBenar && strtolower($pilihanBenar->teks_pilihan) == strtolower(trim($jawaban));
                } elseif ($soal->tipe === 'jawaban_singkat') {
                    $benar = strtolower($soal->jawaban_benar) == strtolower(trim($jawaban));
                }
            }

            JawabanPengguna::updateOrCreate(
                ['pengguna_id' => $siswa->id, 'soal_id' => $soalId],
                ['jawaban' => $jawaban, 'benar' => $benar]
            );
        }

        // Hitung total skor
        $totalSoal = Soal::where('topik_id', $topik_id)->count();
        $jawabanBenar = JawabanPengguna::where('pengguna_id', $siswa->id)->where('benar', true)->count();
        $skor = $totalSoal > 0 ? ($jawabanBenar / $totalSoal) * 100 : 0;

        // Simpan nilai akhir
        Nilai::updateOrCreate(
            ['user_id' => $siswa->id, 'topik_id' => $topik_id],
            ['skor' => $skor]
        );

        return response()->json([
            'success' => 'success',
            'redirect' => route('soal.detail', $topik_id)
        ]);
    }
}
