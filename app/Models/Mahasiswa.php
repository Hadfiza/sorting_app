<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;


class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'id_user',
        'id_kelas',
        'nim',
        'angkatan',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanMahasiswa::class, 'id_mahasiswa');
    }

    public function pengumpulanPraktikum()
    {
        return $this->hasMany(PengumpulanPraktikum::class, 'id_mahasiswa');
    }

    // public function progres()
    // {
    //     return $this->hasMany(ProgresMahasiswa::class, 'id_mahasiswa');
    // }
}
