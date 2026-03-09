@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/insertion.css') }}">
@endsection

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

/* ===============================
   FILE CONTAINER
   =============================== */

.file-container {
    position: relative;
    height: 180px;
    margin-bottom: 25px;
}


/* ===============================
   FILE WRAP
   =============================== */

.file-wrap {
    position: absolute;
    width: 100px;
    transition: all 0.4s ease;
    text-align: center;
    z-index: 1; /* 🔥 jangan besar */
}

.file-wrap img {
    width: 100px;
    pointer-events: none; /* supaya gambar tidak menghalangi klik */
}

.file-label {
    display: block;
    margin-top: 8px;
    font-weight: 600;
    font-size: 0.9rem;
}


/* ===============================
   STATE VISUAL
   =============================== */

.file-wrap.is-sorted img {
    filter: drop-shadow(0 0 8px #2ecc71);
}

.file-wrap.comparing img {
    filter: drop-shadow(0 0 8px #f39c12);
}

.file-wrap.is-key img {
    filter: drop-shadow(0 0 10px #3498db);
}


/* ===============================
   BUTTON AREA
   =============================== */

.action-buttons {
    position: relative;
    z-index: 20; /* 🔥 lebih tinggi dari file-wrap */
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 15px;
}


/* ===============================
   BUTTON STYLE
   =============================== */

.btn-sim {
    padding: 10px 22px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
    background: #3498db;
    color: #fff;
}

.btn-sim:hover {
    transform: translateY(-2px);
}

.btn-yes {
    background: #27ae60;
}

.btn-no {
    background: #e74c3c;
}

.btn-swap {
    background: #f39c12;
}

.btn-disabled {
    opacity: 0.6;
    cursor: default;
}


/* ===============================
   FINISH MESSAGE
   =============================== */

#finish-message {
    margin-top: 20px;
    font-weight: bold;
    text-align: center;
} */

</style>

<!-- ===== Judul Materi dengan Box ===== -->
<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma InsertionSort</h3>
            </div>
        </div>
    </div>
</div>

<!-- ===== Ilustrasi ===== -->
<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play"></i>
                <span class="materi-badge">Simulasi Insertion Sort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi kasus : </strong>Dalam sebuah sistem pengelolaan arsip digital, terdapat beberapa data yang diberi label nama bulan, yaitu April, Juni, September, Mei, dan Oktober. Data tersebut belum tersusun secara alfabet, sehingga menyulitkan proses pencarian. Untuk mengatasi masalah ini, digunakan algoritma Insertion Sort, yang mengurutkan data dengan cara mengambil satu elemen sebagai key lalu menyisipkannya ke posisi yang tepat di bagian data yang sudah terurut.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Pengurutan Selesai!</h4>
                        <button class="btn btn-outline-success" onclick="resetSimulation()">Ulangi Simulasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','materi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','program']) }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>

</div>


<script>
window.IMG_PATH = "{{ asset('images/aset/nama') }}/";
</script>
<script src="{{ asset('js/insertionsort.js') }}"></script>

@endsection
