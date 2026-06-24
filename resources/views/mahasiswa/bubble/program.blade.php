@extends('layouts.hlmns')

@section('title','Kode Program Bubble Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bubble.css') }}">
@endsection

<style>


</style>

@section('content')

@php
    // Mengecek apakah materi ini sudah pernah diselesaikan
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma BubbleSort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page ">
    <div class="card mb-4 materi-box">

        <div class="card-header bg-transparent pt-4 pb-2 border-0">
            <div class="materi-header mb-4">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program BubbleSort</span>
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
 1  def bubblesort(list):
 2      for i in range(len(list)-1, 0, -1):
 3          for j in range(0, i, 1):
 4              if list[j] > list[j+1]:
 5                  temp = list[j+1]
 6                  list[j+1] = list[j]
 7                  list[j] = temp
 8          print(f"Hasil setelah iterasi ke-{len(list)-i}: {list}")
 9
10  angka = [4, 2, 5, 1, 3]
11  print("Sebelum sorting:", angka)
12  bubblesort(angka)
13  print("Setelah sorting:", angka)
</pre>
</div>
                    </div>

                    {{-- <p>Penjelasan:</p>
                     <ul>
                        <li>
                            Baris <code>def bubblesort(list)</code> : Menyatakan bahwa program mendefinisikan sebuah fungsi bernama <code>bubblesort</code> yang menerima satu parameter berupa list angka yang akan diurutkan.
                        </li>
                        <li>
                            Baris <code>for i in range(len(list)-1, 0, -1)</code> : Digunakan untuk mengatur jumlah iterasi pemeriksaan terhadap list. Setiap satu kali iterasi akan memindahkan satu elemen terbesar ke posisi yang benar pada bagian kanan list.
                        </li>
                        <li>
                            Baris <code>for j in range(0, i, 1)</code> : Digunakan untuk membandingkan elemen-elemen yang bersebelahan, yaitu <code>list[j]</code> dan <code>list[j+1]</code>. Proses perbandingan dilakukan dari indeks awal hingga sebelum batas <code>i</code>.
                        </li>
                        <li>
                            Baris logika pertukaran (<em>swap</em>) : Melakukan pertukaran elemen apabila elemen kiri lebih besar dibanding elemen kanan. Dengan cara ini, nilai yang lebih besar akan bergerak ke arah kanan list secara bertahap, seperti gelembung yang naik ke permukaan.
                        </li>
                        <li>
                            Baris <code>print(f"Hasil setelah iterasi ke-{len(list)-i}: {list}")</code> : Digunakan untuk menampilkan kondisi list setelah satu iterasi selesai dijalankan, sehingga proses pengurutan dapat diamati secara bertahap.
                        </li>
                        <li>
                            <strong>Pemanggilan fungsi & keluaran</strong> : Pada bagian akhir program, list awal didefinisikan (<code>angka = [4, 2, 5, 1, 3]</code>), kemudian fungsi <code>bubblesort(angka)</code> dipanggil untuk menjalankan proses pengurutan dan menampilkan hasil sebelum serta sesudah sorting.
                        </li>
                    </ul> --}}

<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanList">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="listPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 1, fungsi bubblesort() didefinisikan dengan parameter list. Parameter ini berisi kumpulan data yang akan diurutkan menggunakan algoritma Bubble Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan2">
                2) Perulangan Luar (Outer Loop)
            </button>
        </h2>
        <div id="listPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 2, perulangan luar digunakan untuk mengatur jumlah iterasi proses pengurutan. Nilai i bergerak dari indeks terakhir menuju indeks pertama sehingga jumlah elemen yang diperiksa akan semakin berkurang pada setiap iterasi.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan3">
                3) Perulangan Dalam (Inner Loop)
            </button>
        </h2>
        <div id="listPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 3, perulangan dalam digunakan untuk membandingkan elemen-elemen yang bersebelahan dalam list. Proses perbandingan dilakukan mulai dari indeks pertama hingga batas yang ditentukan oleh nilai i.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan4">
                4) Proses Perbandingan Data
            </button>
        </h2>
        <div id="listPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 4, kondisi if list[j] > list[j+1] digunakan untuk memeriksa apakah elemen di sebelah kiri memiliki nilai yang lebih besar daripada elemen di sebelah kanan. Jika kondisi bernilai benar, maka kedua elemen perlu ditukar posisinya.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan5">
                5) Menyimpan Nilai Sementara
            </button>
        </h2>
        <div id="listPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 5, nilai elemen pada indeks j+1 disimpan sementara ke dalam variabel temp. Penyimpanan sementara diperlukan agar nilai tidak hilang saat proses pertukaran dilakukan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan6">
                6) Memindahkan Nilai ke Posisi Baru
            </button>
        </h2>
        <div id="listPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 6, nilai pada indeks j dipindahkan ke indeks j+1 sebagai bagian dari proses pertukaran elemen.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan7">
                7) Menyelesaikan Proses Pertukaran
            </button>
        </h2>
        <div id="listPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 7, nilai yang telah disimpan dalam variabel temp ditempatkan ke indeks j. Setelah langkah ini selesai, posisi kedua elemen berhasil ditukar.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan8">
                8) Menampilkan Hasil Setiap Iterasi
            </button>
        </h2>
        <div id="listPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 8, kondisi list ditampilkan setelah satu iterasi perulangan luar selesai dilakukan. Informasi ini membantu pengguna mengamati perubahan urutan data pada setiap tahap proses Bubble Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan9">
                9) Menyiapkan Data yang Akan Diurutkan
            </button>
        </h2>
        <div id="listPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 10, dibuat sebuah list bernama angka yang berisi data [4, 2, 5, 1, 3]. Data ini digunakan sebagai contoh untuk proses pengurutan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan10">
                10) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="listPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 11, data ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal elemen dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan11">
                11) Memanggil Fungsi Bubble Sort
            </button>
        </h2>
        <div id="listPenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 12, fungsi bubblesort(angka) dipanggil untuk menjalankan proses pengurutan terhadap data yang terdapat pada variabel angka.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#listPenjelasan12">
                12) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="listPenjelasan12" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanList">
            <div class="accordion-body">
                Pada baris 13, data ditampilkan kembali setelah proses pengurutan selesai dilakukan sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>

                    {{-- <div class="refleksi-alert mt-4">
                        <h5 class="fw-bold mb-3">
                            Refleksi Konseptual
                        </h5>

                        <p class="mb-3">
                            Sebelum melanjutkan ke fitur <em>Live Coding</em>, pastikan Anda memahami hal berikut:
                        </p>

                        <ul class="mb-0">
                            <li class="mb-3">
                                <strong>Mengapa menggunakan nested loop?</strong><br>
                                Nested loop diperlukan karena setiap elemen dalam list
                                harus dibandingkan dengan elemen lainnya secara bertahap.
                                Tanpa perulangan bersarang, proses pembandingan menyeluruh tidak dapat dilakukan.
                            </li>

                            <li class="mb-3">
                                <strong>Mengapa batas perulangan dalam hanya sampai <code>i</code>?</strong><br>
                                Karena elemen setelah indeks <code>i</code> sudah berada pada posisi
                                yang benar. Area perbandingan akan berkurang secara dinamis pada setiap iterasi.
                            </li>

                            <li>
                                <strong>Mengapa kompleksitas waktu Bubble Sort adalah O(n²)?</strong><br>
                                Pada kondisi terburuk, setiap elemen dibandingkan dengan hampir
                                seluruh elemen lainnya melalui mekanisme nested loop,
                                sehingga kompleksitas waktu bersifat kuadratik.
                            </li>
                        </ul>
                    </div> --}}
                
                </div> <div class="tab-pane fade" id="pills-dict" role="tabpanel" aria-labelledby="pills-dict-tab">
                    
                    <div class="my-4 text-start">
                        <div class="alert alert-info mb-3">
                            <strong>Perhatian:</strong> Di dunia nyata, data seringkali berbentuk kumpulan kamus (Dictionary). Perhatikan bagaimana algoritma dimodifikasi agar bisa mengurutkan data berdasarkan kunci (key) tertentu.
                        </div>

                            <div class="code-container">
<pre class="code-box">
 1  def bubble_sort_dict(data, key):
 2      n = len(data)
 3      for i in range(n-1, 0, -1):
 4          for j in range(0, i, 1):
 5              # Membandingkan value dari 'key' spesifik (misal: 'nilai')
 6              if data[j][key] > data[j+1][key]:
 7                  temp = data[j+1]
 8                  data[j+1] = data[j]
 9                  data[j] = temp
10
11  # Data Mahasiswa berbentuk List of Dictionary
12  mahasiswa = [
13      {"nama": "Andi", "nilai": 75},
14      {"nama": "Budi", "nilai": 90},
15      {"nama": "Citra", "nilai": 65},
16      {"nama": "Dewi", "nilai": 85}
17  ]
18
19  print("Sebelum Sorting:")
20  for mhs in mahasiswa:
21      print(mhs)
22
23  print("\n--- Proses Bubble Sort Berdasarkan Nilai ---")
24  # Memanggil fungsi dengan parameter tambahan 'nilai'
25  bubble_sort_dict(mahasiswa, "nilai")
26
27  print("\nSetelah Sorting (Ascending):")
28  for mhs in mahasiswa:
29      print(mhs)
</pre>
                            </div>
                    </div>

<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanDict">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="dictPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 1, fungsi bubble_sort_dict() didefinisikan dengan dua parameter, yaitu data dan key. Parameter data berisi kumpulan data dalam bentuk List of Dictionary, sedangkan parameter key digunakan untuk menentukan atribut yang dijadikan dasar pengurutan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan2">
                2) Menentukan Panjang Data
            </button>
        </h2>
        <div id="dictPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 2, fungsi len(data) digunakan untuk menghitung jumlah elemen dalam list dan menyimpannya ke dalam variabel n. Nilai ini digunakan sebagai batas perulangan selama proses pengurutan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan3">
                3) Perulangan Luar (Outer Loop)
            </button>
        </h2>
        <div id="dictPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 3, perulangan luar digunakan untuk mengatur jumlah iterasi proses Bubble Sort. Setiap iterasi membantu memindahkan nilai terbesar berdasarkan atribut yang dipilih ke posisi yang benar di bagian akhir data.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan4">
                4) Perulangan Dalam (Inner Loop)
            </button>
        </h2>
        <div id="dictPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 4, perulangan dalam digunakan untuk membandingkan elemen-elemen yang bersebelahan. Proses perbandingan dilakukan dari indeks pertama hingga batas yang ditentukan oleh variabel i.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan5">
                5) Perbandingan Berdasarkan Key Dictionary
            </button>
        </h2>
        <div id="dictPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 6, kondisi if data[j][key] > data[j+1][key] digunakan untuk membandingkan nilai dari atribut yang dipilih pada dua dictionary yang bersebelahan. Jika nilai pada elemen kiri lebih besar daripada elemen kanan, maka kedua data perlu ditukar posisinya.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan6">
                6) Menyimpan Data Sementara
            </button>
        </h2>
        <div id="dictPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 7, elemen pada indeks j+1 disimpan sementara ke dalam variabel temp. Penyimpanan sementara diperlukan agar data tidak hilang selama proses pertukaran berlangsung.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan7">
                7) Memindahkan Data ke Posisi Baru
            </button>
        </h2>
        <div id="dictPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 8, elemen pada indeks j dipindahkan ke indeks j+1 sebagai bagian dari proses pertukaran data.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan8">
                8) Menyelesaikan Proses Pertukaran
            </button>
        </h2>
        <div id="dictPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 9, nilai yang tersimpan dalam variabel temp ditempatkan pada indeks j. Setelah langkah ini selesai, posisi kedua dictionary berhasil ditukar.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan9">
                9) Mendefinisikan Data Mahasiswa
            </button>
        </h2>
        <div id="dictPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 12–17, didefinisikan sebuah List of Dictionary yang berisi data mahasiswa. Setiap dictionary memiliki atribut "nama" dan "nilai" yang merepresentasikan nama mahasiswa dan nilai yang diperoleh.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan10">
                10) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="dictPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 19–21, data mahasiswa ditampilkan sebelum proses pengurutan dilakukan. Langkah ini bertujuan untuk memperlihatkan urutan awal data.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan11">
                11) Memanggil Fungsi Bubble Sort
            </button>
        </h2>
        <div id="dictPenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 25, fungsi bubble_sort_dict(mahasiswa, "nilai") dipanggil untuk menjalankan proses pengurutan. Parameter "nilai" menunjukkan bahwa pengurutan dilakukan berdasarkan nilai mahasiswa secara ascending.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dictPenjelasan12">
                12) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="dictPenjelasan12" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanDict">
            <div class="accordion-body">
                Pada baris 28–29, seluruh data mahasiswa ditampilkan kembali setelah proses Bubble Sort selesai dilakukan sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>

                </div><div class="tab-pane fade" id="pills-oflist" role="tabpanel" aria-labelledby="pills-oflist-tab">
                    
                    <div class="my-4 text-start">
                        {{-- <div class="alert alert-success mb-3">
                            <strong>Materi Baru:</strong> Ini adalah isi materi untuk tab ketiga Anda.
                        </div> --}}

                        <div class="code-container">
<pre class="code-box">
 1  def bubblesortLoL(data):
 2      n = len(data)
 3      for i in range(n):
 4          for j in range(n - 1):
 5              if data[j][1] > data[j + 1][1]:
 6                  data[j], data[j + 1] = data[j + 1], data[j]
 7                  print(data)
 8
 9  data = [
10      ["Ali", 85],
11      ["Budi", 75],
12      ["Cici", 90]
13  ]
14
15  print("Sebelum di sortir:", data)
16  bubblesortLoL(data)
17  print("Setelah di sortir:", data)
</pre>
                        </div>

<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanLoL">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="lolPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 1, fungsi bubblesortLoL() didefinisikan dengan parameter data. Parameter ini berisi kumpulan data dalam bentuk List of List yang akan diurutkan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan2">
                2) Menentukan Panjang Data
            </button>
        </h2>
        <div id="lolPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 2, fungsi len(data) digunakan untuk menghitung jumlah elemen dalam list dan menyimpannya ke dalam variabel n. Nilai ini digunakan sebagai batas perulangan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan3">
                3) Perulangan Luar (Outer Loop)
            </button>
        </h2>
        <div id="lolPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 3, perulangan luar digunakan untuk mengatur jumlah iterasi proses pengurutan. Setiap iterasi membantu memindahkan nilai terbesar ke posisi yang benar di bagian akhir data.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan4">
                4) Perulangan Dalam (Inner Loop)
            </button>
        </h2>
        <div id="lolPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 4, perulangan dalam digunakan untuk membandingkan elemen-elemen yang bersebelahan. Proses perbandingan dilakukan secara berulang hingga seluruh data berada dalam urutan yang benar.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan5">
                5) Perbandingan Berdasarkan Indeks Tertentu
            </button>
        </h2>
        <div id="lolPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 5, kondisi if data[j][1] > data[j+1][1] digunakan untuk membandingkan nilai pada indeks ke-1 dari setiap list. Pada contoh ini, indeks ke-1 berisi nilai mahasiswa sehingga proses pengurutan dilakukan berdasarkan nilai tersebut.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan6">
                6) Proses Pertukaran (Swap)
            </button>
        </h2>
        <div id="lolPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 6, dua elemen yang bersebelahan ditukar posisinya apabila urutannya tidak sesuai. Yang ditukar adalah seluruh list sehingga data nama dan nilai tetap berada dalam satu kesatuan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan7">
                7) Menampilkan Hasil Setiap Pertukaran
            </button>
        </h2>
        <div id="lolPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 7, data ditampilkan setiap kali terjadi proses pertukaran. Hal ini bertujuan untuk memperlihatkan perubahan urutan data selama proses pengurutan berlangsung.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan8">
                8) Data Mahasiswa
            </button>
        </h2>
        <div id="lolPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 9–13, didefinisikan sebuah List of List yang berisi data mahasiswa. Setiap elemen terdiri dari dua data, yaitu nama mahasiswa pada indeks ke-0 dan nilai mahasiswa pada indeks ke-1.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan9">
                9) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="lolPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 15, data ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal data dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan10">
                10) Memanggil Fungsi Bubble Sort
            </button>
        </h2>
        <div id="lolPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 16, fungsi bubblesortLoL(data) dipanggil untuk menjalankan proses pengurutan berdasarkan nilai mahasiswa.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#lolPenjelasan11">
                11) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="lolPenjelasan11" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanLoL">
            <div class="accordion-body">
                Pada baris 17, data ditampilkan kembali setelah proses pengurutan selesai sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>
</div>

                </div> </div> </div>
    </div>
        

    <div class="card mb-4 materi-box mt-4" id="fillCodeActivity">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fas fa-keyboard"></i>
                <span class="materi-badge">Aktivitas 2.2: Melengkapi Kode Program</span>
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
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">bubblesort</span>(list):<br>

                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> i <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(
                <input type="text"
                    id="blank1"
                    class="code-input"
                    placeholder="..."
                    value="{{ $isSelesai ? 'len(list)-1' : '' }}"
                    {{ $isSelesai ? 'readonly' : '' }}
                    style="width: 130px;">
                , <span style="color: #b5cea8;">0</span>, <span style="color: #b5cea8;">-1</span>): <span style="color: #6a9955;"># Tentukan panjang iterasi berdasarkan list</span><br>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> j <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(<span style="color: #b5cea8;">0</span>, i, <span style="color: #b5cea8;">1</span>):<br>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> list[j]
                <input type="text"
                    id="blank2"
                    class="code-input"
                    placeholder="..."
                    value="{{ $isSelesai ? '>' : '' }}"
                    {{ $isSelesai ? 'readonly' : '' }}
                    style="width: 40px; text-align: center;">
                list[j+1]: <span style="color: #6a9955;"># Kondisi pertukaran (Ascending)</span><br>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;temp = list[j+1]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;list[j+1] = list[j]<br>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;list[j] =
                <input type="text"
                    id="blank3"
                    class="code-input"
                    placeholder="..."
                    value="{{ $isSelesai ? 'temp' : '' }}"
                    {{ $isSelesai ? 'readonly' : '' }}
                    style="width: 80px;">
                <span style="color: #6a9955;"># Selesaikan logika swap</span><br>
            </div>

            <div id="fillCodeFeedback" class="alert {{ $isSelesai ? 'alert-success' : 'd-none' }} mt-3">
                @if($isSelesai)
                    <i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Anda sangat tepat. Akses aktivitas selanjutnya telah dibuka. Silakan coba kode ini pada Live Editor di bawah!
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

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','simulasi']) }}" 
       class="btn btn-outline-secondary">
       Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','quiz']) }}" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       id="btnNextBubble" 
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
    const btnNext = document.getElementById('btnNextBubble');
    // const lockIcon = document.getElementById('lockIconBubble'); // Variabel ini tidak ada elemennya di HTML, saya comment agar tidak error JS

    btnCheckCode.addEventListener('click', function() {
        // Ambil nilai dan hilangkan spasi untuk mencegah error akibat spasi berlebih
        const b1 = document.getElementById('blank1').value.replace(/\s+/g, ''); // Jawaban: len(list)-1
        const b2 = document.getElementById('blank2').value.trim(); // Jawaban: >
        const b3 = document.getElementById('blank3').value.trim(); // Jawaban: temp

        let correctCount = 0;

        // Validasi Blank 1
        if (b1 === 'len(list)-1') {
            document.getElementById('blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('blank1').className = 'code-input wrong';
        }

        // Validasi Blank 2
        if (b2 === '>') {
            document.getElementById('blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('blank2').className = 'code-input wrong';
        }

        // Validasi Blank 3
        if (b3 === 'temp') {
            document.getElementById('blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('blank3').className = 'code-input wrong';
        }

        // Output Feedback
        if (correctCount === 3) {
            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Anda sangat tepat. Akses aktivitas selanjutnya telah dibuka. Silakan coba kode ini pada Live Editor di bawah!';
            // feedbackCode.classList.remove('d-none');
            
            // Buka gembok tombol Selanjutnya
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';          
            // lockIcon.className = 'fa-solid fa-unlock me-1'; // Variabel ini tidak ada elemennya di HTML, saya comment agar tidak error JS

                // Tampilkan jawaban yang benar
                document.getElementById('blank1').value = 'len(list)-1';
                document.getElementById('blank2').value = '>';
                document.getElementById('blank3').value = 'temp';

                // Kunci input dan tombol setelah berhasil
                document.getElementById('blank1').readOnly = true;
                document.getElementById('blank2').readOnly = true;
                document.getElementById('blank3').readOnly = true;

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
                        feedbackCode.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Bubble Sort sangat tepat. Akses ke aktivitas selanjutnya telah dibuka.';
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
            feedbackCode.innerHTML = '<strong>Coba Lagi!</strong> Beberapa bagian kode masih belum tepat. Baca kembali penjelasan Bubble Sort, kemudian periksa setiap isian yang telah Anda pilih.';
            feedbackCode.classList.remove('d-none');
        }
    });
});

const btnResetCode = document.getElementById('btnResetCode');

btnResetCode.addEventListener('click', function () {

    ['b_blank1','b_blank2','b_blank3'].forEach(id => {
        const input = document.getElementById(id);

        input.value = '';
        input.className = 'code-input';
    });

    feedbackCode.classList.add('d-none');
    feedbackCode.innerHTML = '';
});
</script>
<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection