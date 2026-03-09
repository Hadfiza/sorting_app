<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    protected $table = 'praktikum';

    protected $fillable = [
        'judul',
        'deskripsi',
        'batas_waktu',
        'bobot',
        'is_active'
    ];
}