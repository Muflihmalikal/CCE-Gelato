<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanJawaban extends Model
{
    use HasFactory;

    protected $table = 'pilihan_jawaban';
    protected $fillable = ['soal_id', 'teks_pilihan', 'benar'];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
