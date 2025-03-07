<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\UjianController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UpikController;
use App\Http\Controllers\JawabanPenggunaController;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserController;

Route::get('/', fn() => view('ujian.index'));
Route::delete('/ujian/{ujian_id}/topik/{topik_id}', [UpikController::class, 'hapusTopik'])->name('ujian.hapusTopik');
Route::resource('ujian', UjianController::class);
Route::resource('topik', TopikController::class);
Route::resource('upik', UpikController::class);
Route::resource('soal', SoalController::class);
Route::get('/ujian/{ujian_id}/soal/{index}', [UjianController::class, 'tampilkanSoal']);
// Route::post('/ujian/simpan-jawaban', [UjianController::class, 'simpanJawaban']);
// Route::post('/ujian/selesai', [UjianController::class, 'selesaiUjian']);
Route::get('/hitung-nilai/{user_id}/{topik_id}', [NilaiController::class, 'hitungNilai']);
Route::get('/soal/topik/{id}', [SoalController::class, 'filterByTopik'])->name('soal.filter');

// Route user soal
Route::prefix('user')->group(function () {
    Route::get('/login', fn() => view('user.auth.login'))->name('soal.login');
    Route::post('/login', [UserController::class, 'loginSoal'])->name('soal.login.post');
    Route::get('/logout-soal', [UserController::class, 'logoutSoal'])->name('soal.logout');


    Route::middleware(['ujian'])->group(function () {
        Route::get('/detail', [SoalController::class, 'ujianDetail'])->name('soal.detail');
        Route::get('/soal/{topik_id}', [SoalController::class, 'ujianMulai'])->name('user.soal.index');
        Route::post('/simpan-jawaban', [UjianController::class, 'simpanJawaban'])->name('soal.simpanJawaban');
        Route::post('/selesai', [UjianController::class, 'selesaiUjian'])->name('soal.selesai');
    });
});

Route::get('/register', [UserController::class, 'create'])->name('user.create');
Route::post('/register', [UserController::class, 'store'])->name('user.store');
