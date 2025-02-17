<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'asal_sekolah'];

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class);
    }
    public function ujian()
    {
        return $this->belongsToMany(Ujian::class, 'kelas_ujian');
    }
}
