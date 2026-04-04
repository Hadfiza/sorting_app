<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            $user = auth()->user();

            if ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            }

            if ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }

            // fallback kalau role tidak dikenali
            Auth::logout();
            return redirect('/login');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!'
        ])->onlyInput('email');
    }


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi Input (Tambahkan validasi token_kelas)
        $request->validate([
            'nama'        => 'required|string|max:255',
            'nim'         => 'required|string|max:20|unique:mahasiswa,nim',
            'angkatan'    => 'required|numeric|min:2000|max:2100',
            'email'       => 'required|email|unique:users,email',
            'token_kelas' => 'required|string|exists:kelas,token', // <-- Pastikan token ada di tabel kelas
            'password'    => 'required|min:6|confirmed'
        ], [
            'email.unique'       => 'Email ini sudah terdaftar.',
            'nim.unique'         => 'NIM ini sudah terdaftar.',
            'token_kelas.exists' => 'Token kelas tidak ditemukan/tidak valid! Silakan minta token yang benar ke Dosen.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // 2. Cari data Kelas berdasarkan token yang diinput
        $kelas = \App\Models\Kelas::where('token', $request->token_kelas)->first();

        // 3. Buat Akun User
        $user = \App\Models\User::create([
            'nama'     => $request->nama, 
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            // 'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role'     => 'mahasiswa'
        ]);

        // 4. Buat Profil Mahasiswa & Masukkan ke Kelas tersebut
        \App\Models\Mahasiswa::create([
            'id_user'  => $user->id,
            'nim'      => $request->nim,
            'angkatan' => $request->angkatan,
            'id_kelas' => $kelas->id, // <-- Otomatis masuk kelas
        ]);

        // 5. Arahkan kembali dengan pesan sukses
        return redirect()->route('login')->with('success', 'Berhasil mendaftar dan tergabung di kelas ' . $kelas->nama_kelas . '! Silakan login.');
    }

    // Show Register Dosen
    public function showRegisterDosen()
    {
        return view('auth.register_dosen');
    }

    public function registerDosen(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip'      => 'required|string|max:50|unique:dosen,nip',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ], [
            'email.unique'       => 'Email ini sudah terdaftar.',
            'nip.unique'         => 'NIP ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // 2. Buat Akun user
        $user = User::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'password' => Hash::make($request->pasword),
            'role'     => 'dosen'
        ]);

        // 3. Buat profil dosen
        Dosen::create([
            'id_user'   => $user->id,
            'nip'   => $request->nip,
        ]);

        // 4. Arahkan kembali ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Berhasil mendaftar sebagai Dosen! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}