<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';
    protected $fillable = ['topik_id', 'teks_soal', 'tipe', 'jawaban_benar'];

    public function topik()
    {
        return $this->belongsTo(Topik::class);
    }

    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'soal_id');
    }
}
