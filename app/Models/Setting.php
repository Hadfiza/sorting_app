<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Beritahu Laravel nama tabelnya (karena tidak menggunakan plural 'settings')
    protected $table = 'setting';

    protected $fillable = [
        'id_dosen', 
        'id_aktivitas', 
        'kkm'
    ];

    // Opsional: Relasi ke tabel aktivitas jika nanti butuh menampilkan nama kuis
    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class, 'id_aktivitas');
    }
}