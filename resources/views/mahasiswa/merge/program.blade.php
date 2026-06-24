@extends('layouts.hlmns')

@section('title','Kode Program Merge Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/merge.css') }}">
@endsection

@section('content')

@php
    // Mengecek apakah materi ini sudah pernah diselesaikan
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

<style>
/* =========================
   CODEMIRROR
========================= */

.live-editor {
    width: 100%;
    height: 500px;
    background: #1e1e1e;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    margin-top: 20px;
}

/* Header */
.live-editor .editor-header {
    padding: 10px 20px;
    background: #2d2d2d;
    border-bottom: 1px solid #444;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
}

.live-editor .editor-header h1 {
    margin: 0;
    font-size: 1rem;
}

/* Split layout */
.live-editor .split-container {
    display: flex;
    flex: 1;
    overflow: hidden;
}

/* Panel kiri */
.live-editor .panel-left {
    flex: 6;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #444;
}

/* Panel kanan */
.live-editor .panel-right {
    flex: 4;
    display: flex;
    flex-direction: column;
    background: #101010;
}

/* Label */
.live-editor .panel-label {
    background: #333;
    color: #ccc;
    padding: 5px 15px;
    font-size: 0.75rem;
    text-transform: uppercase;
}

/* CodeMirror */
.live-editor .CodeMirror {
    flex: 1;
    font-size: 14px;
}

/* Output */
.live-editor #output {
    flex: 1;
    padding: 15px;
    color: #00ff00;
    font-family: 'Courier New', monospace;
    white-space: pre-wrap;
    overflow-y: auto;
    font-size: 13px;
}

/* Run button */
.live-editor .btn-run {
    padding: 5px 15px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
}

/* === KODE TAMBAHAN DARI AI MULAI: CSS INPUT KODE === */
.code-input {
    background: #2d2d2d;
    border: 1px solid #555;
    color: #569cd6; 
    font-family: 'Courier New', monospace;
    padding: 2px 6px;
    border-radius: 4px;
    outline: none;
    font-size: 14px;
    transition: 0.3s ease;
}

.code-input:focus {
    border-color: #007acc;
    background: #1e1e1e;
}

.code-input.correct {
    border-color: #28a745 !important;
    background: rgba(40, 167, 69, 0.2) !important;
    color: #28a745;
}

.code-input.wrong {
    border-color: #dc3545 !important;
    background: rgba(220, 53, 69, 0.2) !important;
    color: #dc3545;
}

/* Tambahan CSS Khusus untuk Tab Pills agar lebih estetik */
.nav-pills .nav-link {
    color: #495057;
    background-color: transparent;
    transition: all 0.3s ease;
}
.nav-pills .nav-link:hover {
    background-color: #e9ecef;
}
.nav-pills .nav-link.active {
    background-color: #0d6efd;
    color: white;
    box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
}
</style>

<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma MergeSort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program MergeSort</span>
            </div>


            <ul class="nav nav-pills nav-fill gap-2 p-1 bg-light rounded-pill border shadow-sm" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill fw-bold" id="pills-list-tab" data-bs-toggle="pill" data-bs-target="#pills-list" type="button" role="tab" aria-controls="pills-list" aria-selected="true">
                        <i class="bi bi-1-circle me-1"></i> 1. Contoh List Angka
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill fw-bold" id="pills-dict-tab" data-bs-toggle="pill" data-bs-target="#pills-dict" type="button" role="tab" aria-controls="pills-dict" aria-selected="false">
                        <i class="bi bi-2-circle me-1"></i> 2. Contoh List of Dictionary
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="card-body materi-text pt-2">
                
            <div class="tab-content" id="pills-tabContent">
                
                <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">

                <div class="my-4 text-start">
                    <div class="alert alert-warning mb-3">
                        <strong>Instruksi:</strong> Amati kode berikut dengan saksama,
                        kemudian ketik ulang pada fitur <em>Live Coding</em> di bawah tanpa melakukan copy–paste.
                    </div>

                    <div class="code-container">
<pre class="code-box">
 1  def merge_sort(data):
 2      if len(data) > 1:
 3          tengah = len(data) // 2
 4          bagian_kiri = data[:tengah]
 5          bagian_kanan = data[tengah:]
 6
 7          # Rekursi
 8          merge_sort(bagian_kiri)
 9          merge_sort(bagian_kanan)
10
11          i = j = k = 0
12
13          # Proses Penggabungan (Merge)
14          while i < len(bagian_kiri) and j < len(bagian_kanan):
15              if bagian_kiri[i] < bagian_kanan[j]:
16                  data[k] = bagian_kiri[i]
17                  i += 1
18              else:
19                  data[k] = bagian_kanan[j]
20                  j += 1
21              k += 1
22
23          # Memasukkan sisa elemen kiri
24          while i < len(bagian_kiri):
25              data[k] = bagian_kiri[i]
26              i += 1
27              k += 1
28
29          # Memasukkan sisa elemen kanan
30          while j < len(bagian_kanan):
31              data[k] = bagian_kanan[j]
32              j += 1
33              k += 1
34
35          print(f"Hasil sementara: {data}")
36
37  angka = [38, 27, 43, 3, 9, 82, 10]
38  print("Sebelum sorting:", angka)
39  merge_sort(angka)
40  print("Setelah sorting:", angka)
</pre>
                </div>
            </div>
            
<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanMerge">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="mergePenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 1, fungsi merge_sort() didefinisikan dengan parameter data. Parameter ini berisi kumpulan data yang akan diurutkan menggunakan algoritma Merge Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan2">
                2) Kondisi Rekursi dan Pembagian Data
            </button>
        </h2>
        <div id="mergePenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 2–5, dilakukan pengecekan apakah jumlah elemen dalam list lebih dari satu. Jika kondisi terpenuhi, data akan dibagi menjadi dua bagian, yaitu bagian_kiri dan bagian_kanan. Proses pembagian ini merupakan tahap divide pada algoritma Merge Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan3">
                3) Proses Rekursi
            </button>
        </h2>
        <div id="mergePenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 7–9, fungsi merge_sort() dipanggil kembali untuk mengurutkan bagian_kiri dan bagian_kanan. Proses ini dilakukan secara rekursif hingga setiap bagian hanya berisi satu elemen.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan4">
                4) Inisialisasi Variabel Indeks
            </button>
        </h2>
        <div id="mergePenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 11, variabel i, j, dan k diinisialisasi dengan nilai 0. Variabel i digunakan untuk menelusuri bagian_kiri, variabel j untuk menelusuri bagian_kanan, dan variabel k untuk menentukan posisi penyimpanan hasil penggabungan pada list utama.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan5">
                5) Proses Penggabungan (Merge)
            </button>
        </h2>
        <div id="mergePenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 13–21, dilakukan proses penggabungan dua bagian data yang telah terurut. Elemen pada bagian_kiri dan bagian_kanan dibandingkan satu per satu, kemudian nilai yang lebih kecil ditempatkan ke dalam list utama. Setelah elemen dipindahkan, indeks yang sesuai akan bertambah untuk melanjutkan proses perbandingan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan6">
                6) Memasukkan Sisa Elemen Bagian Kiri
            </button>
        </h2>
        <div id="mergePenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 23–27, apabila masih terdapat elemen yang tersisa pada bagian_kiri setelah proses penggabungan selesai, seluruh elemen tersebut akan dipindahkan ke dalam list utama.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan7">
                7) Memasukkan Sisa Elemen Bagian Kanan
            </button>
        </h2>
        <div id="mergePenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 29–33, apabila masih terdapat elemen yang tersisa pada bagian_kanan, seluruh elemen tersebut akan dipindahkan ke dalam list utama sehingga seluruh data berhasil digabungkan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan8">
                8) Menampilkan Hasil Sementara
            </button>
        </h2>
        <div id="mergePenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 35, kondisi data ditampilkan setelah proses penggabungan selesai dilakukan. Hal ini bertujuan untuk memperlihatkan perkembangan hasil pengurutan pada setiap tahap Merge Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan9">
                9) Menyiapkan Data yang Akan Diurutkan
            </button>
        </h2>
        <div id="mergePenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 37, didefinisikan sebuah list bernama angka yang berisi data [38, 27, 43, 3, 9, 82, 10]. Data ini digunakan sebagai contoh dalam proses pengurutan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan10">
                10) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="mergePenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 38, data ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal elemen dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan11">
                11) Memanggil Fungsi Merge Sort
            </button>
        </h2>
        <div id="mergePenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 39, fungsi merge_sort(angka) dipanggil untuk menjalankan proses pengurutan menggunakan algoritma Merge Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergePenjelasan12">
                12) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="mergePenjelasan12" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMerge">
            <div class="accordion-body">
                Pada baris 40, data ditampilkan kembali setelah proses pengurutan selesai sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>

            </div>

            <div class="tab-pane fade" id="pills-dict" role="tabpanel" aria-labelledby="pills-dict-tab">
                    
                    {{-- <div class="my-4 text-start">
                        <div class="alert alert-info mb-3">
                            <strong>Perhatian:</strong> Di dunia nyata, data seringkali berbentuk kumpulan kamus (Dictionary). Perhatikan bagaimana algoritma dimodifikasi agar bisa mengurutkan data berdasarkan kunci (key) tertentu.
                    </div> --}}

                    <div class="code-container">
<pre class="code-box">
 1  def merge_sort_dict(arr, key="value"):
 2      if len(arr) > 1:
 3          mid = len(arr) // 2
 4          left_half = arr[:mid]
 5          right_half = arr[mid:]
 6
 7          # Rekursif sorting
 8          merge_sort_dict(left_half, key)
 9          merge_sort_dict(right_half, key)
10
11          i = j = k = 0
12
13          # Merge proses
14          while i < len(left_half) and j < len(right_half):
15              if left_half[i][key] < right_half[j][key]:
16                  arr[k] = left_half[i]
17                  i += 1
18              else:
19                  arr[k] = right_half[j]
20                  j += 1
21              k += 1
22
23          # Sisa elemen dari left half
24          while i < len(left_half):
25              arr[k] = left_half[i]
26              i += 1
27              k += 1
28
29          # Sisa elemen di kanan
30          while j < len(right_half):
31              arr[k] = right_half[j]
32              j += 1
33              k += 1
34
35  # Contoh data
36  data = [
37      {"value": 6},
38      {"value": 5},
39      {"value": 12},
40      {"value": 10},
41      {"value": 9},
42      {"value": 1}
43  ]
44
45  print("Sebelum diurutkan:", data)
46  merge_sort_dict(data)
47  print("Setelah diurutkan:", data)
</pre>
                    </div>

<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanMergeDict">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="mergeDictPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 1, fungsi merge_sort_dict() didefinisikan dengan parameter arr dan key. Parameter arr berisi kumpulan data dalam bentuk List of Dictionary, sedangkan parameter key digunakan untuk menentukan atribut yang menjadi dasar pengurutan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan2">
                2) Kondisi Rekursi dan Pembagian Data
            </button>
        </h2>
        <div id="mergeDictPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 2–5, dilakukan pengecekan apakah jumlah elemen dalam arr lebih dari satu. Jika kondisi terpenuhi, data dibagi menjadi dua bagian, yaitu left_half dan right_half.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan3">
                3) Proses Rekursi
            </button>
        </h2>
        <div id="mergeDictPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 8–9, fungsi merge_sort_dict() dipanggil kembali untuk mengurutkan left_half dan right_half. Proses ini dilakukan secara rekursif hingga setiap bagian data menjadi lebih kecil dan mudah digabungkan kembali.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan4">
                4) Inisialisasi Variabel Indeks
            </button>
        </h2>
        <div id="mergeDictPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 11, variabel i, j, dan k diinisialisasi dengan nilai 0. Variabel i digunakan untuk menelusuri left_half, j untuk menelusuri right_half, dan k untuk menentukan posisi data pada list utama arr.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan5">
                5) Proses Penggabungan Berdasarkan Key
            </button>
        </h2>
        <div id="mergeDictPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 14–21, dilakukan proses penggabungan dua bagian data yang telah diurutkan. Nilai pada left_half[i][key] dibandingkan dengan right_half[j][key]. Data dengan nilai lebih kecil akan dimasukkan terlebih dahulu ke dalam arr.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan6">
                6) Memasukkan Sisa Elemen dari Bagian Kiri
            </button>
        </h2>
        <div id="mergeDictPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 24–27, apabila masih terdapat elemen yang tersisa pada left_half, elemen tersebut akan dimasukkan ke dalam arr.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan7">
                7) Memasukkan Sisa Elemen dari Bagian Kanan
            </button>
        </h2>
        <div id="mergeDictPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 30–33, apabila masih terdapat elemen yang tersisa pada right_half, elemen tersebut akan dimasukkan ke dalam arr.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan8">
                8) Menyiapkan Data
            </button>
        </h2>
        <div id="mergeDictPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 35–43, didefinisikan data dalam bentuk List of Dictionary. Setiap dictionary memiliki atribut "value" yang digunakan sebagai dasar pengurutan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan9">
                9) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="mergeDictPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 45, data ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal data dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan10">
                10) Memanggil Fungsi Merge Sort
            </button>
        </h2>
        <div id="mergeDictPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 46, fungsi merge_sort_dict(data) dipanggil untuk menjalankan proses pengurutan. Karena parameter key memiliki nilai default "value", maka pengurutan dilakukan berdasarkan atribut tersebut.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mergeDictPenjelasan11">
                11) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="mergeDictPenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanMergeDict">
            <div class="accordion-body">
                Pada baris 47, data ditampilkan kembali setelah proses pengurutan selesai sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>

                    </div>
                    </div>

        </div></div></div>
    </div>

    <div class="card mb-4 materi-box mt-4" id="fillCodeActivity">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fas fa-keyboard"></i>
                <span class="materi-badge">Aktivitas 3.1: Melengkapi Kode Program</span>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-outline-primary btn-sm"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#instruksiKode"
                        aria-expanded="false">
                    <i class="fas fa-info-circle me-1"></i>
                    Instruksi Pengerjaan
                </button>

                <div class="collapse mt-2" id="instruksiKode">
                    <div class="alert alert-primary mb-0">
                        <ol class="mb-0 ps-3">
                            <li>Lengkapi seluruh bagian kode yang masih kosong.</li>
                            <li>Perhatikan kembali materi Bubble Sort pada bagian atas halaman.</li>
                            <li>Klik tombol <strong>Periksa Kode</strong> untuk memeriksa jawaban.</li>
                            <li>Jika ingin mengulang, klik tombol <strong>Reset</strong>.</li>
                            <li>Semua bagian harus benar untuk membuka akses selanjutnya.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="code-container" style="background: #1e1e1e; padding: 20px; border-radius: 8px; color: #d4d4d4; font-family: 'Courier New', monospace; font-size: 14px; line-height: 2;">
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">merge_sort</span>(data):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> <span style="color: #dcdcaa;">len</span>(data) > <span style="color: #b5cea8;">1</span>:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tengah = <span style="color: #dcdcaa;">len</span>(data) <input type="text" id="m_blank1" class="code-input" placeholder="..." style="width: 40px; text-align: center;" class="code-input {{ $isSelesai ? 'correct' : '' }}" value="{{ $isSelesai ? '//' : '' }}" {{ $isSelesai ? 'readonly' : '' }}> <span style="color: #b5cea8;">2</span> <span style="color: #6a9955;"># Pembagian bulat untuk mencari tengah</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bagian_kiri = data[:tengah]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bagian_kanan = data[tengah:]<br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;merge_sort(bagian_kiri)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;merge_sort(bagian_kanan)<br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i = j = k = <span style="color: #b5cea8;">0</span><br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">while</span> i < <span style="color: #dcdcaa;">len</span>(bagian_kiri) <span style="color: #c586c0;">and</span> j < <span style="color: #dcdcaa;">len</span>(bagian_kanan):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> bagian_kiri[i] <input type="text" id="m_blank2" class="code-input" placeholder="..." style="width: 40px; text-align: center;" class="code-input {{ $isSelesai ? 'correct' : '' }}" value="{{ $isSelesai ? '<' : '' }}" {{ $isSelesai ? 'readonly' : '' }}> bagian_kanan[j]: <span style="color: #6a9955;"># Bandingkan elemen (Ascending)</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[k] = <input type="text" id="m_blank3" class="code-input" placeholder="..." style="width: 120px;" class="code-input {{ $isSelesai ? 'correct' : '' }}" value="{{ $isSelesai ? 'bagian_kiri[i]' : '' }}" {{ $isSelesai ? 'readonly' : '' }}> <span style="color: #6a9955;"># Masukkan dari bagian kiri</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i += <span style="color: #b5cea8;">1</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">else</span>:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[k] = bagian_kanan[j]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;j += <span style="color: #b5cea8;">1</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;k += <span style="color: #b5cea8;">1</span><br>
            </div>

            <div id="fillCodeFeedback" class="alert {{ $isSelesai ? 'alert-success' : 'd-none' }} mt-3">
                @if($isSelesai)
                    <i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Anda sangat tepat. Aktivitas selanjutnya telah dibuka. Silakan coba kode ini pada Live Editor di bawah!
                @endif
            </div>
            
            <div class="text-center mt-3">
                <button id="btnCheckCode"
                        class="btn btn-primary"
                        {{ $isSelesai ? 'disabled' : '' }}>
                    {{ $isSelesai ? 'Kode Sudah Benar' : 'Periksa Kode' }}
                </button>

                <button id="btnResetCode"
                        class="btn btn-outline-secondary ms-2"
                        {{ $isSelesai ? 'disabled' : '' }}>
                    Reset
                </button>
            </div>

        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body materi-text">
            <p>Jalankan kode program Merge Sort di bawah ini untuk mengamati bagaimana Python memproses data.</p>
          
            <div class="live-editor">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        <button id="runBtn" class="btn-run" disabled>▶ Run Code</button>
                    </div>
                </header>
                <div class="split-container">
                    <div class="panel-left">
                        <div class="panel-label">Input Kode</div>
                        <textarea id="code"></textarea>
                    </div>

                    <div class="panel-right">
                        <div class="panel-label">Console Output</div>
                        <div id="output"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','simulasi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','quiz']) }}" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       id="btnNextMerge" 
       @if(!$isSelesai) tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;" @endif>
       Lanjut Quiz
    </a>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCheckCode = document.getElementById('btnCheckCode');
    const feedbackCode = document.getElementById('fillCodeFeedback');
    const btnNext = document.getElementById('btnNextMerge');
    // const lockIcon = document.getElementById('lockIconMerge');

    btnCheckCode.addEventListener('click', function() {
        // Ambil nilai input
        const b1 = document.getElementById('m_blank1').value.trim(); // Jawaban: //
        const b2 = document.getElementById('m_blank2').value.trim(); // Jawaban: <
        const b3 = document.getElementById('m_blank3').value.trim(); // Jawaban: bagian_kiri[i]

        let correctCount = 0;

        // Validasi Blank 1 (Pembagian Bulat)
        if (b1 === '//') {
            document.getElementById('m_blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('m_blank1').className = 'code-input wrong';
        }

        // Validasi Blank 2 (Operator Perbandingan)
        if (b2 === '<') {
            document.getElementById('m_blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('m_blank2').className = 'code-input wrong';
        }

        // Validasi Blank 3 (Variabel Kiri)
        if (b3 === 'bagian_kiri[i]') {
            document.getElementById('m_blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('m_blank3').className = 'code-input wrong';
        }

        // Output Feedback
        if (correctCount === 3) {
            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika rekursif dan penggabungan Anda tepat. Aktivitas selanjutnya telah dibuka. Silakan jalankan kode utuhnya pada Live Editor!';
            feedbackCode.classList.remove('d-none');
            
            // Buka gembok tombol Selanjutnya
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';          

                document.getElementById('m_blank1').value = '//';
                document.getElementById('m_blank2').value = '<';
                document.getElementById('m_blank3').value = 'bagian_kiri[i]';

                document.getElementById('m_blank1').readOnly = true;
                document.getElementById('m_blank2').readOnly = true;
                document.getElementById('m_blank3').readOnly = true;
                btnCheckCode.disabled = true;
                btnCheckCode.innerText = 'Kode Sudah Benar';

                // Tembak data ke database tanpa reload halaman (AJAX yang sukses)
                fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json" // Header vital yang hilang sebelumnya
                    },
                    body: JSON.stringify({
                        id_aktivitas: {{ $item->id }} // Mengirim ID aktivitas saat ini
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        feedbackCode.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Merge Sort sangat tepat. Akses ke halaman selanjutnya telah dibuka.';
                        feedbackCode.className = 'alert alert-success mt-3';
                        feedbackCode.classList.remove('d-none');
                        
                        btnCheckCode.innerText = 'Kode Sudah Benar';
                        
                        // Buka kunci tombol Selanjutnya
                        btnNext.classList.remove('disabled');
                        btnNext.removeAttribute('tabindex');
                        btnNext.removeAttribute('aria-disabled');
                        btnNext.style.pointerEvents = 'auto'; 
                        btnNext.style.opacity = '1';          
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    feedbackCode.innerHTML = 'Gagal menyimpan progres, silakan periksa koneksi Anda.';
                    feedbackCode.className = 'alert alert-danger mt-3';
                    feedbackCode.classList.remove('d-none');
                    btnCheckCode.disabled = false;
                    btnCheckCode.innerText = 'Coba Lagi';
                });

        } else {
            feedbackCode.className = 'alert alert-danger mt-3';
            feedbackCode.innerHTML = '<strong>Kurang Tepat!</strong> Ada jawaban yang masih salah. Coba baca kembali materi di atas.';
            feedbackCode.classList.remove('d-none');
        }
    });
});
</script>
<script>
const btnResetCode = document.getElementById('btnResetCode');

btnResetCode.addEventListener('click', function () {

    ['m_blank1','m_blank2','m_blank3'].forEach(id => {
        const input = document.getElementById(id);

        input.value = '';
        input.className = 'code-input';
    });

    feedbackCode.classList.add('d-none');
    feedbackCode.innerHTML = '';
});
</script>
<script>
window.IMG_PATH = "{{ asset('images/aset/karung') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection