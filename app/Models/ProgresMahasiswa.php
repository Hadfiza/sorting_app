<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresMahasiswa extends Model
{
    use HasFactory;

    // Sesuaikan dengan nama tabel di database Anda
    protected $table = 'progres_mahasiswa';

    // Kolom yang boleh diisi secara massal (PENTING: gunakan 'status')
    protected $fillable = [
        'id_mahasiswa',
        'id_aktivitas',
        'status'
    ];

    // Relasi ke tabel aktivitas
    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class, 'id_aktivitas');
    }

    // Relasi ke tabel mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}