<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\JawabanMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $dosen = auth()->user()->dosen;
        
        // 1. Ambil daftar tahun yang pernah diinput oleh dosen ini untuk dropdown
        $tahun_list = Setting::where('id_dosen', $dosen->id)
                             ->select('tahun')
                             ->distinct()
                             ->pluck('tahun');

        // 2. Tentukan tahun yang sedang dilihat (dari filter, atau otomatis ambil yang paling baru)
        $selected_tahun = $request->tahun;
        if (!$selected_tahun && $tahun_list->isNotEmpty()) {
            $selected_tahun = Setting::where('id_dosen', $dosen->id)
                                     ->orderBy('updated_at', 'desc')
                                     ->value('tahun');
        }
        
        $aktivitas = Aktivitas::where('slug', 'quiz')->get();
        
        // 3. Ambil settings hanya untuk tahun yang dipilih
        $settings = Setting::where('id_dosen', $dosen->id)
                           ->when($selected_tahun, function($query) use ($selected_tahun) {
                               return $query->where('tahun', $selected_tahun);
                           })
                           ->get()
                           ->keyBy('id_aktivitas');

        return view('dosen.kkm.index', compact('aktivitas', 'settings', 'tahun_list', 'selected_tahun'));
    }

    public function update(Request $request)
    {
        // Tambahkan validasi untuk tahun
        $request->validate([
            'tahun' => 'required|string',
            'kkm' => 'required|array',
            'kkm.*' => 'required|integer|min:0|max:100',
        ]);

        $dosen = auth()->user()->dosen;

        $mahasiswaIds = Mahasiswa::whereHas('kelas', function($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id);
        })->pluck('id');

        // Looping untuk menyimpan KKM baru dan mengupdate riwayat nilai mahasiswa
        foreach ($request->kkm as $id_aktivitas => $nilai_kkm) {
            
            // Simpan KKM ke tabel Setting berdasarkan tahun
            Setting::updateOrCreate(
                [
                    'id_dosen' => $dosen->id,
                    'id_aktivitas' => $id_aktivitas,
                    'tahun' => $request->tahun
                ],
                [
                    'kkm' => $nilai_kkm
                ]
            );

            // Update Otomatis Status Lulus
            if ($mahasiswaIds->isNotEmpty()) {
                JawabanMahasiswa::whereIn('id_mahasiswa', $mahasiswaIds)
                    ->where('id_aktivitas', $id_aktivitas)
                    ->update([
                        'status_lulus' => DB::raw("CASE WHEN skor >= {$nilai_kkm} THEN 1 ELSE 0 END")
                    ]);
            }
        }

        return back()->with('success', 'KKM tahun ajaran ' . $request->tahun . ' berhasil disimpan & diperbarui pada riwayat nilai mahasiswa.');
    }
}