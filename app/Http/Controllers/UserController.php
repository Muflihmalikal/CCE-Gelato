<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Pengguna::all();
        return view('admin.siswa.index', compact('user'));
    }

    public function create()
    {
        return view('user.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        Pengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.create')->with('success', 'Pendaftaran berhasil!');
    }

    public function loginSoal(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'token' => 'required'
        ]);

        // Cek apakah pengguna ada
        $siswa = Pengguna::with('kelas')->where('email', $request->email)->first();
        $ujian = Ujian::with('topik')->where('token', $request->token)->first();

        if (!$siswa || $siswa->kata_sandi !== $request->password) {
            return back()->with('error', 'Email atau Password salah!');
        } elseif (!$ujian) {
            return back()->with('error', 'Token yang Anda masukkan salah!');
        }
        // Cek apakah ujian sudah selesai
        if (now()->greaterThan($ujian->waktu_selesai)) {
            return back()->with('error', 'Ujian sudah berakhir! Anda tidak bisa login kembali.');
        }

        // Cek apakah siswa sudah mengerjakan ujian ini sebelumnya
        $topik = $ujian->topik->first();
        $nilai = Nilai::where('user_id', $siswa->id)->where('topik_id', $topik->id)->first();
        if ($nilai) {
            return back()->with('error', 'Anda sudah menyelesaikan ujian ini dan tidak dapat login kembali.');
        }

        // Cek apakah waktu ujian sudah habis untuk topik ini
        $waktuMulaiKey = "waktu_mulai_{$siswa->id}_{$topik->id}";
        $waktuSelesaiKey = "waktu_selesai_{$siswa->id}_{$topik->id}";

        $waktuMulai = Session::get($waktuMulaiKey);
        if (!$waktuMulai) {
            // Jika baru pertama kali masuk ke topik ini, simpan waktu mulai
            $waktuMulai = Carbon::now();
            Session::put($waktuMulaiKey, $waktuMulai);
        }

        // Hitung kapan waktu selesai
        $waktuSelesai = Carbon::parse($waktuMulai)->addMinutes($topik->batas_waktu);
        Session::put($waktuSelesaiKey, $waktuSelesai);

        if (Carbon::now()->greaterThanOrEqualTo($waktuSelesai)) {
            return back()->with('error', 'Waktu ujian untuk topik ini sudah habis, Anda tidak dapat login kembali.');
        }

        // Simpan sesi login
        session([
            'siswa' => $siswa,
            'ujian' => $ujian,
            $waktuSelesaiKey => $waktuSelesai
        ]);

        return redirect()->route('soal.detail', ['topik_id' => $topik->id]);
    }
    public function logoutSoal(Request $request)
    {
        // Hapus sesi siswa & ujian
        Session::forget(['siswa', 'ujian']);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('soal.login')->with('success', 'Anda telah berhasil logout.');
    }
}
