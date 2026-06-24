@extends('layouts.hlmns')

@section('title','Kode Program Selection Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/selection.css') }}">
@endsection

@section('content')

@php
    // Mengecek apakah materi ini sudah pernah diselesaikan
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

<style>
/* =========================
   CODEMIRROR & LIVE EDITOR
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

.live-editor .split-container {
    display: flex;
    flex: 1;
    overflow: hidden;
}

.live-editor .panel-left {
    flex: 6;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #444;
}

.live-editor .panel-right {
    flex: 4;
    display: flex;
    flex-direction: column;
    background: #101010;
}

.live-editor .panel-label {
    background: #333;
    color: #ccc;
    padding: 5px 15px;
    font-size: 0.75rem;
    text-transform: uppercase;
}

.live-editor .CodeMirror {
    flex: 1;
    font-size: 14px;
}

.live-editor #output {
    flex: 1;
    padding: 15px;
    color: #00ff00;
    font-family: 'Courier New', monospace;
    white-space: pre-wrap;
    overflow-y: auto;
    font-size: 13px;
}

.live-editor .btn-run {
    padding: 5px 15px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
}

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
                <h3 class="mb-0">Algoritma SelectionSort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page ">
    <div class="card mb-4 materi-box">
        <div class="card-header bg-transparent pt-4 pb-2 border-0">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program SelectionSort</span>
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
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill fw-bold" id="pills-oflist-tab" data-bs-toggle="pill" data-bs-target="#pills-oflist" type="button" role="tab" aria-controls="pills-oflist" aria-selected="false">
                        <i class="bi bi-3-circle me-1"></i> 3. Contoh List of List
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
 1  def selection_sort(data):
 2      n = len(data)
 3      for i in range(n-1):
 4          min_index = i
 5          for j in range(i+1, n):
 6              if data[j] < data[min_index]:
 7                  min_index = j
 8
 9          data[i], data[min_index] = data[min_index], data[i]
10          print(f"Hasil setelah siklus ke-{i+1}: {data}")
11
12  angka = [64, 25, 12, 22, 11]
13  print("Sebelum sorting:", angka)
14  selection_sort(angka)
15  print("Setelah sorting:", angka)
</pre>
                </div>
            </div>
            
<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanSelection">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="selectionPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 1, fungsi selection_sort() didefinisikan dengan parameter data. Parameter ini berisi kumpulan data yang akan diurutkan menggunakan algoritma Selection Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan2">
                2) Menentukan Panjang Data
            </button>
        </h2>
        <div id="selectionPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 2, fungsi len(data) digunakan untuk menghitung jumlah elemen dalam list dan menyimpannya ke dalam variabel n. Nilai ini digunakan sebagai batas perulangan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan3">
                3) Perulangan Luar (Outer Loop)
            </button>
        </h2>
        <div id="selectionPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 3, perulangan luar digunakan untuk menentukan posisi penempatan nilai terkecil pada setiap iterasi pengurutan. Setiap iterasi akan menempatkan satu elemen pada posisi yang benar.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan4">
                4) Menentukan Nilai Terkecil Sementara
            </button>
        </h2>
        <div id="selectionPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 4, variabel min_index diinisialisasi dengan nilai i. Artinya, elemen pada posisi saat ini dianggap sebagai nilai terkecil sementara sebelum dilakukan proses pencarian.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan5">
                5) Perulangan Dalam (Inner Loop)
            </button>
        </h2>
        <div id="selectionPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 5, perulangan dalam digunakan untuk mencari nilai terkecil pada bagian data yang belum terurut. Pencarian dilakukan mulai dari indeks setelah i hingga elemen terakhir.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan6">
                6) Mencari Nilai Terkecil
            </button>
        </h2>
        <div id="selectionPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 6–7, dilakukan perbandingan antara elemen saat ini dengan elemen yang dianggap memiliki nilai terkecil. Jika ditemukan nilai yang lebih kecil, maka min_index diperbarui untuk menyimpan posisi elemen tersebut.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan7">
                7) Proses Pertukaran (Swap)
            </button>
        </h2>
        <div id="selectionPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 9, elemen pada posisi i ditukar dengan elemen yang berada pada min_index. Setelah pertukaran dilakukan, nilai terkecil akan berada pada posisi yang sesuai.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan8">
                8) Menampilkan Hasil Setiap Iterasi
            </button>
        </h2>
        <div id="selectionPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 10, data ditampilkan setelah setiap iterasi perulangan luar selesai dilakukan. Tampilan ini membantu memperlihatkan perubahan urutan data selama proses pengurutan berlangsung.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan9">
                9) Deklarasi Data
            </button>
        </h2>
        <div id="selectionPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 13, didefinisikan sebuah list bernama angka yang berisi data yang akan diurutkan menggunakan algoritma Selection Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan10">
                10) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="selectionPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 13, data ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal data dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan11">
                11) Memanggil Fungsi Selection Sort
            </button>
        </h2>
        <div id="selectionPenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 14, fungsi selection_sort(angka) dipanggil untuk menjalankan proses pengurutan pada data yang terdapat dalam list angka.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionPenjelasan12">
                12) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="selectionPenjelasan12" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelection">
            <div class="accordion-body">
                Pada baris 15, data ditampilkan kembali setelah seluruh proses pengurutan selesai sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>

            </div> <div class="tab-pane fade" id="pills-dict" role="tabpanel" aria-labelledby="pills-dict-tab">
                    
                    <div class="my-4 text-start">
                        {{-- <div class="alert alert-info mb-3">
                            <strong>Perhatian:</strong> Di dunia nyata, data seringkali berbentuk kumpulan kamus (Dictionary). Perhatikan bagaimana algoritma dimodifikasi agar bisa mengurutkan data berdasarkan kunci (key) tertentu.
                        </div> --}}

                            <div class="code-container">
<pre class="code-box">
 1  def selectionLoD(data):
 2      n = len(data)
 3      for i in range(n - 1):
 4          print("Langkah ke-", i + 1, ":", data)
 5          indeks_terkecil = i
 6          for j in range(i + 1, n):
 7              if data[j]['harga'] < data[indeks_terkecil]['harga']:
 8                  indeks_terkecil = j
 9          data[i], data[indeks_terkecil] = data[indeks_terkecil], data[i]
10
11
12  data_produk = [
13      {'produk': 'Pensil', 'harga': 2500},
14      {'produk': 'Pulpen', 'harga': 3000},
15      {'produk': 'Penghapus', 'harga': 1500},
16      {'produk': 'Penggaris', 'harga': 2000}
17  ]
18
19  print("Sebelum disortir:")
20  for m in data_produk:
21      print(m)
22
23  selectionLoD(data_produk)
24
25  print("\nSetelah disortir:")
26  for m in data_produk:
27      print(m)
</pre>
                            </div>
                    </div>

<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanSelectionLoD">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="selectionLoDPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 1, fungsi selectionLoD() didefinisikan dengan parameter data. Parameter ini berisi kumpulan data dalam bentuk List of Dictionary yang akan diurutkan menggunakan algoritma Selection Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan2">
                2) Menentukan Panjang Data
            </button>
        </h2>
        <div id="selectionLoDPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 2, fungsi len(data) digunakan untuk menghitung jumlah elemen dalam list dan menyimpannya ke dalam variabel n. Nilai ini digunakan sebagai batas perulangan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan3">
                3) Perulangan Luar (Outer Loop)
            </button>
        </h2>
        <div id="selectionLoDPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 3, perulangan luar digunakan untuk menentukan posisi penempatan nilai terkecil pada setiap iterasi pengurutan. Setiap iterasi akan menempatkan satu elemen pada posisi yang benar.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan4">
                4) Menampilkan Data Setiap Iterasi
            </button>
        </h2>
        <div id="selectionLoDPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 4, data ditampilkan pada awal setiap iterasi sehingga perubahan urutan data selama proses Selection Sort dapat diamati.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan5">
                5) Menentukan Nilai Terkecil Sementara
            </button>
        </h2>
        <div id="selectionLoDPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 5, variabel indeks_terkecil diinisialisasi dengan nilai i. Artinya, elemen pada posisi saat ini dianggap sebagai data dengan nilai terkecil sementara sebelum dilakukan pencarian.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan6">
                6) Perulangan Dalam (Inner Loop)
            </button>
        </h2>
        <div id="selectionLoDPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 6, perulangan dalam digunakan untuk mencari nilai terkecil pada bagian data yang belum terurut. Pencarian dilakukan mulai dari indeks setelah i hingga elemen terakhir.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan7">
                7) Mencari Nilai Terkecil Berdasarkan Key
            </button>
        </h2>
        <div id="selectionLoDPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 7–8, dilakukan perbandingan nilai atribut 'harga' pada setiap dictionary. Jika ditemukan harga yang lebih kecil dari harga pada indeks_terkecil, maka nilai indeks_terkecil diperbarui sesuai posisi data tersebut.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan8">
                8) Proses Pertukaran (Swap)
            </button>
        </h2>
        <div id="selectionLoDPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 9, data pada posisi i ditukar dengan data pada indeks_terkecil. Yang ditukar adalah seluruh dictionary sehingga informasi produk dan harga tetap tersimpan sebagai satu kesatuan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan9">
                9) Deklarasi Data Produk
            </button>
        </h2>
        <div id="selectionLoDPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 12–17, didefinisikan data produk dalam bentuk List of Dictionary. Setiap dictionary menyimpan informasi produk berupa atribut produk dan harga.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan10">
                10) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="selectionLoDPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 20–21, seluruh data produk ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal data dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan11">
                11) Memanggil Fungsi Selection Sort
            </button>
        </h2>
        <div id="selectionLoDPenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 23, fungsi selectionLoD(data_produk) dipanggil untuk menjalankan proses pengurutan berdasarkan atribut harga.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoDPenjelasan12">
                12) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="selectionLoDPenjelasan12" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoD">
            <div class="accordion-body">
                Pada baris 25–27, data produk ditampilkan kembali setelah proses pengurutan selesai sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>
            
            </div><div class="tab-pane fade" id="pills-oflist" role="tabpanel" aria-labelledby="pills-oflist-tab">
                    
                    <div class="my-4 text-start">
                        <div class="alert alert-success mb-3">
                            <strong>Instruksi:</strong> Amati kode berikut dengan saksama,
                            kemudian ketik ulang pada fitur <em>Live Coding</em> di bawah tanpa melakukan copy–paste.
                        </div>

                        <p>Anda bisa menambahkan penjelasan, list, atau gambar di sini persis seperti tab lainnya.</p>

                        <div class="code-container">
<pre class="code-box">
 1  def selectionLoL(data):
 2      n = len(data)
 3      for i in range(n - 1):
 4          print("Langkah ke-", i + 1, ":", data)
 5          indeks_terkecil = i
 6          for j in range(i + 1, n):
 7              if data[j][1] < data[indeks_terkecil][1]:
 8                  indeks_terkecil = j
 9          data[i], data[indeks_terkecil] = data[indeks_terkecil], data[i]
10
11
12  data_produk = [
13      ['Pensil', 2500],
14      ['Pulpen', 3000],
15      ['Penghapus', 1500],
16      ['Penggaris', 2000]
17  ]
18
19  print("Sebelum disortir:")
20  for m in data_produk:
21      print(m)
22
23  selectionLoL(data_produk)
24
25  print("\nSetelah disortir:")
26  for m in data_produk:
27      print(m)
</pre>
                    </div>

<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanSelectionLoL">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="selectionLoLPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 1, fungsi selectionLoL() didefinisikan dengan parameter data. Parameter ini berisi kumpulan data dalam bentuk List of List yang akan diurutkan menggunakan algoritma Selection Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan2">
                2) Menentukan Panjang Data
            </button>
        </h2>
        <div id="selectionLoLPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 2, fungsi len(data) digunakan untuk menghitung jumlah elemen dalam list dan menyimpannya ke dalam variabel n. Nilai ini digunakan sebagai batas perulangan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan3">
                3) Perulangan Luar (Outer Loop)
            </button>
        </h2>
        <div id="selectionLoLPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 3, perulangan luar digunakan untuk menentukan posisi penempatan nilai terkecil pada setiap iterasi pengurutan. Setiap iterasi akan menempatkan satu elemen pada posisi yang benar.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan4">
                4) Menampilkan Data Setiap Iterasi
            </button>
        </h2>
        <div id="selectionLoLPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 4, data ditampilkan pada awal setiap iterasi sehingga perubahan urutan data selama proses Selection Sort dapat diamati.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan5">
                5) Menentukan Nilai Terkecil Sementara
            </button>
        </h2>
        <div id="selectionLoLPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 5, variabel indeks_terkecil diinisialisasi dengan nilai i. Artinya, elemen pada posisi saat ini dianggap sebagai data dengan nilai terkecil sementara sebelum dilakukan pencarian.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan6">
                6) Perulangan Dalam (Inner Loop)
            </button>
        </h2>
        <div id="selectionLoLPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 6, perulangan dalam digunakan untuk mencari nilai terkecil pada bagian data yang belum terurut. Pencarian dilakukan mulai dari indeks setelah i hingga elemen terakhir.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan7">
                7) Mencari Nilai Terkecil Berdasarkan Elemen Kedua
            </button>
        </h2>
        <div id="selectionLoLPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 7–8, dilakukan perbandingan nilai pada indeks ke-1 dari setiap list. Pada contoh ini, indeks ke-1 berisi harga produk. Jika ditemukan harga yang lebih kecil, maka nilai indeks_terkecil diperbarui sesuai posisi data tersebut.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan8">
                8) Proses Pertukaran (Swap)
            </button>
        </h2>
        <div id="selectionLoLPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 9, data pada posisi i ditukar dengan data pada indeks_terkecil. Yang ditukar adalah seluruh list sehingga nama produk dan harga tetap tersimpan sebagai satu kesatuan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan9">
                9) Deklarasi Data Produk
            </button>
        </h2>
        <div id="selectionLoLPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 12–17, didefinisikan data produk dalam bentuk List of List. Setiap elemen terdiri dari nama produk pada indeks ke-0 dan harga produk pada indeks ke-1.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan10">
                10) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="selectionLoLPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 19–21, seluruh data produk ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal data dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan11">
                11) Memanggil Fungsi Selection Sort
            </button>
        </h2>
        <div id="selectionLoLPenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 23, fungsi selectionLoL(data_produk) dipanggil untuk menjalankan proses pengurutan berdasarkan harga produk.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#selectionLoLPenjelasan12">
                12) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="selectionLoLPenjelasan12" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanSelectionLoL">
            <div class="accordion-body">
                Pada baris 25–27, data produk ditampilkan kembali setelah proses pengurutan selesai sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>


                    </ul>
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
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">selection_sort</span>(data):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;n = <span style="color: #dcdcaa;">len</span>(data)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> i <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(n - <span style="color: #b5cea8;">1</span>):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;min_idx = <input type="text"
                id="s_blank1"
                class="code-input {{ $isSelesai ? 'correct' : '' }}"
                placeholder="..."
                value="{{ $isSelesai ? 'i' : '' }}"
                {{ $isSelesai ? 'readonly' : '' }}
                style="width: 40px; text-align: center;"><span style="color: #6a9955;"># Asumsikan elemen pertama di sisa data adalah minimum</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> j <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(i + <span style="color: #b5cea8;">1</span>, n):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> data[j] <input type="text"
                id="s_blank2"
                class="code-input {{ $isSelesai ? 'correct' : '' }}"
                placeholder="..."
                value="{{ $isSelesai ? '<' : '' }}"
                {{ $isSelesai ? 'readonly' : '' }}
                style="width: 40px; text-align: center;"> data[min_idx]: <span style="color: #6a9955;"># Cek elemen untuk Ascending</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;min_idx = j<br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #6a9955;"># Proses Pertukaran</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;temp = data[i]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[i] = data[min_idx]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[min_idx] = <input type="text"
                id="s_blank3"
                class="code-input {{ $isSelesai ? 'correct' : '' }}"
                placeholder="..."
                value="{{ $isSelesai ? 'temp' : '' }}"
                {{ $isSelesai ? 'readonly' : '' }}
                style="width: 80px;"> <span style="color: #6a9955;"># Selesaikan logika swap</span><br>
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
            <p>Jalankan kode program Selection Sort di bawah ini untuk mengamati bagaimana Python memproses data.</p>
          
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

    <a href="{{ route('mahasiswa.aktivitas.show',['selection','simulasi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['selection','quiz']) }}" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       id="btnNextSelection" 
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
    const btnResetCode = document.getElementById('btnResetCode');
    const feedbackCode = document.getElementById('fillCodeFeedback');
    const btnNext = document.getElementById('btnNextSelection');

    btnCheckCode.addEventListener('click', function() {
        const b1 = document.getElementById('s_blank1').value.trim();
        const b2 = document.getElementById('s_blank2').value.trim();
        const b3 = document.getElementById('s_blank3').value.trim();

        let correctCount = 0;

        if (b1 === 'i') {
            document.getElementById('s_blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('s_blank1').className = 'code-input wrong';
        }

        if (b2 === '<') {
            document.getElementById('s_blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('s_blank2').className = 'code-input wrong';
        }

        if (b3 === 'temp') {
            document.getElementById('s_blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('s_blank3').className = 'code-input wrong';
        }

        if (correctCount === 3) {
            document.getElementById('s_blank1').value = 'i';
            document.getElementById('s_blank2').value = '<';
            document.getElementById('s_blank3').value = 'temp';

            document.getElementById('s_blank1').readOnly = true;
            document.getElementById('s_blank2').readOnly = true;
            document.getElementById('s_blank3').readOnly = true;

            btnCheckCode.disabled = true;
            btnCheckCode.innerText = 'Kode Sudah Benar';
            btnResetCode.disabled = true;

            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Selection Sort sangat tepat. Akses ke aktivitas selanjutnya telah dibuka.';
            feedbackCode.classList.remove('d-none');

            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';

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
        }
    });

    btnResetCode.addEventListener('click', function () {
        ['s_blank1','s_blank2','s_blank3'].forEach(id => {
            const input = document.getElementById(id);
            input.value = '';
            input.className = 'code-input';
        });

        feedbackCode.classList.add('d-none');
        feedbackCode.innerHTML = '';
    });
});
</script>

<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection