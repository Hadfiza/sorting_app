<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RekapNilaiExport implements FromView, ShouldAutoSize
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $dosen = Dosen::where('id_user', auth()->id())->first();
        $idDosen = $dosen->id ?? null;
        
        // =========================================================
        // KELOMPOKKAN KKM BERDASARKAN TAHUN DAN AKTIVITAS
        // =========================================================
        $semuaSetting = Setting::where('id_dosen', $idDosen)->get();
        $kkmSettingsByYear = [];
        foreach ($semuaSetting as $set) {
            $kkmSettingsByYear[$set->tahun][$set->id_aktivitas] = $set->kkm;
        }

        $query = Mahasiswa::with(['user', 'kelas', 'jawaban', 'pengumpulanPraktikum'])
            ->whereHas('kelas', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });

        if ($this->request->filled('search')) {
            $query->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->request->search . '%')
                  ->orWhere('nama', 'like', '%' . $this->request->search . '%');
            });
        }

        if ($this->request->filled('kelas_id')) {
            $query->where('id_kelas', $this->request->kelas_id);
        }

        $mahasiswas = $query->latest()->get();

        // Ganti compact('kkmSettings') menjadi compact('kkmSettingsByYear')
        return view('dosen.nilai.export_excel', compact('mahasiswas', 'kkmSettingsByYear'));
    }
}