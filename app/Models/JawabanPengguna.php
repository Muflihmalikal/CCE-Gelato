<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanPengguna extends Model
{
    use HasFactory;

    protected $table = 'jawaban_pengguna';
    protected $fillable = ['pengguna_id', 'soal_id', 'jawaban', 'benar'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
