<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $fillable = ['nama', 'email', 'kata_sandi', 'kelas_id', 'no_wa'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jawabanPengguna()
    {
        return $this->hasMany(JawabanPengguna::class);
    }
}
