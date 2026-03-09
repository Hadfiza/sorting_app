<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ButirSoalSeeder extends Seeder
{
    public function run(): void
    {
        // $idAktivitas = 3; // ganti sesuai ID quiz

        // DB::table('butir_soal')->insert([

        //     // 1
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 1,
        //         'pertanyaan' => 'Tujuan utama dari proses sorting dalam struktur data adalah …',
        //         'pilihan_a' => 'Menghapus data yang tidak diperlukan',
        //         'pilihan_b' => 'Menyusun elemen data dalam urutan tertentu',
        //         'pilihan_c' => 'Menghapus elemen yang tidak diperlukan',
        //         'pilihan_d' => 'Menggabungkan elemen data',
        //         'jawaban_benar' => 'B',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 2
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 2,
        //         'pertanyaan' => 'Berikut yang merupakan contoh pengurutan ascending adalah …',
        //         'pilihan_a' => '[9, 7, 5, 3]',
        //         'pilihan_b' => '[20, 15, 10, 5]',
        //         'pilihan_c' => '[1, 4, 7, 9]',
        //         'pilihan_d' => '[12, 10, 8, 6]',
        //         'jawaban_benar' => 'C',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 3
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 3,
        //         'pertanyaan' => 'Dalam proses sorting, sort key adalah…',
        //         'pilihan_a' => 'Jumlah total elemen dalam data',
        //         'pilihan_b' => 'Atribut yang dijadikan dasar pengurutan',
        //         'pilihan_c' => 'Indeks pertama dalam array',
        //         'pilihan_d' => 'Nilai yang selalu disimpan di akhir pengurutan',
        //         'jawaban_benar' => 'B',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 4
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 4,
        //         'pertanyaan' => 'Jika diberikan data [7, 4, 6] dan dilakukan proses Sorting secara ascending, maka susunan data setelah satu kali pertukaran pertama adalah …',
        //         'pilihan_a' => '[7, 4, 6]',
        //         'pilihan_b' => '[4, 7, 6]',
        //         'pilihan_c' => '[4, 6, 7]',
        //         'pilihan_d' => '[6, 4, 7]',
        //         'jawaban_benar' => 'B',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 5
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 5,
        //         'pertanyaan' => 'Urutan langkah utama dalam proses sorting yang benar adalah …',
        //         'pilihan_a' => 'Menukar elemen - Membandingkan elemen - Data terurut',
        //         'pilihan_b' => 'Membandingkan elemen - Data terurut - Menukar elemen',
        //         'pilihan_c' => 'Data terurut - Membandingkan elemen - Menukar elemen',
        //         'pilihan_d' => 'Membandingkan elemen - Menukar elemen - Data terurut',
        //         'jawaban_benar' => 'D',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 6 (Essay)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'essay',
        //         'nomor' => 6,
        //         'pertanyaan' => 'Pengurutan data dari nilai terbesar ke terkecil disebut pengurutan __________.',
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'descending',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 7 (Essay)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'essay',
        //         'nomor' => 7,
        //         'pertanyaan' => 'Dua operasi utama yang sering dianalisis dalam algoritma sorting adalah __________ dan __________.',
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'perbandingan dan pertukaran',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 8 (Dragdrop)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'dragdrop',
        //         'nomor' => 8,
        //         'pertanyaan' => 'Jika terdapat data [5,2,8], setelah 1 swap pertama menjadi...',
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => json_encode([
        //             'source' => [5,2,8],
        //             'correct' => [2,5,8]
        //         ]),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 9 (True False)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'truefalse',
        //         'nomor' => 9,
        //         'pertanyaan' => 'Bubble Sort memiliki kompleksitas ruang O(1) karena tidak membutuhkan memori tambahan.',
        //         'pilihan_a' => 'Benar',
        //         'pilihan_b' => 'Salah',
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'Benar',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 10 (True False)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'truefalse',
        //         'nomor' => 10,
        //         'pertanyaan' => 'Algoritma dengan kompleksitas O(n²) sangat efisien untuk data berukuran besar.',
        //         'pilihan_a' => 'Benar',
        //         'pilihan_b' => 'Salah',
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'Salah',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        // ]);

//         $idAktivitas = 7; 

//         DB::table('butir_soal')->insert([

//             // 1
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 1,
//                 'pertanyaan' => 'Prinsip utama kerja algoritma Bubble Sort adalah ...',
//                 'pilihan_a' => 'Membagi data menjadi dua bagian',
//                 'pilihan_b' => 'Membandingkan elemen yang bersebelahan dan menukarnya jika salah urut',
//                 'pilihan_c' => 'Memilih elemen terkecil lalu memindahkannya ke depan',
//                 'pilihan_d' => 'Menggunakan struktur data pohon',
//                 'jawaban_benar' => 'B',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 2
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 2,
//                 'pertanyaan' => 'Pada Bubble Sort, setelah satu iterasi penuh, elemen yang pasti berada pada posisi yang benar adalah ...',
//                 'pilihan_a' => 'Elemen terkecil',
//                 'pilihan_b' => 'Penamaan dari bahasa Inggris "bubble table"',
//                 'pilihan_c' => 'Elemen acak',
//                 'pilihan_d' => 'Elemen terbesar',
//                 'jawaban_benar' => 'D',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 3 (Kode ditulis langsung, bukan gambar)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 3,
//                 'pertanyaan' => "Perhatikan potongan kode berikut:

// for j in range(0, i):
//     if data[j] > data[j+1]:
//         data[j], data[j+1] = data[j+1], data[j]

// Kode tersebut berfungsi untuk...",
//                 'pilihan_a' => 'Menentukan batas jumlah iterasi',
//                 'pilihan_b' => 'Membandingkan dan menukar elemen bersebelahan',
//                 'pilihan_c' => 'Mengurutkan list secara langsung',
//                 'pilihan_d' => 'Mencetak hasil setiap iterasi',
//                 'jawaban_benar' => 'B',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 4 (Dragdrop Ascending Iterasi 1)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'dragdrop',
//                 'nomor' => 4,
//                 'pertanyaan' => 'Urutkan deret bilangan [4, 2, 5, 1, 6] pada iterasi pertama menggunakan Bubble Sort (Ascending).',
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'jawaban_benar' => json_encode([
//                     'source' => [4,2,5,1,6],
//                     'correct' => [2,4,1,5,6]
//                 ]),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 5 (Dragdrop Descending Iterasi 2 - FIXED DATA)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'dragdrop',
//                 'nomor' => 5,
//                 'pertanyaan' => 'Urutkan deret bilangan [3, 6, 2, 5] pada iterasi kedua menggunakan Bubble Sort (Descending).',
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'jawaban_benar' => json_encode([
//                     'source' => [3,6,2,5],
//                     'correct' => [6,5,3,2]
//                 ]),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 6 (Essay - Swap Manual)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 6,
//                 'pertanyaan' => "Lengkapilah potongan kode berikut agar proses pertukaran (swap) berjalan dengan benar:\n\n

// temp = ______
// data[j] = data[j+1]
// data[j+1] = temp",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'jawaban_benar' => 'data[j]',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 7 (Essay - Operator Ascending)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 7,
//                 'pertanyaan' => "Lengkapilah operator perbandingan berikut agar Bubble Sort mengurutkan data secara ascending:\n\n

// if data[j] ______ data[j+1]:",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'jawaban_benar' => '>',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 8
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'truefalse',
//                 'nomor' => 8,
//                 'pertanyaan' => 'Bubble Sort tetap melakukan perbandingan meskipun data sudah terurut.',
//                 'pilihan_a' => 'Benar',
//                 'pilihan_b' => 'Salah',
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'jawaban_benar' => 'Benar',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 9
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'truefalse',
//                 'nomor' => 9,
//                 'pertanyaan' => 'Bubble Sort sangat efisien untuk data berukuran besar karena memiliki kompleksitas O(n log n).',
//                 'pilihan_a' => 'Benar',
//                 'pilihan_b' => 'Salah',
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'jawaban_benar' => 'Salah',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 10
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 10,
//                 'pertanyaan' => 'Setiap satu kali pemeriksaan seluruh elemen data pada Bubble Sort disebut satu ________.',
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'jawaban_benar' => 'iterasi',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//         ]);


        $idAktivitas = 12; 

        DB::table('butir_soal')->insert([

            // 1
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'pilgan',
                'nomor' => 1,
                'pertanyaan' => 'Prinsip utama algoritma Selection Sort adalah ...',
                'pilihan_a' => 'Menukar elemen yang bersebelahan secara berulang',
                'pilihan_b' => 'Memilih elemen terkecil atau terbesar dari data yang belum terurut dan menempatkannya di posisi yang sesuai',
                'pilihan_c' => 'Membagi data menjadi dua bagian yang sama',
                'pilihan_d' => 'Mengurutkan data menggunakan rekursi',
                'jawaban_benar' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 2
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'pilgan',
                'nomor' => 2,
                'pertanyaan' => 'Pada Selection Sort (ascending), elemen yang dipilih pada setiap iterasi adalah ...',
                'pilihan_a' => 'Elemen terbesar dari seluruh data',
                'pilihan_b' => 'Elemen tengah dari data',
                'pilihan_c' => 'Elemen terkecil dari bagian data yang belum terurut',
                'pilihan_d' => 'Elemen terakhir dari data',
                'jawaban_benar' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 3
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'pilgan',
                'nomor' => 3,
                'pertanyaan' => 'Kompleksitas waktu algoritma Selection Sort adalah ...',
                'pilihan_a' => 'O(n)',
                'pilihan_b' => 'O(log n)',
                'pilihan_c' => 'O(n²)',
                'pilihan_d' => 'O(n log n)',
                'jawaban_benar' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 4 (Dragdrop)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'dragdrop',
                'nomor' => 4,
                'pertanyaan' => "Diberikan data awal:\n[7, 3, 5, 2]\nSusun hasil data setelah iterasi ke-1 algoritma Selection Sort (ascending).",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => json_encode([
                    'source' => [7,3,5,2],
                    'correct' => [2,3,5,7]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 5 (Dragdrop)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'dragdrop',
                'nomor' => 5,
                'pertanyaan' => "Diberikan data awal:\n[6, 4, 9, 1, 5]\nSusun hasil data setelah iterasi ke-3 algoritma Selection Sort (descending).",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => json_encode([
                    'source' => [6,4,9,1,5],
                    'correct' => [9,6,5,1,4]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 6 (Essay)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 6,
                'pertanyaan' => 'Selection Sort dinamakan demikian karena pada setiap iterasi melakukan proses ______ terhadap suatu elemen.',
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => 'seleksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 7 (Essay)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 7,
                'pertanyaan' => 'Jumlah maksimum pertukaran (swap) pada algoritma Selection Sort untuk n data adalah sebanyak ______.',
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => 'n - 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 8 (Essay Kode)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 8,
                'pertanyaan' => "Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\n\nfor i in range(len(data)):\n    ______\n    for j in range(i+1, len(data)):\n        if data[j] < data[min_idx]:\n            min_idx = j\n    data[i], data[min_idx] = data[min_idx], data[i]",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => 'min_idx = i',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 9 (Essay Kode)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 9,
                'pertanyaan' => "Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\n\nfor i in range(len(data)):\n    min_idx = i\n    for j in range(i+1, len(data)):\n        if data[j] ______ data[min_idx]:\n            min_idx = j\n    data[i], data[min_idx] = data[min_idx], data[i]",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => '<',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 10
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'truefalse',
                'nomor' => 10,
                'pertanyaan' => 'Selection Sort melakukan lebih sedikit pertukaran dibanding Bubble Sort, tetapi tetap memiliki kompleksitas waktu O(n²).',
                'pilihan_a' => 'Benar',
                'pilihan_b' => 'Salah',
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => 'Benar',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        
    }
}