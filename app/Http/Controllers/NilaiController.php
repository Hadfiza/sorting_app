<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Dosen; 
use App\Models\Setting; 
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Dosen::where('id_user', auth()->id())->first();
        $idDosen = $dosen->id ?? null;
        
        $kelases = Kelas::where('id_dosen', $idDosen)->get();

        // AMBIL KKM SEBAGAI ARRAY (Kunci = id_aktivitas, Value = KKM)
        $kkmSettings = Setting::where('id_dosen', $idDosen)->pluck('kkm', 'id_aktivitas')->toArray();

        $query = Mahasiswa::with(['user', 'kelas', 'jawaban', 'pengumpulanPraktikum'])
            ->whereHas('kelas', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });

        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kelas_id')) {
            $query->where('id_kelas', $request->kelas_id);
        }

        $mahasiswas = $query->latest()->get();

        // Kirim variabel kkmSettings
        return view('dosen.nilai.index', compact('mahasiswas', 'kelases', 'kkmSettings'));
    }
}