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
    public function index()
    {
        $dosen = auth()->user()->dosen;
        
        $aktivitas = Aktivitas::where('slug', 'quiz')->get();
        $settings = Setting::where('id_dosen', $dosen->id)->get()->keyBy('id_aktivitas');

        return view('dosen.kkm.index', compact('aktivitas', 'settings'));
    }

    public function update(Request $request)
    {
        // Validasi input berupa array
        $request->validate([
            'kkm' => 'required|array',
            'kkm.*' => 'required|integer|min:0|max:100',
        ]);

        $dosen = auth()->user()->dosen;

        $mahasiswaIds = Mahasiswa::whereHas('kelas', function($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id);
        })->pluck('id');

        // Looping untuk menyimpan KKM baru dan mengupdate riwayat nilai mahasiswa
        foreach ($request->kkm as $id_aktivitas => $nilai_kkm) {
            
            // Simpan KKM ke tabel Setting
            Setting::updateOrCreate(
                [
                    'id_dosen' => $dosen->id,
                    'id_aktivitas' => $id_aktivitas
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

        return back()->with('success', 'Pengaturan KKM berhasil disimpan dan status kelulusan mahasiswa telah diperbarui secara otomatis!');
    }
}