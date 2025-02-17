<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upik extends Model
{
    use HasFactory;

    protected $table = 'ujian_topik';
    protected $fillable = ['ujian_id', 'topik_id'];
}
