@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bubble.css') }}">
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


<style>
Container Ilustrasi agar rapi di tengah
/* Container Utama */
#simulation-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-top: 20px;
}

/* KARTU SIMULASI (Mirip Gambar Referensi) */
.sim-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    overflow: hidden;
    margin-bottom: 20px;
}

/* Bagian Penjelasan Text (Atas) */
.sim-header {
    padding: 20px 25px;
    background: #fafafa;
    border-bottom: 1px solid #eee;
    font-size: 1rem;
    line-height: 1.6;
    color: #444;
}

/* Bagian Visualisasi (Tengah) */
.sim-body {
    padding: 30px;
    text-align: center;
}

.iter-title {
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

/* Container Rak Buku/Kotak */
.book-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
}

.book-box {
    width: 60px;
    height: 60px; /* Atau auto jika pakai gambar buku */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1.2rem;
    transition: all 0.3s;
    background: #e3f2fd; /* Default Biru Muda */
    border: 2px solid #90caf9;
}

/* Jika Anda pakai gambar buku, sesuaikan class ini */
.book-img-wrap {
    padding: 5px;
    border-radius: 8px;
    transition: transform 0.3s;
}
.book-img-wrap.comparing {
    transform: scale(1.15);
    background: #fff3cd; /* Kuning highlight */
    border: 2px solid #ffc107;
    box-shadow: 0 0 10px rgba(255, 193, 7, 0.4);
}

/* BUTTONS GROUP */
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 15px;
}


/* Warna Tombol */
/* TOMBOL DASAR */
.btn-sim {
    padding: 10px 25px;
    border-radius: 6px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    color: white;
}

/* Tukar = Merah */
.btn-tukar {
    background-color: #e74c3c;
}
.btn-tukar:hover {
    background-color: #c0392b;
}

/* Tidak Ditukar = Biru */
.btn-stay {
    background-color: #3498db;
}
.btn-stay:hover {
    background-color: #2c80b4;
}


.btn-reset { background-color: #dc3545; color: #fff; }
.btn-reset:hover { background-color: #c82333; }

/* Status Text Bawah */
.status-text {
    font-size: 0.95rem;
    color: #555;
    margin-top: 10px;
}


    
    .editor-header { padding: 10px 20px; background: #2d2d2d; border-bottom: 1px solid #444; display: flex; justify-content: space-between; align-items: center; color: white; }
    .editor-header h1 { margin: 0; font-size: 1rem; }
    .split-container { display: flex; flex: 1; overflow: hidden; border-top: 1px solid #444; }

    .panel-right { flex: 4; display: flex; flex-direction: column; background: #101010; }
    .panel-label { background: #333; color: #ccc; padding: 5px 15px; font-size: 0.75rem; text-transform: uppercase; }
    .CodeMirror { flex: 1; min-height: 100%; font-size: 14px; text-align: left; }
    #output { padding: 15px; color: #00ff00; font-family: 'Courier New', monospace; white-space: pre-wrap; overflow-y: auto; flex-grow: 1; font-size: 13px; text-align: left; }
    .btn-run { padding: 5px 15px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; }

    .panel-left { 
    flex: 6; 
    border-right: 1px solid #444; 
    display: flex; 
    flex-direction: column; 
    height: 100%; /* Pastikan tingginya penuh */
}

#code {
    display: none;
}

    .app-wrapper {
        width: 100%;
        height: 500px;
        background: #1e1e1e;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

.btn-active {
    background: #3498db;
    color: white;
    cursor: pointer;
    opacity: 1;
}

.btn-disabled {
    background: #bdc3c7;
    color: #ffffff;
    cursor: not-allowed;
    opacity: 0.6;
}

.code-container {
    background: #1e1e2f;
    border-radius: 16px;
    padding: 20px;
    overflow-x: auto;
}

.code-box {
    margin: 0;
    font-family: 'Courier New', monospace;
    font-size: 15px;
    line-height: 1.4;
    color: #f8f8f2;
    user-select: none;
}

.refleksi-alert {
    background: #eef3ff;          /* biru lembut */
    border: 1px solid #d6e2ff;
    padding: 20px 25px;
    border-radius: 12px;
}

.refleksi-alert h5 {
    color: #1f3c88;
}

.refleksi-alert ul {
    padding-left: 18px;
}

.refleksi-alert li {
    line-height: 1.6;
}



</style>

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
        <div class="card-body materi-text">
            <h5 class="card-title">Tujuan Pembelajaran</h5> 
            <p>Setelah menyelesaikan materi pada bab ini, mahasiswa diharapkan mampu:</p>
            <ul>
                <li>menguraikan mekanisme langkah demi langkah pada algoritma Bubble Sort. </li>
                <li>mengimplementasikan kode program Bubble Sort. </li>
                <li>menganalisis efisiensi Bubble Sort pada berbagai kondisi data. </li>
            </ul>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">Pengertian BubbleSort</span>
            </div>
            <p class="card-text text-justify">
                Bubble Sort adalah algoritma pengurutan berbasis perbandingan yang bekerja dengan cara membandingkan elemen-elemen yang bersebelahan dalam suatu daftar, kemudian menukarnya jika urutannya salah. Proses ini diulang terus menerus hingga seluruh elemen tersusun dengan benar. Nama "Bubble Sort" diambil dari fakta bahwa elemen yang lebih besar "menggelembung" ke posisi akhir daftar, sementara elemen yang lebih kecil bergerak ke awal.<br><br>

                Jika terdapat n data, maka proses perbandingan dilakukan sebanyak n–1 kali dalam satu iterasi. Proses ini terus berlanjut hingga tidak ada lagi pertukaran data yang terjadi, yang berarti data sudah terurut dengan sempurna. Setiap satu kali pemeriksaan seluruh data disebut satu iterasi (siklus).
            </p>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-shuffle"></i>
                <span class="materi-badge">Cara Kerja</span>
            </div>
            <p class="card-text text-justify">
                Pada setiap langkah, dua elemen yang bersebelahan akan dibandingkan:
            </p>
            <ul class="card-text">
                <li>Jika elemen kiri lebih besar dari elemen kanan → tukar posisi.</li>
                <li>Jika elemen sudah berurutan → tidak terjadi pertukaran.</li>
            </ul>
            <p class="card-text text-justify">
                Langkah ini diulang dari awal sampai akhir kumpulan data. Setelah satu kali iterasi selesai, elemen terbesar akan berada di posisi paling akhir. Iterasi berikutnya dilakukan terhadap sisa data lainnya sampai semuanya terurut.
            </p>
        </div>
    </div>
</div>


<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="#" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','simulasi']) }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>


@endsection