<?php

namespace App\Http\Controllers;

use App\Models\PilihanJawaban;
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
            'jawaban_benar' => 'nullable|string', // hanya diperlukan jika bukan pilihan ganda
            'pilihan' => 'nullable|array', // Array pilihan ganda
            'pilihan.*' => 'required|string', // Setiap pilihan harus berupa string
            'jawaban_benar_index' => 'nullable|integer|min:0|max:3', // Jawaban benar harus salah satu dari 0-3 (A-D)
        ]);

        // Simpan soal terlebih dahulu
        $soal = Soal::create([
            'topik_id' => $request->topik_id,
            'teks_soal' => $request->teks_soal,
            'tipe' => $request->tipe,
            'jawaban_benar' => $request->tipe === 'pilihan_ganda' ? null : $request->jawaban_benar,
        ]);

        // Jika soal tipe pilihan ganda, simpan pilihan jawabannya
        if ($request->tipe === 'pilihan_ganda' && $request->has('pilihan')) {
            foreach ($request->pilihan as $index => $pilihan) {
                PilihanJawaban::create([
                    'soal_id' => $soal->id,
                    'teks_pilihan' => $pilihan,
                    'benar' => ($index == $request->jawaban_benar_index) ? 1 : 0, // Jawaban benar sesuai pilihan yang dipilih user
                ]);
            }
        }

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus');
    }

    public function ujianDetail()
    {
        $siswa = session('siswa');
        $ujian = session('ujian');
        return view('user.soal.detail', compact('siswa', 'ujian'));
    }

    public function ujianMulai($topik_id, $index = 0)
    {
        $siswa = session('siswa');
        $ujian = session('ujian');
        $topik = Topik::with('soal.pilihanJawaban')->findOrFail($topik_id);
        $soal = $topik->soal[$index] ?? null;
        $totalSoal = $topik->soal->count();
        $jawabanPengguna = session("jawaban_{$ujian->id}") ?? [];

        if (!$soal) {
            return redirect()->route('ujian.selesai', $topik_id)->with('error', 'Soal tidak ditemukan.');
        }

        return view('user.soal.index', compact(
            'siswa',
            'topik',
            'soal',
            'index',
            'totalSoal',
            'ujian',
            'jawabanPengguna'
        ));
    }
}
