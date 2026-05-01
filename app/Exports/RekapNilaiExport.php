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
        
        $kkmSettings = Setting::where('id_dosen', $idDosen)->pluck('kkm', 'id_aktivitas')->toArray();

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

        return view('dosen.nilai.export_excel', compact('mahasiswas', 'kkmSettings'));
    }
}