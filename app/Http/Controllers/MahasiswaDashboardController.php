<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Mahasiswa;
use App\Models\ProgresMahasiswa;
// use Illuminate\Http\Request;

class MahasiswaDashboardController extends Controller
{

public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')
            ->where('id_user', auth()->id())
            ->first();

        // Ambil aktivitas untuk sidebar
        $aktivitas = Aktivitas::orderBy('folder')
            ->orderBy('urutan')
            ->get()
            ->groupBy('folder');

        // --- MENGHITUNG PROGRES ---
        $totalAktivitas = Aktivitas::count(); // Ambil total semua aktivitas (misal: 24)
        
        $aktivitasSelesai = ProgresMahasiswa::where('id_mahasiswa', $mahasiswa->id)
            ->where('status', 'selesai')
            ->count(); // Hitung yang statusnya 'selesai'

        $progress = 0;
        if ($totalAktivitas > 0) {
            $progress = round(($aktivitasSelesai / $totalAktivitas) * 100);
        }

        return view('mahasiswa.dashboard', [
            'kelas' => $mahasiswa->kelas->nama_kelas,
            'nilai' => $mahasiswa->nilai_akhir,
            'progress' => $progress, // Variabel ini sekarang berisi angka 0 - 100
            'aktivitas' => $aktivitas
        ]);
    }

}
