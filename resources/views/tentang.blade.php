@extends('layouts.landing_layouts')

@section('title', 'Tentang - SortLearn')

<style>
    .judul-halaman{
        padding-top: 70px;
    }

    @media (max-width: 768px){
        .judul-halaman{
            padding-top: 0px;
        }
        
    }
</style>

@section('content')
<div class="container py-4">

    <!-- JUDUL -->
    <h1 class="judul-halaman mb-4">
        Informasi Aplikasi
    </h1>

    <!-- CARD -->
    <div class="card card-custom border-0 shadow">

        <div class="card-body p-4 p-md-5">

            <h3 class="mb-4 fw-semibold text-light">Informasi Pembuat</h3>

            <div class="row mb-3">
                <div class="col-md-3 label">Nama</div>
                <div class="col-md-9">HADFIZA</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 label">NIM</div>
                <div class="col-md-9">2210131210012</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 label">Dosen Pembimbing 1</div>
                <div class="col-md-9">Muhammad Hifdzi Adini, S.Kom., M.T.</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 label">Dosen Pembimbing 2</div>
                <div class="col-md-9">Ihdalhubbi Maulida, S.Kom., M.Kom</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 label">Jurusan</div>
                <div class="col-md-9">Pendidikan Komputer</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 label">Fakultas</div>
                <div class="col-md-9">Keguruan dan Ilmu Pengetahuan</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 label">Institusi</div>
                <div class="col-md-9">Universitas Lambung Mangkurat</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 label">Judul Media</div>
                <div class="col-md-9">
                    Pengembangan Media Pembelajaran Interaktif Berbasis Web Materi Sorting Struktur Data dengan Model Tutorial
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 label">Tahun</div>
                <div class="col-md-9">2026</div>
            </div>

        </div>
    </div>

    <!-- CARD -->
    <div class="card card-custom border-0 shadow mt-4">

        <div class="card-body p-4 p-md-5">
            <div class="dapus">
                <h3 class="mb-4 fw-semibold text-light">Daftar Pustaka</h3>
                <ul>
                    <li>yaaya</li>
                </ul>
            </div>

            <div class="atribusi">
                <h3 class="mb-4 fw-semibold text-light">Atribusi</h3>
                <ul>
                    <li>Canva</li>
                </ul>
            </div>



        </div>
    </div>

</div>

<style>
/* ===== BACKGROUND HALAMAN ===== */
body {
    background: linear-gradient(135deg, #e0f2ff, #f0f7ff);
}

/* ===== JUDUL ===== */
.judul-halaman {
    font-weight: 700;
    color: #1e3a8a;
}

/* ===== CARD ===== */
.card-custom {
    background: linear-gradient(135deg, #1e3a8a, #2563eb);
    border-radius: 20px;
    color: #e0e7ff;
}

/* ===== LABEL KIRI ===== */
.label {
    color: #38bdf8;
    font-weight: 600;
}

/* ===== RESPONSIVE BIAR GA KEPANJANGAN ===== */
.container {
    max-width: 1000px;
}
</style>
@endsection