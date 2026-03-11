<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Menampilkan rekapitulasi seluruh nilai mahasiswa (Kuis, Praktikum, Evaluasi)
     */
public function index(Request $request)
    {
        $idDosen = auth()->user()->dosen->id ?? auth()->id();
        
        // Ambil data kelas untuk dropdown filter di view
        $kelases = \App\Models\Kelas::where('id_dosen', $idDosen)->get();

        // Buat query dasar
        $query = Mahasiswa::with(['user', 'kelas', 'jawaban.aktivitas', 'pengumpulanPraktikum'])
            ->whereHas('kelas', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });

        // 1. Logika Filter Pencarian Nama
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Logika Filter Berdasarkan Kelas
        if ($request->filled('kelas_id')) {
            $query->where('id_kelas', $request->kelas_id);
        }

        $mahasiswas = $query->get();

        return view('dosen.nilai.index', compact('mahasiswas', 'kelases'));
    }
}