<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JawabanMahasiswa;
// use Illuminate\Http\Request;

class JawabanMahasiswaController extends Controller
{

    public function riwayat()
    {
        $riwayat = JawabanMahasiswa::where('id_mahasiswa', auth()->user()->mahasiswa->id)
            ->with('kategoriSoal.materi')
            ->latest()
            ->get();

        return view('nilai.riwayat', compact('riwayat'));
    }

}
