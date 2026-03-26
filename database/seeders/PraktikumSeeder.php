<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PraktikumSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('praktikum')->insert([
            [
                'id_aktivitas' => 8,
                'judul' => 'Bubble Sort',
                'deskripsi' => 'Implementasi algoritma Bubble Sort',
                'batas_waktu' => '2026-03-31 23:59:00',
                'bobot' => 20,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id_aktivitas' => 13,
                'judul' => 'Selection Sort',
                'deskripsi' => 'Implementasi algoritma Selection Sort',
                'batas_waktu' => '2026-04-20 23:59:00',
                'bobot' => 25,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id_aktivitas' => 18,
                'judul' => 'Insertion Sort',
                'deskripsi' => 'Implementasi algoritma Insertion Sort',
                'batas_waktu' => '2026-04-20 23:59:00',
                'bobot' => 25,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            [
                'id_aktivitas' => 23,
                'judul' => 'Merge Sort',
                'deskripsi' => 'Implementasi algoritma Merge Sort',
                'batas_waktu' => '2026-04-20 23:59:00',
                'bobot' => 25,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}