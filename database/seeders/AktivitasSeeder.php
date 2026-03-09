<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aktivitas;

class AktivitasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            /*
            |--------------------------------------------------------------------------
            | PENDAHULUAN
            |--------------------------------------------------------------------------
            */
            [
                'nama' => 'Sorting',
                'folder' => 'pendahuluan',
                'slug' => 'sorting',
                'urutan' => 1,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Kompleksitas',
                'folder' => 'pendahuluan',
                'slug' => 'kompleksitas',
                'urutan' => 2,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Quiz Sorting',
                'folder' => 'pendahuluan',
                'slug' => 'quiz',
                'urutan' => 3,
                'tipe' => 'quiz',
                'durasi' => 10,
            ],

            /*
            |--------------------------------------------------------------------------
            | BUBBLE SORT
            |--------------------------------------------------------------------------
            */
            [
                'nama' => 'Materi Bubble Sort',
                'folder' => 'bubble',
                'slug' => 'materi',
                'urutan' => 1,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Simulasi Bubble Sort',
                'folder' => 'bubble',
                'slug' => 'simulasi',
                'urutan' => 2,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Kode Program Bubble Sort',
                'folder' => 'bubble',
                'slug' => 'program',
                'urutan' => 3,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Quiz Bubble Sort',
                'folder' => 'bubble',
                'slug' => 'quiz',
                'urutan' => 4,
                'tipe' => 'quiz',
                'durasi' => 10,
            ],
            [
                'nama' => 'Praktikum Bubble Sort',
                'folder' => 'bubble',
                'slug' => 'praktikum',
                'urutan' => 5,
                'tipe' => 'praktikum',
                'durasi' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | SELECTION SORT
            |--------------------------------------------------------------------------
            */
            [
                'nama' => 'Materi Selection Sort',
                'folder' => 'selection',
                'slug' => 'materi',
                'urutan' => 1,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Simulasi Selection Sort',
                'folder' => 'selection',
                'slug' => 'simulasi',
                'urutan' => 2,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Kode Program Selection Sort',
                'folder' => 'selection',
                'slug' => 'program',
                'urutan' => 3,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Quiz Selection Sort',
                'folder' => 'selection',
                'slug' => 'quiz',
                'urutan' => 4,
                'tipe' => 'quiz',
                'durasi' => 10,
            ],
            [
                'nama' => 'Praktikum Selection Sort',
                'folder' => 'selection',
                'slug' => 'praktikum',
                'urutan' => 5,
                'tipe' => 'praktikum',
                'durasi' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | INSERTION SORT
            |--------------------------------------------------------------------------
            */
            [
                'nama' => 'Materi Insertion Sort',
                'folder' => 'insertion',
                'slug' => 'materi',
                'urutan' => 1,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Simulasi Insertion Sort',
                'folder' => 'insertion',
                'slug' => 'simulasi',
                'urutan' => 2,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Kode Program Insertion Sort',
                'folder' => 'insertion',
                'slug' => 'program',
                'urutan' => 3,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Quiz Insertion Sort',
                'folder' => 'insertion',
                'slug' => 'quiz',
                'urutan' => 4,
                'tipe' => 'quiz',
                'durasi' => 10,
            ],
            [
                'nama' => 'Praktikum Insertion Sort',
                'folder' => 'insertion',
                'slug' => 'praktikum',
                'urutan' => 5,
                'tipe' => 'praktikum',
                'durasi' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | MERGE SORT
            |--------------------------------------------------------------------------
            */
            [
                'nama' => 'Materi Merge Sort',
                'folder' => 'merge',
                'slug' => 'materi',
                'urutan' => 1,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Simulasi Merge Sort',
                'folder' => 'merge',
                'slug' => 'simulasi',
                'urutan' => 2,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Kode Program Merge Sort',
                'folder' => 'merge',
                'slug' => 'program',
                'urutan' => 3,
                'tipe' => 'materi',
                'durasi' => null,
            ],
            [
                'nama' => 'Quiz Merge Sort',
                'folder' => 'merge',
                'slug' => 'quiz',
                'urutan' => 4,
                'tipe' => 'quiz',
                'durasi' => 10,
            ],
            [
                'nama' => 'Praktikum Merge Sort',
                'folder' => 'merge',
                'slug' => 'praktikum',
                'urutan' => 5,
                'tipe' => 'praktikum',
                'durasi' => null,
            ],


        ];

        foreach ($data as $item) {
            Aktivitas::create($item);
        }
    }
}