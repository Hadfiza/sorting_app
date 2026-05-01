<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aktivitas;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil aktivitas (group by folder)
        $aktivitas = Aktivitas::all()->groupBy('folder');

        // Tentukan view berdasarkan role
        $view = ($user->role == 'mahasiswa') ? 'mahasiswa.profil' : 'dosen.profil';

        return view($view, compact('user', 'aktivitas'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update user
        $user->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');
            $nama_file = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();

            // Tentukan role & folder
            if ($user->role === 'mahasiswa') {
                $profil = $user->mahasiswa;
                $folder = 'profil_mahasiswa';
            } else {
                $profil = $user->dosen;
                $folder = 'profil_dosen';
            }

            if ($profil) {

                // Path folder public
                $path = public_path($folder);

                // Buat folder kalau belum ada
                // if (!file_exists($path)) {
                //     mkdir($path, 0777, true);
                // }

                // Hapus foto lama
                if ($profil->foto) {
                    $oldPath = public_path($folder . '/' . $profil->foto);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Simpan file ke public
                $file->move($path, $nama_file);

                // Update database
                $profil->update([
                    'foto' => $nama_file
                ]);
            }
        }

        return back()->with('success', 'Profil dan identitas berhasil diperbarui!');
    }
}