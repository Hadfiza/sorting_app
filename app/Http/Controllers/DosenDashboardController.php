<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DosenDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ambil data dosen berdasarkan id_user
        $dosen = Dosen::where('id_user', $user->id)->first();

        if (!$dosen) {
            abort(403);
        }

        // ambil kelas dosen ini
        $kelasIds = Kelas::where('id_dosen', $dosen->id)->pluck('id');

        $jumlahKelas = $kelasIds->count();

        $jumlahMahasiswa = Mahasiswa::whereIn('id_kelas', $kelasIds)->count();

        return view('dosen.dashboard', [
            'kelas' => $jumlahKelas,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'kkm' => 75
        ]);
    }

    public function setKkm(Request $request)
    {
        $request->validate([
            'kkm' => 'required|integer|min:0|max:100'
        ]);

        // nanti simpan ke database
        // contoh:
        // Setting::updateOrCreate(...)

        return back()->with('success','KKM berhasil diperbarui');
    }
}
