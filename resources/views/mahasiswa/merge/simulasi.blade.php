@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/merge.css') }}">
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')


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

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','materi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','program']) }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>

</div>

<script>
window.IMG_PATH = "{{ asset('images/aset/karung') }}/";
</script>
<script src="{{ asset('js/mergesort.js') }}"></script>

@endsection