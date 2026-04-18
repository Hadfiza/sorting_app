<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'id_dosen',
        'nama_kelas',
        'tahun_ajaran',
        'token'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_kelas');
    }
}
