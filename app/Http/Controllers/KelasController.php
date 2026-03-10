<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Tampilkan halaman daftar kelas.
     */
    public function index()
    {
        // Sesuaikan cara pengambilan ID Dosen berdasarkan sistem Auth Anda.
        // Jika login menggunakan tabel User yang berelasi ke Dosen: auth()->user()->dosen->id
        // Jika login langsung menggunakan ID User: auth()->id()
        $idDosen = auth()->user()->dosen->id ?? auth()->id();

        $kelases = Kelas::where('id_dosen', $idDosen)->latest()->get();

        return view('dosen.kelas.index', compact('kelases'));
    }

    /**
     * Simpan kelas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'token'      => 'required|string|max:10|unique:kelas,token',
        ], [
            'token.unique' => 'Token sudah digunakan, silakan ganti token.',
            'nama_kelas.required' => 'Nama kelas wajib diisi.'
        ]);

        $idDosen = auth()->user()->dosen->id ?? auth()->id();

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_dosen'   => $idDosen,
            'token'      => strtoupper($request->token),
        ]);

        return redirect()->route('dosen.kelas.index')
                         ->with('success', 'Kelas berhasil ditambahkan!');
    }

    /**
     * Update nama kelas.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        
        // Proteksi: Pastikan hanya dosen pemilik kelas yang bisa mengedit
        $idDosen = auth()->user()->dosen->id ?? auth()->id();
        if ($kelas->id_dosen != $idDosen) {
            abort(403, 'Anda tidak berhak mengedit kelas ini.');
        }

        $kelas->update([
            'nama_kelas' => $request->nama_kelas
        ]);

        return redirect()->route('dosen.kelas.index')
                         ->with('success', 'Nama kelas berhasil diperbarui!');
    }

    /**
     * Hapus kelas.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        
        // Proteksi: Pastikan hanya dosen pemilik kelas yang bisa menghapus
        $idDosen = auth()->user()->dosen->id ?? auth()->id();
        if ($kelas->id_dosen != $idDosen) {
            abort(403, 'Anda tidak berhak menghapus kelas ini.');
        }

        $kelas->delete();

        return redirect()->route('dosen.kelas.index')
                         ->with('success', 'Kelas berhasil dihapus!');
    }
}