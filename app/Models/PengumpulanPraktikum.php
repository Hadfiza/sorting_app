<?php

namespace App\Models;

use App\Models\Praktikum;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class PengumpulanPraktikum extends Model
{
    protected $table = 'pengumpulan_praktikum';

    protected $fillable = [
        'id_praktikum',
        'id_mahasiswa',
        'kode_program',
        'output',
        'penjelasan',
        'nilai',
        'feedback_dosen',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }
}