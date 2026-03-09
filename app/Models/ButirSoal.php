<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ButirSoal extends Model
{
    protected $table = 'butir_soal';

    protected $fillable = [
        'id_aktivitas',
        'tipe',
        'nomor',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar'
    ];

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class,'id_aktivitas');
    }
}