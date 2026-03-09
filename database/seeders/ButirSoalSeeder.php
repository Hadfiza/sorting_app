<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ButirSoalSeeder extends Seeder
{
    public function run(): void
    {
        // $idAktivitas = 17;

        // DB::table('butir_soal')->insert([

        //     // 1
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 1,
        //         'pertanyaan' => 'Prinsip utama kerja algoritma Insertion Sort adalah ...',
        //         'pilihan_a' => 'Menukar elemen yang bersebelahan secara berulang',
        //         'pilihan_b' => 'Memilih elemen terkecil dari seluruh data',
        //         'pilihan_c' => 'Menyisipkan elemen ke posisi yang tepat pada bagian data yang sudah terurut',
        //         'pilihan_d' => 'Membagi data menjadi dua bagian',
        //         'jawaban_benar' => 'C',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 2
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 2,
        //         'pertanyaan' => 'Pada Insertion Sort, bagian data yang selalu dijaga dalam kondisi terurut adalah ...',
        //         'pilihan_a' => 'Bagian akhir list',
        //         'pilihan_b' => 'Bagian awal list',
        //         'pilihan_c' => 'Bagian tengah list',
        //         'pilihan_d' => 'Seluruh list sekaligus',
        //         'jawaban_benar' => 'B',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 3
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'pilgan',
        //         'nomor' => 3,
        //         'pertanyaan' => 'Insertion Sort cenderung lebih efisien digunakan pada data yang ...',
        //         'pilihan_a' => 'Berukuran sangat besar',
        //         'pilihan_b' => 'Acak sepenuhnya',
        //         'pilihan_c' => 'Sudah hampir terurut',
        //         'pilihan_d' => 'Berbentuk struktur pohon',
        //         'jawaban_benar' => 'C',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 4 (Dragdrop)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'dragdrop',
        //         'nomor' => 4,
        //         'pertanyaan' => "Diberikan data awal:\n[8, 3, 5, 2]\nSusun hasil data setelah iterasi ke-1 algoritma Insertion Sort (ascending).",
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => json_encode([
        //             'source' => [8,3,5,2],
        //             'correct' => [3,8,5,2]
        //         ]),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 5 
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'dragdrop',
        //         'nomor' => 5,
        //         'pertanyaan' => "Diberikan data awal:\n[7, 4, 6, 1]\nSusun hasil data setelah iterasi ke-1 algoritma Insertion Sort (ascending).",
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => json_encode([
        //             'source' => [7,4,6,1],
        //             'correct' => [4,7,6,1]
        //         ]),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 6
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'essay',
        //         'nomor' => 6,
        //         'pertanyaan' => 'Pada Insertion Sort, elemen pertama dianggap sudah berada pada posisi yang ______.',
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'benar',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 7
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'essay',
        //         'nomor' => 7,
        //         'pertanyaan' => 'Proses utama pada Insertion Sort adalah melakukan ______ elemen ke posisi yang sesuai.',
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'penyisipan',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 8 (kode)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'essay',
        //         'nomor' => 8,
        //         'pertanyaan' => "Lengkapilah potongan kode berikut agar proses pergeseran elemen pada Insertion Sort dapat berjalan dengan benar.

        //     while j >= 0 and data[j] > ______ :
        //         data[j+1] = data[j]
        //         j = j - 1",
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'key',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 9 (kode)
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'essay',
        //         'nomor' => 9,
        //         'pertanyaan' => "Lengkapilah potongan fungsi Insertion Sort berikut.

        //     def insertion_sort(data):
        //         for i in range(1, len(data)):
        //             key = data[i]
        //             j = i - 1

        //             while j >= 0 and data[j] > key:
        //                 data[j+1] = data[j]
        //                 j -= 1

        //             data[ ______ ] = key",
        //         'pilihan_a' => null,
        //         'pilihan_b' => null,
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'j+1',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // 10
        //     [
        //         'id_aktivitas' => $idAktivitas,
        //         'tipe' => 'truefalse',
        //         'nomor' => 10,
        //         'pertanyaan' => 'Insertion Sort memiliki kompleksitas waktu O(n²), tetapi dapat bekerja lebih cepat pada data yang hampir terurut.',
        //         'pilihan_a' => 'Benar',
        //         'pilihan_b' => 'Salah',
        //         'pilihan_c' => null,
        //         'pilihan_d' => null,
        //         'jawaban_benar' => 'Benar',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        // ]);

        $idAktivitas = 22;

        DB::table('butir_soal')->insert([

            // 1
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'pilgan',
                'nomor' => 1,
                'pertanyaan' => 'Strategi utama yang digunakan oleh algoritma Merge Sort adalah ...',
                'pilihan_a' => 'Greedy',
                'pilihan_b' => 'Brute Force',
                'pilihan_c' => 'Divide and Conquer',
                'pilihan_d' => 'Dynamic Programming',
                'jawaban_benar' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 2
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'pilgan',
                'nomor' => 2,
                'pertanyaan' => 'Proses utama yang menjadi ciri khas Merge Sort adalah ...',
                'pilihan_a' => 'Penukaran elemen bersebelahan',
                'pilihan_b' => 'Penyisipan elemen ke posisi tertentu',
                'pilihan_c' => 'Penggabungan dua sublist yang sudah terurut',
                'pilihan_d' => 'Pemilihan elemen minimum',
                'jawaban_benar' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 3
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'pilgan',
                'nomor' => 3,
                'pertanyaan' => 'Kompleksitas waktu utama pada algoritma Merge Sort adalah ...',
                'pilihan_a' => 'O(n)',
                'pilihan_b' => 'O(n²)',
                'pilihan_c' => 'O(n log n)',
                'pilihan_d' => 'O(log n)',
                'jawaban_benar' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 4 (Dragdrop)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'dragdrop',
                'nomor' => 4,
                'pertanyaan' => "Diberikan dua sublist yang sudah terurut:\n[2, 5] dan [1, 3, 4]\nSusun hasil penggabungan (merge) yang benar menjadi satu daftar terurut.",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => json_encode([
                    'source' => [2,5,1,3,4],
                    'correct' => [1,2,3,4,5]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 5 (Dragdrop)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'dragdrop',
                'nomor' => 5,
                'pertanyaan' => "Diberikan dua sublist terurut:\n[3, 8] dan [2, 6]\nSusun hasil penggabungan (merge) yang benar.",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => json_encode([
                    'source' => [3,8,2,6],
                    'correct' => [2,3,6,8]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 6
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 6,
                'pertanyaan' => 'Proses penggabungan dua sublist terurut pada algoritma Merge Sort disebut tahap ______.',
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => 'merge',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 7 (kode lengkap)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 7,
                'pertanyaan' => "Lengkapilah bagian kode berikut agar pembagian list pada Merge Sort dapat berjalan dengan benar.

mid = len(data) // 2
left = data[:______]",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => 'mid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 8 (kode lengkap)
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 8,
                'pertanyaan' => "Lengkapilah bagian kode penggabungan (merge) berikut.

while i < len(left) and j < len(right):
    if left[i] ______ right[j]:
        result.append(left[i])
        i += 1
    else:
        result.append(right[j])
        j += 1",
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => '<',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 9
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'essay',
                'nomor' => 9,
                'pertanyaan' => 'Merge Sort termasuk algoritma pengurutan yang ______ karena tidak mengubah urutan relatif elemen yang bernilai sama.',
                'pilihan_a' => null,
                'pilihan_b' => null,
                'pilihan_c' => null,
                'pilihan_d' => null,
                'jawaban_benar' => 'stabil',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 10
            [
                'id_aktivitas' => $idAktivitas,
                'tipe' => 'truefalse',
                'nomor' => 10,
                'pertanyaan' => 'Merge Sort memiliki kompleksitas waktu yang efisien O(n log n), tetapi membutuhkan memori tambahan untuk proses penggabungan data.',
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