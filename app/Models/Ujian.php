<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';
    protected $fillable = ['kelas_id', 'judul', 'deskripsi', 'waktu_mulai', 'waktu_selesai', 'token'];

    public function topik()
    {
        return $this->belongsToMany(Topik::class, 'ujian_topik');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_ujian');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ujian) {
            $ujian->token = Str::random(6);
        });
    }
}
