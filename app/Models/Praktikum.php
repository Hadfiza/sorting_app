<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    protected $table = 'praktikum';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_soal',
        'batas_waktu',
        'bobot',
        'is_active'
    ];

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class, 'id_aktivitas');
    }
}