<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $dosen = Dosen::first();

            Kelas::create([
                'nama_kelas' => 'Struktur Data - A1',
                'id_dosen' => $dosen->id,
                'token' => 'A1STD',
            ]);
    }
}
