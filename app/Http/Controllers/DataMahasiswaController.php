<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    /**
     * Menampilkan daftar seluruh mahasiswa yang berada di kelas Dosen terkait.
     */
public function index(Request $request)
    {
        $idDosen = auth()->user()->dosen->id ?? auth()->id();
        $kelases = \App\Models\Kelas::where('id_dosen', $idDosen)->get();

        // Buat query dasar
        $query = Mahasiswa::with(['user', 'kelas'])
            ->whereHas('kelas', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });

        // 1. Logika Filter Pencarian Nama
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                // Catatan: Jika kolom di tabel user Anda bernama 'nama', ganti 'name' menjadi 'nama'
                $q->where('nama', 'like', '%' . $request->search . '%');
                  
            });
        }

        // 2. Logika Filter Berdasarkan Kelas
        if ($request->filled('kelas_id')) {
            $query->where('id_kelas', $request->kelas_id);
        }

        // Eksekusi query
        $mahasiswas = $query->latest()->get();

        return view('dosen.datamahasiswa.index', compact('mahasiswas', 'kelases'));
    }

    /**
     * Mengupdate data mahasiswa (NIM, Angkatan, Kelas).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim'      => 'required|string|max:20',
            'angkatan' => 'required|numeric',
            'id_kelas' => 'required|exists:kelas,id'
        ]);

        $mahasiswa = DataMahasiswa::findOrFail($id);
        
        $mahasiswa->update([
            'nim'      => $request->nim,
            'angkatan' => $request->angkatan,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui!');
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