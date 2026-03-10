<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
// use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Menampilkan rekapitulasi seluruh nilai mahasiswa (Kuis, Praktikum, Evaluasi)
     */
    public function index()
    {
        // 1. Ambil ID Dosen yang sedang login
        $idDosen = auth()->user()->dosen->id ?? auth()->id();

        // 2. Ambil data mahasiswa yang berada di kelas milik dosen ini.
        // Eager load relasi 'user', 'kelas', dan 'jawaban' agar performa query cepat (N+1 safe).
        $mahasiswas = Mahasiswa::with(['user', 'kelas', 'jawaban.aktivitas', 'PengumpulanPraktikum'])
            ->whereHas('kelas', function ($query) use ($idDosen) {
                $query->where('id_dosen', $idDosen);
            })
            ->get();

        // Catatan: Jika Anda memiliki relasi 'pengumpulan_praktikum' di model Mahasiswa,
        // tambahkan juga ke dalam array with() di atas.

        return view('dosen.nilai.index', compact('mahasiswas'));
    }
}