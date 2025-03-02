<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Ujian;
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
        $siswa = Pengguna::with('kelas')->where('email', $request->email)->first();
        $ujian = Ujian::with('topik')->where('token', $request->token)->first();
        
        if (!$siswa || !$ujian) {
            return back()->withErrors(['error' => 'Email atau Token salah!']);
        }
        
        session(['siswa' => $siswa, 'ujian' => $ujian]);
        return redirect()->route('soal.detail');
        // dd($siswa, $ujian);
        // return view('user.soal.detail', compact('siswa', 'ujian'));
    }

}
