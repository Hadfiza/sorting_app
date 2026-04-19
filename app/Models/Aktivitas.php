<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    protected $table = 'aktivitas';

    protected $fillable = [
        'nama',
        'folder',
        'slug',
        'urutan',
        'tipe'
    ];

    public function butirSoal()
    {
        return $this->hasMany(ButirSoal::class,'id_aktivitas');
    }

    public function jawabanMahasiswa()
    {
        return $this->hasMany(JawabanMahasiswa::class,'id_aktivitas');
    }

    public function praktikum()
    {
        return $this->hasOne(Praktikum::class, 'id_aktivitas');
    }
}

