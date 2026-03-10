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
    public function index()
    {
        $idDosen = auth()->user()->dosen->id ?? auth()->id();

        // Ambil mahasiswa beserta relasi user dan kelasnya
        $mahasiswas = Mahasiswa::with(['user', 'kelas'])
            ->whereHas('kelas', function ($query) use ($idDosen) {
                $query->where('id_dosen', $idDosen);
            })
            ->latest()
            ->get();

        // Ambil data kelas dosen ini untuk pilihan di dropdown Edit Modal
        $kelases = Kelas::where('id_dosen', $idDosen)->get();

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