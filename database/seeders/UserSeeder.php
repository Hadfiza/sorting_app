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

        // $dosenUser = User::create([
        //     'role' => 'dosen',
        //     'nama' => 'Rifqi',
        //     'email' => 'dosen@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // $dosen = Dosen::create([
        //     'id_user' => $dosenUser->id,
        //     'nip' => '1987654321',
        //     'foto' => null
        // ]);

        /*
        |--------------------------------------------------------------------------
        | KELAS (WAJIB SEBELUM MAHASISWA)
        |--------------------------------------------------------------------------
        */

        // $kelas = Kelas::create([
        //     'nama_kelas' => 'Struktur Data - A1',
        //     'id_dosen' => $dosen->id
        // ]);

        /*
        |--------------------------------------------------------------------------
        | MAHASISWA
        |--------------------------------------------------------------------------
        */

        // $mahasiswaUser = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Fiza',
        //     'email' => 'fiz@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswaUser->id,
        //     'id_kelas' => $kelas->id,
        //     'nim' => '2210131210012',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa2 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Ahmad Fauzi',
        //     'email' => 'ahmad@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa2->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121002',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa3 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Siti Rahma',
        //     'email' => 'siti@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa3->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121003',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa4 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Budi Santoso',
        //     'email' => 'budi@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa4->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121004',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa5 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Dewi Lestari',
        //     'email' => 'dewi@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa5->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121005',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa6 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Andi Pratama',
        //     'email' => 'andi@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa6->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121006',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa7 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Nabila Putri',
        //     'email' => 'nabila@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa7->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121007',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa8 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Rizky Maulana',
        //     'email' => 'rizky@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa8->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121008',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa9 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Aulia Rahman',
        //     'email' => 'aulia@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa9->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121009',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

        // $mahasiswa10 = User::create([
        //     'role' => 'mahasiswa',
        //     'nama' => 'Fajar Hidayat',
        //     'email' => 'fajar@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'email_verified_at' => now(),
        // ]);

        // Mahasiswa::create([
        //     'id_user' => $mahasiswa10->id,
        //     'id_kelas' => 2,
        //     'nim' => '221013121010',
        //     'angkatan' => '2022',
        //     'foto' => null
        // ]);

$mahasiswa11 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Nur Aisyah',
    'email' => 'aisyah@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa11->id,
    'id_kelas' => 3,
    'nim' => '221013121011',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa12 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Muhammad Arif',
    'email' => 'arif@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa12->id,
    'id_kelas' => 3,
    'nim' => '221013121012',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa13 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Rina Oktavia',
    'email' => 'rina@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa13->id,
    'id_kelas' => 3,
    'nim' => '221013121013',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa14 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Dimas Saputra',
    'email' => 'dimas@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa14->id,
    'id_kelas' => 3,
    'nim' => '221013121014',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa15 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Putri Maharani',
    'email' => 'putri@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa15->id,
    'id_kelas' => 3,
    'nim' => '221013121015',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa16 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Yoga Pratama',
    'email' => 'yoga@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa16->id,
    'id_kelas' => 3,
    'nim' => '221013121016',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa17 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Nanda Sari',
    'email' => 'nanda@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa17->id,
    'id_kelas' => 3,
    'nim' => '221013121017',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa18 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Fikri Ramadhan',
    'email' => 'fikri@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa18->id,
    'id_kelas' => 3,
    'nim' => '221013121018',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa19 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Salsa Putri',
    'email' => 'salsa@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa19->id,
    'id_kelas' => 3,
    'nim' => '221013121019',
    'angkatan' => '2022',
    'foto' => null
]);

$mahasiswa20 = User::create([
    'role' => 'mahasiswa',
    'nama' => 'Reza Maulana',
    'email' => 'reza@gmail.com',
    'password' => Hash::make('123456'),
    'email_verified_at' => now(),
]);

Mahasiswa::create([
    'id_user' => $mahasiswa20->id,
    'id_kelas' => 3,
    'nim' => '221013121020',
    'angkatan' => '2022',
    'foto' => null
]);


    }
}