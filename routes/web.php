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
Route::resource('soal', SoalController::class);
Route::get('/soal/topik/{id}', [SoalController::class, 'filterByTopik'])->name('soal.filter');
Route::post('/jawaban/simpan', [JawabanPenggunaController::class, 'simpanJawaban'])->name('jawaban.simpan');
