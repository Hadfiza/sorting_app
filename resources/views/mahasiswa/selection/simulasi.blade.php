@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/selection.css') }}">
@endsection

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

/* ===============================
   SIMULASI SELECTION SORT
   =============================== */

.can-container {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin: 25px 0;
}

.can-img-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    border-radius: 12px;
    transition: 0.3s ease;
}

/* Angka nilai */
.can-value {
    font-weight: bold;
    font-size: 1.1rem;
    margin-top: 5px;
}

/* IDX */
.can-index {
    font-size: 0.85rem;
    color: #666;
    margin-top: 3px;
}

/* ===============================
   HIGHLIGHT POSISI
   =============================== */

/* Posisi i (target swap) */
.current-pos {
    border: 3px solid #27ae60;
    background: #eafaf1;
}

/* Minimum sementara */
.min-found {
    border: 3px solid #f39c12;
    background: #fff4e6;
}

/* Yang sedang dibandingkan */
.scanning {
    border: 3px solid #3498db;
    background: #eaf3ff;
}

/* ===============================
   BUTTON STYLE
   =============================== */

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 15px;
}

.btn-sim {
    padding: 10px 22px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: 0.2s ease;
    color: white;
}

/* Hover effect */
.btn-sim:hover {
    transform: translateY(-2px);
}

/* Mulai scanning */
.btn-start {
    background: #3498db;
}

/* Jawaban Ya */
.btn-yes {
    background: #27ae60;
}

/* Jawaban Tidak */
.btn-no {
    background: #e74c3c;
}

/* Lanjut scan */
.btn-next {
    background: #9b59b6;
}

/* Tukar */
.btn-swap-action {
    background: #e67e22;
}

.simulation-wrapper {
    max-height: 600px;
    overflow-y: auto;
}

</style>

<!-- ===== Judul Materi dengan Box ===== -->
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

<!-- ===== Ilustrasi ===== -->
<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-play-circle"></i>
                <span class="materi-badge">Simulasi SelectionSort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi kasus : </strong>Di sebuah gudang penyimpanan, terdapat beberapa kaleng makanan dengan tanggal kedaluwarsa (EXP) yang berbeda-beda. Kaleng-kaleng tersebut masih tersusun secara acak sehingga berisiko menyebabkan kaleng dengan tanggal kedaluwarsa lebih dekat terlewat saat distribusi. Oleh karena itu, diperlukan proses pengurutan kaleng makanan berdasarkan tanggal EXP paling awal hingga paling akhir. Untuk menyelesaikan permasalahan ini, digunakan algoritma Selection Sort, yang bekerja dengan cara memilih data dengan nilai terkecil pada setiap iterasi lalu menempatkannya di posisi yang sesuai.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Selesai!</h4>
                        <p>Data sudah terurut sempurna menggunakan Selection Sort.</p>
                        <button class="btn btn-outline-success" onclick="resetSimulation()">Ulangi Simulasi</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['selection','materi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['selection','program']) }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>

</div>

<script>
window.IMG_PATH = "{{ asset('images/aset/kaleng') }}/";
</script>
<script src="{{ asset('js/selectionsort.js') }}"></script>

@endsection
