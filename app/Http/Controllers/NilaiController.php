<?php

namespace App\Http\Controllers;

use App\Exports\RekapNilaiExport;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Setting;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Dosen::where('id_user', auth()->id())->firstOrFail();
        $idDosen = $dosen->id;

        $kelases = Kelas::where('id_dosen', $idDosen)->get();

        $settings = Setting::where('id_dosen', $idDosen)->get();

        $kkmSettings = [];
        foreach ($settings as $s) {
            $kkmSettings[$s->tahun][$s->id_aktivitas] = $s->kkm;
        }

        $query = Mahasiswa::with(['user', 'kelas', 'jawaban', 'pengumpulanPraktikum'])
            ->whereHas('kelas', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kelas_id')) {
            $query->where('id_kelas', $request->kelas_id);
        }

        $mahasiswas = $query->latest()->get();

        return view('dosen.nilai.index', compact(
            'mahasiswas',
            'kelases',
            'kkmSettings'
        ));
    }

    public function export(Request $request)
    {
        $namaFile = 'Rekap_Nilai_SortLearn_' . date('Y-m-d_H-i') . '.xlsx';

        return Excel::download(new RekapNilaiExport($request), $namaFile);
    }
}