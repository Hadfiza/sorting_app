@extends('layouts.hlmns')

@section('title','Simulasi Insertion Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/insertion.css') }}">
@endsection

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

@section('content')

@php
    // Cek apakah aktivitas simulasi ini sudah berstatus 'selesai' di database
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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

            <div class="mb-3">
                <button class="btn btn-outline-primary btn-sm"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#instruksiSimulasi">
                    <i class="fas fa-info-circle me-1"></i>
                    Instruksi Simulasi
                </button>

                <div class="collapse mt-2" id="instruksiSimulasi">
                    <div class="card card-body bg-light">
                        <ol class="mb-0">
                            <li>Bacalah studi kasus yang disajikan untuk memahami permasalahan pengurutan data.</li>
                            <li>Perhatikan data yang sedang diproses pada setiap iterasi.</li>
                            <li>Amati proses perbandingan antara data yang diproses dengan data pada bagian yang telah terurut.</li>
                            <li>Analisis hasil perbandingan untuk menentukan posisi yang sesuai bagi data tersebut.</li>
                            <li>Perhatikan proses pergeseran dan penyisipan data yang terjadi selama simulasi.</li>
                            <li>Pilih jawaban yang sesuai berdasarkan hasil analisis Anda hingga seluruh data tersusun sesuai urutan yang ditentukan.</li>
                        </ol>
                    </div>
                </div>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi kasus : </strong>Di sebuah kantor administrasi, seorang staf ingin merapikan kartu nama klien yang masih tersusun acak di atas meja agar mudah dicari berdasarkan urutan abjad. Ia tidak mengurutkannya sekaligus, melainkan mengambil satu kartu, membandingkannya dengan kartu di sebelah kiri, menggeser kartu yang lebih besar, lalu menyisipkannya ke posisi yang tepat hingga kartu-kartu tersusun rapi. Pada simulasi ini, kamu akan melihat proses tersebut berlangsung langkah demi langkah sampai semua kartu tersusun sesuai abjad menggunakan metode Insertion Sort.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Pengurutan Selesai!</h4>
                        <button class="btn btn-outline-success" onclick="resetSimulation()">Ulangi Simulasi</button>
                    </div>
                </div>

                <div id="alertKompleksitas" class="alert alert-info mt-3 {{ $isSelesai ? '' : 'd-none' }}">
                    <b>Penjelasan Kompleksitas:</b>
                    <ol class="mb-0 mt-2">
                        <li>Pada simulasi ini, data awal <b>[Budi, Sinta, Yahya, Akmal, Fitri]</b> belum terurut berdasarkan abjad sehingga Insertion Sort perlu membandingkan dan menyisipkan beberapa data ke posisi yang sesuai. Kondisi ini termasuk <b>average case</b> dengan kompleksitas waktu <b>O(n²)</b>.</li>
                        <li>Jika data sudah atau hampir terurut sejak awal, misalnya <b>[Akmal, Budi, Fitri, Sinta, Yahya]</b>, Insertion Sort hanya perlu melakukan sedikit pergeseran data. Kondisi ini disebut <b>best case</b> dengan kompleksitas waktu <b>O(n)</b>.</li>
                        <li>Jika data terurut secara terbalik, misalnya <b>[Yahya, Sinta, Fitri, Budi, Akmal]</b>, setiap elemen harus digeser berkali-kali untuk menemukan posisi yang tepat. Kondisi ini disebut <b>worst case</b> dengan kompleksitas waktu <b>O(n²)</b>.</li>
                </div>

            </div>
        </div>
    </div>
</div>

@if($isSelesai)
    <div class="alert alert-success mt-3 mb-0">
        <i class="bi bi-check-circle-fill me-2"></i> 
        <strong>Selesai!</strong> Anda sudah pernah menyelesaikan simulasi ini. Tombol navigasi di bawah sudah terbuka.
    </div>
@endif

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','materi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>
    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','program']) }}" 
       id="btnNextInsertionSim"
       class="btn btn-primary {{ $isSelesai ? '' : 'disabled' }}" 
       {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
        Selanjutnya
    </a>

</div>


<script>
window.IMG_PATH = "{{ asset('images/aset/nama') }}/";
</script>
<script src="{{ asset('js/insertionsort.js') }}"></script>

@if(!$isSelesai)
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Tangkap elemen kotak pesan selesai dan tombol selanjutnya
    const finishMessage = document.getElementById('finish-message');
    const btnNext = document.getElementById('btnNextInsertionSim');
    const alertKompleksitas = document.getElementById('alertKompleksitas');

    // Buat pemantau (Observer) untuk melihat perubahan pada atribut "style"
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === "style") {
                // Cek apakah pesan selesai sudah tidak disembunyikan (display != none)
                const displayStyle = window.getComputedStyle(finishMessage).display;
                if (displayStyle !== 'none') {
                    // document.getElementById('alertKompleksitas').style.display = 'block';
                    alertKompleksitas.classList.remove('d-none');
                    simpanProgresSimulasi(); // Simpan progres
                    observer.disconnect();   // Matikan pemantau agar tidak dipanggil berkali-kali
                }
            }
        });
    });

    // Mulai memantau div finish-message
    if(finishMessage) {
        observer.observe(finishMessage, { attributes: true });
    }

    // Fungsi AJAX untuk menembak ke database
    function simpanProgresSimulasi() {
        fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                id_aktivitas: {{ $item->id }} // Mengirimkan ID materi simulasi saat ini
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // BUKA GEMBOK TOMBOL SELANJUTNYA
                btnNext.classList.remove('disabled');
                btnNext.removeAttribute('tabindex');
                btnNext.removeAttribute('aria-disabled');
                btnNext.style.pointerEvents = 'auto';
                btnNext.style.opacity = '1';
                
                // Tambahkan efek visual halus
                btnNext.classList.add('shadow-lg');
            }
        })
        .catch(error => console.error("Gagal menyimpan progres:", error));
    }
});
</script>
@endif

@endsection
