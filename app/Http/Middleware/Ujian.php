<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Ujian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('siswa') || !session()->has('ujian')) {
            return redirect()->route('soal.login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        return $next($request);
    }
}
