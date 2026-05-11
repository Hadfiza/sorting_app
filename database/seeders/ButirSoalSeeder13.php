<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ButirSoalSeeder extends Seeder
{
    public function run(): void
    {
        // $idAktivitas = 3; 

        // DB::table('butir_soal')->insert([

        //     // 1
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 1,
        //         'pertanyaan' => 'Tujuan utama dari proses sorting dalam struktur data adalah …',
        //         'pilihan_a' => 'Menghapus data yang tidak diperlukan',
        //         'pilihan_b' => 'menyusun data agar lebih mudah dicari dan diproses',
        //         'pilihan_c' => 'mengamankan data di dalam memori komputer',
        //         'pilihan_d' => 'menjumlahkan seluruh nilai dalam suatu daftar data',
        //         'pilihan_e' => 'memperbesar kapasitas penyimpanan data dalam sistem',
        //         'jawaban_benar' => 'B',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 2
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 2,
        //         'pertanyaan' => 'Contoh susunan data yang menunjukkan proses pengurutan secara ascending adalah ...',
        //         'pilihan_a' => '[9, 7, 5, 3]',
        //         'pilihan_b' => '[20, 15, 10, 5]',
        //         'pilihan_c' => '[1, 4, 7, 9]',
        //         'pilihan_d' => '[12, 10, 8, 6]',
        //         'pilihan_e' => '[30, 25, 20, 15]',
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
        //         'pilihan_a' => 'jumlah total elemen yang terdapat pada data',
        //         'pilihan_b' => 'atribut atau nilai yang dijadikan dasar dalam proses pengurutan',
        //         'pilihan_c' => 'indeks pertama yang terdapat pada array',
        //         'pilihan_d' => 'nilai yang selalu ditempatkan pada posisi akhir setelah pengurutan',
        //         'pilihan_e' => 'elemen yang memiliki nilai terbesar dalam kumpulan data',
        //         'jawaban_benar' => 'B',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 4
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 4,
        //         'pertanyaan' => '4.	Jika data [7, 4, 6] diurutkan secara ascending, maka susunan data setelah satu kali pertukaran (swap) pertama adalah ...',
        //         'pilihan_a' => '[7, 4, 6]',
        //         'pilihan_b' => '[4, 7, 6]',
        //         'pilihan_c' => '[4, 6, 7]',
        //         'pilihan_d' => '[6, 4, 7]',
        //         'pilihan_e' => '[7, 6, 4]',
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
        //         'pilihan_e' => 'menyalin data - menghapus data - data terurut   ',
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
        //         'pilihan_e' => null,
        //         'jawaban_benar' => 'descending',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 7 (Essay)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'essay',
        //         'nomor' => 7,
        //         'pertanyaan' => 'Dua operasi utama yang sering dianalisis dalam algoritma sorting adalah __________ dan pertukaran.',
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'pilihan_e' => null,
        //         'jawaban_benar' => 'perbandingan',
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
        //         'pilihan_e' => null,
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
        //         'pilihan_e' => null,
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
        //         'pilihan_e' => null,
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
//                 'pilihan_d' => 'Menggunakan struktur data pohon dalam proses pengurutan',
//                 'pilihan_e' => 'menyisipkan elemen ke posisi yang sesuai pada bagian data yang telah terurut',
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
//                 'pilihan_b' => 'Elemen dengan posisi acak',
//                 'pilihan_c' => 'Elemen Terbesar',
//                 'pilihan_d' => 'Seluruh elemen langsung terurut sempurna',
//                 'pilihan_e' => 'Elemen yang pertama kali dibandingkan',
//                 'jawaban_benar' => 'c',
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
//                 'pilihan_a' => 'Menentukan batas jumlah iterasi pada proses pengurutan',
//                 'pilihan_b' => 'Membandingkan dan menukar elemen bersebelahan',
//                 'pilihan_c' => 'Mengurutkan seluruh elemen list secara langsung tanpa perbandingan',
//                 'pilihan_d' => 'Mencetak hasil pengurutan pada setiap iterasi',
//                 'pilihan_e' => 'Membagi list menjadi dua bagian yang lebih kecil secara otomatis',
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
//                 'pilihan_e' => null,
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
//                 'pilihan_e' => null,
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
//                 'pilihan_e' => null,
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
//                 'pilihan_e' => null,
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
//                 'pilihan_e' => null,
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
//                 'pilihan_e' => null,
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
//                 'pilihan_e' => null,
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
                'pilihan_c' => 'Membagi data menjadi dua bagian yang sama besar',
                'pilihan_d' => 'Mengurutkan data menggunakan rekursi secara penuh',
                'pilihan_e' => 'menyisipkan elemen ke bagian data yang telah terurut',
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
                'pilihan_b' => 'Elemen tengah dari kumpulan data',
                'pilihan_c' => 'Elemen terkecil dari bagian data yang belum terurut',
                'pilihan_d' => 'Elemen terakhir dari kumpulan data',
                'pilihan_e' => 'elemen pertama yang dibandingkan pada se    tiap iterasi    ',
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
                'pilihan_e' => 'O(1)',
                'jawaban_benar' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 4 (Dragdrop)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'dragdrop',
                'nomor' => 4,
                'pertanyaan' => "Diberikan data awal:\n
[7, 3, 5, 2]\n
Susun hasil data setelah iterasi ke-1 algoritma Selection Sort (ascending).",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'pilihan_e' => null,
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
                'pertanyaan' => "Diberikan data awal:\n
[6, 4, 9, 1, 5]\n
Susun hasil data setelah iterasi ke-3 algoritma Selection Sort (descending).",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'pilihan_e' => null,
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
                'pilihan_e' => null,
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
                'pilihan_e' => null,
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
                'pilihan_e' => null,
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
                'pilihan_e' => null,
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
                'pilihan_e' => null,
                'jawaban_benar' => 'Benar',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        
    }
}