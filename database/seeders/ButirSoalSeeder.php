<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ButirSoalSeeder extends Seeder
{
    public function run(): void
    {
//         $idAktivitas = 17;

//         DB::table('butir_soal')->insert([

//             // 1
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 1,
//                 'pertanyaan' => 'Prinsip utama kerja algoritma Insertion Sort adalah ...',
//                 'pilihan_a' => 'Menukar elemen yang bersebelahan secara berulang',
//                 'pilihan_b' => 'Memilih elemen terkecil dari seluruh kumpulan data',
//                 'pilihan_c' => 'menyisipkan elemen ke posisi yang tepat pada bagian data yang telah terurut',
//                 'pilihan_d' => 'Membagi data menjadi dua bagian yang lebih kecil' ,
//                 'pilihan_e' => 'menggabungkan dua bagian data yang telah terurut menjadi satu kesatuan',
//                 'jawaban_benar' => 'C',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 2
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 2,
//                 'pertanyaan' => '2.	Pada algoritma Insertion Sort, bagian data yang selalu dijaga dalam kondisi terurut adalah ...',
//                 'pilihan_a' => 'Bagian akhir list',
//                 'pilihan_b' => 'Bagian awal list',
//                 'pilihan_c' => 'Bagian tengah list',
//                 'pilihan_d' => 'Seluruh list secara bersamaan',
//                 'pilihan_e' => 'Bagian data yang memiliki nilai terbesar',
//                 'jawaban_benar' => 'B',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 3
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 3,
//                 'pertanyaan' => 'Algoritma Insertion Sort cenderung lebih efisien digunakan pada data yang ...',
//                 'pilihan_a' => 'Berukuran sangat besar',
//                 'pilihan_b' => 'Tersusun secara acak sepenuhnya',
//                 'pilihan_c' => 'Sudah hampir terurut',
//                 'pilihan_d' => 'Berbentuk struktur pohon',
//                 'pilihan_e' => 'Memiliki jumlah elemen yang selalu genap',
//                 'jawaban_benar' => 'C',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 4 (Dragdrop)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'dragdrop',
//                 'nomor' => 4,
//                 'pertanyaan' => "Diberikan data awal:\n
// [8, 3, 5, 2]\n
// Susun hasil data setelah iterasi ke-1 algoritma Insertion Sort (ascending).",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => json_encode([
//                     'source' => [8,3,5,2],
//                     'correct' => [3,8,5,2]
//                 ]),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 5 
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'dragdrop',
//                 'nomor' => 5,
//                 'pertanyaan' => "Diberikan data awal:\n
// [7, 4, 6, 1]\n
// Susun hasil data setelah iterasi ke-1 algoritma Insertion Sort (ascending).",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => json_encode([
//                     'source' => [7,4,6,1],
//                     'correct' => [4,7,6,1]
//                 ]),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 6
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 6,
//                 'pertanyaan' => 'Pada Insertion Sort, elemen pertama dianggap sudah berada pada posisi yang ______.',
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'benar',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 7
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 7,
//                 'pertanyaan' => 'Proses utama pada Insertion Sort adalah melakukan ______ elemen ke posisi yang sesuai.',
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'penyisipan',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 8 (kode)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 8,
//                 'pertanyaan' => "Lengkapilah potongan kode berikut agar proses pergeseran elemen pada Insertion Sort dapat berjalan dengan benar.

// while j >= 0 and data[j] > ______ :
//     data[j+1] = data[j]
//     j = j - 1",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'key',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 9 (kode)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 9,
//                 'pertanyaan' => "Lengkapilah potongan fungsi Insertion Sort berikut.

// def insertion_sort(data):
//     for i in range(1, len(data)):
//         key = data[i]
//         j = i - 1

//         while j >= 0 and data[j] > key:
//             data[j+1] = data[j]
//             j -= 1

//         data[ ______ ] = key",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'j+1',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 10
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'truefalse',
//                 'nomor' => 10,
//                 'pertanyaan' => 'Insertion Sort memiliki kompleksitas waktu O(n²), tetapi dapat bekerja lebih cepat pada data yang hampir terurut.',
//                 'pilihan_a' => 'Benar',
//                 'pilihan_b' => 'Salah',
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'Benar',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//         ]);

//         $idAktivitas = 22;

//         DB::table('butir_soal')->insert([

//             // 1
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 1,
//                 'pertanyaan' => 'Strategi utama yang digunakan oleh algoritma Merge Sort adalah ...',
//                 'pilihan_a' => 'Greedy',
//                 'pilihan_b' => 'Brute Force',
//                 'pilihan_c' => 'Divide and Conquer',
//                 'pilihan_d' => 'Dynamic Programming',
//                 'pilihan_e' => 'Backtracking',
//                 'jawaban_benar' => 'C',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 2
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 2,
//                 'pertanyaan' => 'Proses utama yang menjadi ciri khas Merge Sort adalah ...',
//                 'pilihan_a' => 'Penukaran elemen bersebelahan',
//                 'pilihan_b' => 'Penyisipan elemen ke posisi tertentu',
//                 'pilihan_c' => 'Penggabungan dua sublist yang sudah terurut',
//                 'pilihan_d' => 'Pemilihan elemen minimum dari kumpulan data',
//                 'pilihan_e' => 'Pemindahan elemen terbesar ke posisi akhir secara bertahap',
//                 'jawaban_benar' => 'C',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 3
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'pilgan',
//                 'nomor' => 3,
//                 'pertanyaan' => 'Kompleksitas waktu utama pada algoritma Merge Sort adalah ...',
//                 'pilihan_a' => 'O(n)',
//                 'pilihan_b' => 'O(n²)',
//                 'pilihan_c' => 'O(n log n)',
//                 'pilihan_d' => 'O(log n)',
//                 'pilihan_e' => 'O(1)',
//                 'jawaban_benar' => 'C',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 4 (Dragdrop)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'dragdrop',
//                 'nomor' => 4,
//                 'pertanyaan' => "Diberikan dua sublist yang sudah terurut:\n
// [2, 5] dan [1, 3, 4]\n
// Susun hasil penggabungan (merge) yang benar menjadi satu daftar terurut.",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => json_encode([
//                     'source' => [2,5,1,3,4],
//                     'correct' => [1,2,3,4,5]
//                 ]),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 5 (Dragdrop)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'dragdrop',
//                 'nomor' => 5,
//                 'pertanyaan' => "Diberikan dua sublist terurut:\n
// [3, 8] dan [2, 6]\n
// Susun hasil penggabungan (merge) yang benar.",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => json_encode([
//                     'source' => [3,8,2,6],
//                     'correct' => [2,3,6,8]
//                 ]),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 6
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 6,
//                 'pertanyaan' => 'Proses penggabungan dua sublist terurut pada algoritma Merge Sort disebut tahap ______.',
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'merge',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 7 (kode lengkap)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 7,
//                 'pertanyaan' => "Lengkapilah bagian kode berikut agar pembagian list pada Merge Sort dapat berjalan dengan benar.

// mid = len(data) // 2
// left = data[:______]",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'mid',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 8 (kode lengkap)
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 8,
//                 'pertanyaan' => "Lengkapilah bagian kode penggabungan (merge) berikut.

// while i < len(left) and j < len(right):
//     if left[i] ______ right[j]:
//         result.append(left[i])
//         i += 1
//     else:
//         result.append(right[j])
//         j += 1",
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => '<',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 9
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'essay',
//                 'nomor' => 9,
//                 'pertanyaan' => 'Merge Sort termasuk algoritma pengurutan yang ______ karena tidak mengubah urutan relatif elemen yang bernilai sama.',
//                 'pilihan_a' => null,
//                 'pilihan_b' => null,
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'stabil',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//             // 10
//             [
//                 'id_aktivitas' => $idAktivitas,
//                 'tipe' => 'truefalse',
//                 'nomor' => 10,
//                 'pertanyaan' => 'Merge Sort memiliki kompleksitas waktu yang efisien O(n log n), tetapi membutuhkan memori tambahan untuk proses penggabungan data.',
//                 'pilihan_a' => 'Benar',
//                 'pilihan_b' => 'Salah',
//                 'pilihan_c' => null,
//                 'pilihan_d' => null,
//                 'pilihan_e' => null,
//                 'jawaban_benar' => 'Benar',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],

//         ]);

        $idAktivitas = 24;

        DB::table('butir_soal')->insert([

        // 1
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 1,
            'pertanyaan' => 'Sorting merupakan proses menyusun data berdasarkan kunci tertentu agar data lebih mudah dianalisis dan diproses. Pernyataan yang paling tepat terkait tujuan utama sorting adalah …',
            'pilihan_a' => 'Mempercepat proses pencarian dan pengolahan data',
            'pilihan_b' => 'Menghilangkan data yang tidak diperlukan',
            'pilihan_c' => 'Menambah ukuran data agar lebih lengkap',
            'pilihan_d' => 'Mengamankan data dari kesalahan pengguna',
            'pilihan_e' => 'Menyembunyikan struktur data dari sistem',
            'jawaban_benar' => 'A',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 2
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 2,
            'pertanyaan' => 'Dalam proses sorting, operasi yang paling berpengaruh terhadap efisiensi algoritma adalah …',
            'pilihan_a' => 'Input dan output data',
            'pilihan_b' => 'Perbandingan dan pertukaran elemen',
            'pilihan_c' => 'Penyimpanan data sementara',
            'pilihan_d' => 'Penghapusan elemen duplikat',
            'pilihan_e' => 'Pencetakan hasil pengurutan',
            'jawaban_benar' => 'B',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 3
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 3,
            'pertanyaan' => 'Data yang disusun dari nilai terbesar ke terkecil disebut sebagai urutan …',
            'pilihan_a' => 'Ascending',
            'pilihan_b' => 'Linear',
            'pilihan_c' => 'Rekursif',
            'pilihan_d' => 'Acak',
            'pilihan_e' => 'Descending',
            'jawaban_benar' => 'E',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 4
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 4,
            'pertanyaan' => 'Beberapa algoritma pencarian tidak dapat bekerja tanpa data terurut. Pernyataan ini menunjukkan bahwa sorting berperan penting karena …',
            'pilihan_a' => 'Mengurangi ukuran data',
            'pilihan_b' => 'Menghindari penggunaan perulangan',
            'pilihan_c' => 'Menghilangkan kebutuhan algoritma lain',
            'pilihan_d' => 'Menjadi prasyarat bagi algoritma tertentu seperti Binary Search',
            'pilihan_e' => 'Memperbesar kapasitas penyimpanan data',
            'jawaban_benar' => 'D',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 5
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 5,
            'pertanyaan' => 'Perhatikan data berikut: [5, 1, 4, 2]. Setelah 1 iterasi penuh Bubble Sort (ascending), susunan data menjadi …',
            'pilihan_a' => '[1, 5, 4, 2]',
            'pilihan_b' => '[1, 4, 2, 5]',
            'pilihan_c' => '[5, 1, 2, 4]',
            'pilihan_d' => '[1, 2, 4, 5]',
            'pilihan_e' => '[2, 1, 4, 5]',
            'jawaban_benar' => 'B',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 6
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 6,
            'pertanyaan' => 'Pada algoritma Bubble Sort, kondisi yang menunjukkan bahwa data telah terurut sempurna adalah …',
            'pilihan_a' => 'Jumlah iterasi mencapai n',
            'pilihan_b' => 'Elemen terkecil berada di awal',
            'pilihan_c' => 'Tidak terjadi pertukaran pada satu iterasi',
            'pilihan_d' => 'Semua elemen dibandingkan',
            'pilihan_e' => 'Jumlah data terus berkurang',
            'jawaban_benar' => 'C',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 7
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 7,
            'pertanyaan' => 'Jika terdapat n data, maka dalam satu iterasi Bubble Sort jumlah perbandingan maksimum adalah …',
            'pilihan_a' => 'n',
            'pilihan_b' => 'n - 1',
            'pilihan_c' => 'n²',
            'pilihan_d' => 'n log n',
            'pilihan_e' => 'log n',
            'jawaban_benar' => 'B',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 8
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 8,
            'pertanyaan' => 'Diberikan data [6, 3, 8, 2]. Setelah iterasi pertama Selection Sort (ascending), hasilnya adalah …',
            'pilihan_a' => '[2, 3, 8, 6]',
            'pilihan_b' => '[2, 3, 6, 8]',
            'pilihan_c' => '[3, 6, 8, 2]',
            'pilihan_d' => '[2, 6, 8, 3]',
            'pilihan_e' => '[6, 2, 3, 8]',
            'jawaban_benar' => 'A',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 9
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 9,
            'pertanyaan' => 'Selection Sort hanya melakukan satu kali pertukaran pada setiap siklus. Hal ini menyebabkan algoritma tersebut …',
            'pilihan_a' => 'Lebih cepat dari Merge Sort',
            'pilihan_b' => 'Tidak menggunakan perbandingan',
            'pilihan_c' => 'Memiliki jumlah swap yang relatif sedikit',
            'pilihan_d' => 'Selalu bekerja dalam O(n)',
            'pilihan_e' => 'Tidak memerlukan iterasi',
            'jawaban_benar' => 'C',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 10
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 10,
            'pertanyaan' => 'Kompleksitas waktu Selection Sort pada kondisi best case, average case, dan worst case adalah …',
            'pilihan_a' => 'O(n)',
            'pilihan_b' => 'O(n log n)',
            'pilihan_c' => 'O(log n)',
            'pilihan_d' => 'O(n²)',
            'pilihan_e' => 'O(1)',
            'jawaban_benar' => 'D',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 11
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 11,
            'pertanyaan' => 'Insertion Sort bekerja dengan asumsi bahwa …',
            'pilihan_a' => 'Seluruh data belum terurut',
            'pilihan_b' => 'Elemen terakhir selalu terbesar',
            'pilihan_c' => 'Seluruh data langsung dibandingkan sekaligus',
            'pilihan_d' => 'Data harus berukuran kecil',
            'pilihan_e' => 'Bagian awal data sudah berada dalam kondisi terurut',
            'jawaban_benar' => 'E',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 12
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 12,
            'pertanyaan' => "Perhatikan potongan kode berikut:\n\n

while j >= 0 and data[j] > key:\n    
    data[j+1] = data[j]\n    
    j -= 1\n\n

    Proses ini dilakukan berulang karena …",
            'pilihan_a' => 'Untuk menukar elemen secara langsung',
            'pilihan_b' => 'Untuk mencari nilai minimum',
            'pilihan_c' => 'Untuk memberi ruang penyisipan elemen pada posisi yang tepat',
            'pilihan_d' => 'Untuk menghentikan perulangan',
            'pilihan_e' => 'Untuk membagi data menjadi dua bagian',
            'jawaban_benar' => 'C',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 13
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 13,
            'pertanyaan' => 'Insertion Sort lebih efisien digunakan pada data yang …',
            'pilihan_a' => 'Hampir terurut',
            'pilihan_b' => 'Terbalik sepenuhnya',
            'pilihan_c' => 'Berukuran sangat besar',
            'pilihan_d' => 'Mengandung banyak duplikasi',
            'pilihan_e' => 'Memiliki nilai acak seluruhnya',
            'jawaban_benar' => 'A',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 14
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 14,
            'pertanyaan' => 'Jika terdapat data berukuran besar dan tidak terurut, algoritma yang paling efisien digunakan karena memiliki kompleksitas O(n log n) adalah …',
            'pilihan_a' => 'Bubble Sort',
            'pilihan_b' => 'Selection Sort',
            'pilihan_c' => 'Insertion Sort',
            'pilihan_d' => 'Merge Sort',
            'pilihan_e' => 'Linear Sort',
            'jawaban_benar' => 'D',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 15
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 15,
            'pertanyaan' => 'Merge Sort disebut sebagai algoritma Divide and Conquer karena …',
            'pilihan_a' => 'Mengurutkan data secara langsung',
            'pilihan_b' => 'Menggabungkan data tanpa perbandingan',
            'pilihan_c' => 'Melakukan pertukaran elemen secara berulang',
            'pilihan_d' => 'Menghindari penggunaan rekursi',
            'pilihan_e' => 'Membagi data, mengurutkan secara rekursif, lalu menggabungkannya',
            'jawaban_benar' => 'E',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 16
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 16,
            'pertanyaan' => "Perhatikan potongan kode berikut:\n\n
            
tengah = len(data) // 2\n
bagian_kiri = data[:tengah]\n
bagian_kanan = data[tengah:]\n\n

Pernyataan yang paling tepat mengenai kode tersebut adalah …",
            'pilihan_a' => 'Membagi data menjadi dua sublist',
            'pilihan_b' => 'Menggabungkan dua data',
            'pilihan_c' => 'Mengurutkan data',
            'pilihan_d' => 'Menukar elemen terbesar',
            'pilihan_e' => 'Memindahkan elemen terkecil ke awal',
            'jawaban_benar' => 'A',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 17
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 17,
            'pertanyaan' => 'Mengapa proses pengurutan pada Merge Sort terjadi pada tahap merge, bukan saat pembagian?',
            'pilihan_a' => 'Karena data sudah diurutkan sebelum dibagi',
            'pilihan_b' => 'Karena proses merge tidak menggunakan perbandingan',
            'pilihan_c' => 'Karena pembagian hanya memecah data tanpa mengubah urutan',
            'pilihan_d' => 'Karena pembagian lebih cepat',
            'pilihan_e' => 'Karena merge hanya dilakukan satu kali',
            'jawaban_benar' => 'C',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 18
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 18,
            'pertanyaan' => 'Kelemahan utama Merge Sort dibandingkan algoritma sorting sederhana adalah …',
            'pilihan_a' => 'Tidak stabil',
            'pilihan_b' => 'Tidak menggunakan rekursi',
            'pilihan_c' => 'Membutuhkan waktu lebih lama',
            'pilihan_d' => 'Memerlukan memori tambahan',
            'pilihan_e' => 'Tidak dapat mengurutkan data besar',
            'jawaban_benar' => 'D',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 19
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 19,
            'pertanyaan' => 'Sebuah aplikasi e-commerce harus mengurutkan jutaan data produk secara konsisten dan stabil. Algoritma yang paling tepat digunakan adalah …',
            'pilihan_a' => 'Bubble Sort',
            'pilihan_b' => 'Merge Sort',
            'pilihan_c' => 'Insertion Sort',
            'pilihan_d' => 'Selection Sort',
            'pilihan_e' => 'Sequential Sort',
            'jawaban_benar' => 'B',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // 20
        [
            'id_aktivitas' => $idAktivitas,
            'tipe' => 'pilgan',
            'nomor' => 20,
            'pertanyaan' => 'Seorang mahasiswa mengamati bahwa Merge Sort menggunakan memori lebih besar dibanding Bubble Sort. Berdasarkan analisis kode, penyebab utama kondisi tersebut adalah …',
            'pilihan_a' => 'Banyaknya perbandingan',
            'pilihan_b' => 'Proses pertukaran',
            'pilihan_c' => 'Penggunaan perulangan',
            'pilihan_d' => 'Penggunaan operator logika pada rekursi',
            'pilihan_e' => 'Pembuatan sublist baru saat proses pembagian dan penggabungan',
            'jawaban_benar' => 'E',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    
        ]);
        
    }
}