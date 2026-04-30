<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Aktivitas; // TAMBAHKAN INI: Untuk menghitung total aktivitas
use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    /**
     * Menampilkan daftar seluruh mahasiswa yang berada di kelas Dosen terkait.
     */
    public function index(Request $request)
    {
        $idDosen = auth()->user()->dosen->id ?? auth()->id();
        $kelases = Kelas::where('id_dosen', $idDosen)->get();

        // 1. HITUNG TOTAL SELURUH AKTIVITAS DI SISTEM
        $totalAktivitas = Aktivitas::count();

        // Buat query dasar
        $query = Mahasiswa::with(['user', 'kelas'])
            // 2. TAMBAHKAN INI: Hitung jumlah progres yang statusnya 'selesai' per mahasiswa
            ->withCount(['progres as aktivitas_selesai' => function ($query) {
                $query->where('status', 'selesai'); 
            }])
            ->whereHas('kelas', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });

        // 3. Logika Filter Pencarian Nama
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // 4. Logika Filter Berdasarkan Kelas
        if ($request->filled('kelas_id')) {
            $query->where('id_kelas', $request->kelas_id);
        }

        // Eksekusi query
        $mahasiswas = $query->latest()->get();

        // 5. TAMBAHKAN $totalAktivitas KE DALAM COMPACT
        return view('dosen.datamahasiswa.index', compact('mahasiswas', 'kelases', 'totalAktivitas'));
    }
    /**
     * Menghapus mahasiswa dari kelas/sistem.
     */
    public function destroy($id)
    {
        $mahasiswa = DataMahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}