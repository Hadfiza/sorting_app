<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Aktivitas;
use App\Models\ProgresMahasiswa;
use App\Models\JawabanMahasiswa;
use Illuminate\Http\Request;

class DosenDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // 1. Ambil data dosen yang sedang login
        $dosen = Dosen::where('id_user', $user->id)->first();
        if (!$dosen) {
            abort(403);
        }

        // 2. Ambil data kelas milik dosen
        $kelases = Kelas::where('id_dosen', $dosen->id)->get();
        $kelasIds = $kelases->pluck('id');
        $jumlahKelas = $kelases->count();

        // 3. Ambil data ID semua mahasiswa yang diajar dosen ini
        $semuaMahasiswaIds = Mahasiswa::whereIn('id_kelas', $kelasIds)->pluck('id');
        $jumlahMahasiswa = $semuaMahasiswaIds->count();

        // 4. Hitung Metrik Global (Nilai Tertinggi & Progress Tertinggi)
        $totalAktivitas = Aktivitas::count();
        if ($totalAktivitas == 0) $totalAktivitas = 1; // Mencegah pembagian dengan nol

        // A. Progress Tertinggi
        $progresTertinggi = 0;
        // Ambil jumlah aktivitas 'selesai' per mahasiswa
        $progresDataAll = ProgresMahasiswa::whereIn('id_mahasiswa', $semuaMahasiswaIds)
            ->where('status', 'selesai')
            ->selectRaw('id_mahasiswa, count(distinct id_aktivitas) as total')
            ->groupBy('id_mahasiswa')
            ->pluck('total', 'id_mahasiswa');

        if ($progresDataAll->count() > 0) {
            $maxProgresCount = $progresDataAll->max();
            $progresTertinggi = round(($maxProgresCount / $totalAktivitas) * 100);
        }

        // B. Nilai Tertinggi (Berdasarkan skor kuis tertinggi yang pernah didapat)
        $nilaiTertinggi = JawabanMahasiswa::whereIn('id_mahasiswa', $semuaMahasiswaIds)->max('skor') ?? 0;

        // 5. Query Data Mahasiswa untuk Tabel (Bisa difilter)
        $mahasiswaQuery = Mahasiswa::with(['user', 'kelas'])->whereIn('id_kelas', $kelasIds);
        
        if ($request->filled('kelas_id')) {
            $mahasiswaQuery->where('id_kelas', $request->kelas_id);
        }
        
        $mahasiswas = $mahasiswaQuery->get();

        // Menyisipkan persentase progress ke dalam masing-masing object mahasiswa
        foreach ($mahasiswas as $mhs) {
            $completed = $progresDataAll[$mhs->id] ?? 0;
            $mhs->progress_percentage = round(($completed / $totalAktivitas) * 100);
        }

        return view('dosen.dashboard', compact(
            'jumlahKelas', 
            'jumlahMahasiswa', 
            'nilaiTertinggi', 
            'progresTertinggi',
            'kelases',
            'mahasiswas'
        ));
    }
}