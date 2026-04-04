@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/merge.css') }}">
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

@php
    // Cek apakah aktivitas simulasi ini sudah berstatus 'selesai' di database
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp


<!-- ===== Judul Materi dengan Box ===== -->
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

<!-- ===== Ilustrasi ===== -->
<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code-branch"></i>
                <span class="materi-badge">Simulasi Merge Sort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi kasus : </strong>Di sebuah gudang logistik, terdapat 5 karung beras dengan berat yang berbeda-beda, yaitu 8 kg, 3 kg, 9 kg, 4 kg, dan 6 kg. Karung-karung tersebut masih tersusun secara acak sehingga menyulitkan proses penyimpanan dan distribusi. Agar proses pengelolaan menjadi lebih efisien, karung beras perlu diurutkan dari berat terkecil hingga terbesar menggunakan algoritma Merge Sort.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Selesai!</h4>
                        <p>Seluruh data telah digabungkan dan terurut.</p>
                        <button class="btn btn-outline-success" onclick="resetSimulation()">Ulangi Simulasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($isSelesai)
    <div class="alert alert-success mt-3 mb-0">
        <i class="bi bi-check-circle-fill me-2"></i> 
        <strong>Selesai!</strong> Kamu sudah pernah menyelesaikan simulasi ini. Tombol navigasi di bawah sudah terbuka.
    </div>
@endif

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','materi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','program']) }}" 
       id="btnNextMergeSim"
       class="btn btn-primary {{ $isSelesai ? '' : 'disabled' }}" 
       {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
        Selanjutnya
    </a>

</div>

<script>
window.IMG_PATH = "{{ asset('images/aset/karung') }}/";
</script>
<script src="{{ asset('js/mergesort.js') }}"></script>

@if(!$isSelesai)
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Tangkap elemen kotak pesan selesai dan tombol selanjutnya
    const finishMessage = document.getElementById('finish-message');
    const btnNext = document.getElementById('btnNextMergeSim');

    // Buat pemantau (Observer) untuk melihat perubahan pada atribut "style"
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === "style") {
                // Cek apakah pesan selesai sudah tidak disembunyikan (display != none)
                const displayStyle = window.getComputedStyle(finishMessage).display;
                if (displayStyle !== 'none') {
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