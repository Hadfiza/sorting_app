<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Dosen extends Model
{


    protected $table = 'dosen';
    protected $fillable = [
    'id_user',
    'nip',
    'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_dosen');
    }

    public function setting()
    {
        return $this->hasOne(Setting::class, 'id_dosen');
    }
}
