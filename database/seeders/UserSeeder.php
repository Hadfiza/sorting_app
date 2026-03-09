<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DOSEN
        |--------------------------------------------------------------------------
        */

        $dosenUser = User::create([
            'role' => 'dosen',
            'nama' => 'Rifqi',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
        ]);

        $dosen = Dosen::create([
            'id_user' => $dosenUser->id,
            'nip' => '1987654321',
            'photo' => null
        ]);

        /*
        |--------------------------------------------------------------------------
        | KELAS (WAJIB SEBELUM MAHASISWA)
        |--------------------------------------------------------------------------
        */

        $kelas = Kelas::create([
            'nama_kelas' => 'Struktur Data - A1',
            'id_dosen' => $dosen->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | MAHASISWA
        |--------------------------------------------------------------------------
        */

        $mahasiswaUser = User::create([
            'role' => 'mahasiswa',
            'nama' => 'Fiza',
            'email' => 'fiz@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
        ]);

        Mahasiswa::create([
            'id_user' => $mahasiswaUser->id,
            'id_kelas' => $kelas->id,
            'nim' => '2210131210012',
            'angkatan' => '2022',
            'photo' => null
        ]);
    }
}