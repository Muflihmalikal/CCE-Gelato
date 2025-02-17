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

Route::delete('/ujian/{ujian_id}/topik/{topik_id}', [UpikController::class, 'hapusTopik'])->name('ujian.hapusTopik');
Route::resource('ujian', UjianController::class);
Route::resource('topik', TopikController::class);
Route::resource('upik', UpikController::class);
Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
Route::get('/soal/data/{topik_id}', [SoalController::class, 'getSoalByTopik'])->name('soal.data');
Route::post('/soal/tambah', [SoalController::class, 'store'])->name('soal.store');
Route::put('/soal/{id}/update', [SoalController::class, 'update'])->name('soal.update');
Route::delete('/soal/{id}/hapus', [SoalController::class, 'destroy'])->name('soal.destroy');
Route::get('/ujian', [UjianController::class, 'index'])->name('ujian.index');
Route::get('/ujian/{id}', [UjianController::class, 'show'])->name('ujian.show');
Route::post('/jawaban/simpan', [JawabanPenggunaController::class, 'simpanJawaban'])->name('jawaban.simpan');
