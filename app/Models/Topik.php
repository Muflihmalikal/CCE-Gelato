<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    use HasFactory;

    protected $table = 'topik';
    protected $fillable = ['ujian_id', 'nama_topik', 'batas_waktu', 'acak_soal', 'acak_jawaban'];

    public function ujian()
    {
        return $this->belongsToMany(Ujian::class, 'ujian_topik');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}
