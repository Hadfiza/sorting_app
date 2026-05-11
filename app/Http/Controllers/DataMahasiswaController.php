<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas; // TAMBAHKAN INI: Untuk menghitung total aktivitas
    // use App\Models\DataMahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // [PERUBAHAN] Disesuaikan jika form filter menggunakan 'id_kelas'
        if ($request->filled('id_kelas')) { 
            $query->where('id_kelas', $request->id_kelas);
        }

        // Eksekusi query
        $mahasiswas = $query->latest()->get();

        // 5. TAMBAHKAN $totalAktivitas KE DALAM COMPACT
        return view('dosen.datamahasiswa.index', compact('mahasiswas', 'kelases', 'totalAktivitas'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            // [PERUBAHAN] Memvalidasi 'id_kelas' yang dikirim dari modal
            'id_kelas' => 'required|exists:kelas,id',
            'password' => 'nullable|min:6', 
        ]);

        // 2. Cari Mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);

        // 3. Update Kelas (di tabel mahasiswa)
        $mahasiswa->update([
            // [PERUBAHAN] Menyimpan data menggunakan kolom 'id_kelas'
            'id_kelas' => $request->id_kelas,
        ]);

        // 4. Update Password (di tabel users)
        if ($request->filled('password')) {
            $user = $mahasiswa->user; 
            
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // 5. Kembali dengan pesan sukses
        return back()->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    /**
     * Menghapus mahasiswa dari kelas/sistem.
     */
    public function destroy($id)
    {
        // [PERBAIKAN] Menggunakan model Mahasiswa, bukan DataMahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}