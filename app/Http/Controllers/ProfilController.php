<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Aktivitas; 

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil data aktivitas untuk sidebar (dikelompokkan berdasarkan folder)
        $aktivitas = Aktivitas::all()->groupBy('folder');

        // Menggunakan layout yang sesuai dengan role
        $view = ($user->role == 'mahasiswa') ? 'mahasiswa.profil' : 'dosen.profil';
        
        // Kirimkan variabel aktivitas dan materi bersamaan dengan user
        return view($view, compact('user', 'aktivitas'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 1. Update Tabel 'users' (Nama & Email)
        $user->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        // 2. Update Foto di tabel 'mahasiswa' atau 'dosen'
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            
            // Cek apakah mahasiswa atau dosen
            if ($user->role === 'mahasiswa') {
                $profil = $user->mahasiswa; // Relasi hasOne
                $folder = 'profil_mahasiswa';
            } else {
                $profil = $user->dosen; // Relasi hasOne
                $folder = 'profil_dosen';
            }

            if ($profil) {
                // Hapus foto lama jika ada di storage
                if ($profil->foto && Storage::disk('public')->exists($folder . '/' . $profil->foto)) {
                    Storage::disk('public')->delete($folder . '/' . $profil->foto);
                }

                // Simpan foto baru
                $file->storeAs($folder, $nama_file, 'public');
                
                // Update kolom 'foto' di tabel terkait
                $profil->update(['foto' => $nama_file]);
            }
        }

        return back()->with('success', 'Profil dan identitas berhasil diperbarui!');
    }
}