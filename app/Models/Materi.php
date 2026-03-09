<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\KategoriSoal;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{



    public function kategoriSoal()
    {
        return $this->hasOne(KategoriSoal::class, 'id_materi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

}
