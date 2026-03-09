<?php

namespace App\Models;

use App\Models\Aktivitas;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class JawabanMahasiswa extends Model
{
    protected $table = 'jawaban_mahasiswa';

    protected $fillable = [
        'id_mahasiswa',
        'id_aktivitas',
        'skor',
        'status_lulus',
        'attempt',
        'detail_jawaban',
        'waktu_mulai',
        'waktu_selesai'
    ];

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class, 'id_aktivitas');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}