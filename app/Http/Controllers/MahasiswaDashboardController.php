<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Mahasiswa;
// use Illuminate\Http\Request;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')
            ->where('id_user', auth()->id())
            ->firstOrFail();

        // Ambil aktivitas untuk sidebar
        $aktivitas = Aktivitas::orderBy('folder')
            ->orderBy('urutan')
            ->get()
            ->groupBy('folder');

        return view('mahasiswa.dashboard', [
            'kelas' => $mahasiswa->kelas->nama_kelas,
            'nilai' => 0,
            'progress' => 0,
            'aktivitas' => $aktivitas
        ]);
    }

}
