<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil ID Dosen yang sedang login
        $idDosen = auth()->user()->dosen->id ?? auth()->id();
        
        // 2. Ambil data kelas untuk filter
        $kelases = Kelas::where('id_dosen', $idDosen)->get();

        // 3. Panggil relasi 'jawaban' (kuis) dan 'pengumpulanPraktikum'
        $query = Mahasiswa::with(['user', 'kelas', 'jawaban', 'pengumpulanPraktikum'])
            ->whereHas('kelas', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });

        // 4. Logika Pencarian Nama
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        // 5. Logika Filter Kelas
        if ($request->filled('kelas_id')) {
            $query->where('id_kelas', $request->kelas_id);
        }

        // 6. Eksekusi query
        $mahasiswas = $query->latest()->get();

        return view('dosen.nilai.index', compact('mahasiswas', 'kelases'));
    }
}