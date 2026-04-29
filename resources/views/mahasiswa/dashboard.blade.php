@extends('layouts.hlmns')

@section('css')
<link rel="stylesheet" href="{{ asset('css/siswa.css') }}">

<style>

    /* Pembatas Antar Kolom */
    .panel-divider {
        border-right: 1px solid #e9ecef;
    }

    .welcome-box {
        padding: 20px 24px; /* 🔥 sebelumnya pasti besar */
        border-radius: 16px;
    }

    .welcome-box h2 {
        font-size: 1.5rem; /* 🔥 kecilkan dari default */
        margin-bottom: 4px;
    }

    .welcome-box p {
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Hover card */
    .stat-card-modern {
        transition: all .25s ease;
    }

    .stat-card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }

    /* Progress circle */
    .progress-circle-baru {
        width:130px;
        height:130px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;

        background: conic-gradient(
            #2563eb calc(var(--progress) * 1%), 
            #e2e8f0 0
        );

        position:relative;
        box-shadow:0 4px 10px rgba(0,0,0,0.05);
    }

    .progress-circle-baru::before {
        content:"";
        position:absolute;
        width:100px;
        height:100px;
        background:white;
        border-radius:50%;
    }

    .progress-circle-baru span {
        position:relative;
        z-index:1;
        font-size:1.5rem;
        font-weight:800;
        color:#1e293b;
    }

    @media (max-width: 991px) {
        .panel-divider {
            border-right: none;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
    }

</style>
@endsection


@section('content')

<div class="container-fluid pt-2 ">
    
    {{-- WELCOME --}}
    <div class="welcome-box mb-4">
        <div>
            <h2>Selamat Datang, {{ auth()->user()->nama }}</h2>
            <p>Semangat belajar dan tingkatkan progresmu hari ini</p>
        </div>
    </div>


    <div class="bg-white p-3 p-md-5 rounded-4 shadow-sm border">

        <div class="row d-flex align-items-stretch g-4">

            {{-- KOLOM 1 --}}
            <div class="col-lg-4 panel-divider pe-lg-4 d-flex flex-column justify-content-between h-100">

                <div class="d-flex flex-column gap-3 h-100">

                    {{-- CARD KELAS --}}
                    <div class="p-3 p-xl-4 rounded-4 stat-card-modern flex-grow-1 d-flex flex-column justify-content-center"
                         style="background:#eff6ff;border:1px solid #dbeafe;">

                        <div class="d-flex align-items-center gap-3">

                            <div class="rounded-circle d-flex justify-content-center align-items-center flex-shrink-0"
                                 style="width:55px;height:55px;background:#dbeafe;color:#2563eb;font-size:1.3rem;">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>

                            <div>
                                <p class="text-muted small fw-bold text-uppercase mb-1 tracking-wide">
                                    Kelas Anda
                                </p>

                                <h4 class="fw-bold text-dark mb-0">
                                    {{ $kelas ?? 'Belum ada kelas' }}
                                </h4>
                            </div>

                        </div>
                    </div>


                    {{-- CARD NILAI --}}
                    <div class="p-3 p-xl-4 rounded-4 stat-card-modern flex-grow-1 d-flex flex-column justify-content-center"
                         style="background:#eff6ff;border:1px solid #dbeafe;">

                        <div class="d-flex align-items-center gap-3">

                            <div class="rounded-circle d-flex justify-content-center align-items-center flex-shrink-0"
                                 style="width:55px;height:55px;background:#fde68a;color:#b45309;font-size:1.3rem;">
                                <i class="fa-solid fa-star"></i>
                            </div>

                            <div>
                                <p class="text-muted small fw-bold text-uppercase mb-1 tracking-wide">
                                    Total Nilai
                                </p>

                                <h4 class="fw-bold text-dark mb-0">
                                    {{ $nilai ?? 0 }}
                                    <span class="fs-6 text-muted fw-normal">/ 100</span>
                                </h4>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            {{-- KOLOM 2 --}}
            <div class="col-lg-4 panel-divider text-center px-lg-4 d-flex flex-column justify-content-center align-items-center py-3 h-100">

                <div class="progress-circle-baru mb-3"
                     style="--progress: {{ $progress ?? 0 }};">

                    <span>{{ $progress ?? 0 }}%</span>

                </div>

                <h6 class="fw-bold text-dark text-uppercase tracking-wide mt-2">
                    Progres Belajar
                </h6>

                <p class="small text-muted mb-0 px-3">
                    Selesaikan aktivitas untuk menaikkan progres!
                </p>

            </div>

            {{-- KOLOM 3 --}}
            <div class="col-lg-4 ps-lg-4 d-flex">

                <div class="p-4 rounded-4 text-white shadow-sm d-flex flex-column justify-content-between stat-card-modern w-100 flex-grow-1"
                     style="background:linear-gradient(135deg,#2563eb 0%,#1d4ed8 100%);">

                    <div>

                        <span class="badge bg-white bg-opacity-25 text-white mb-3 rounded-pill px-3 py-2">
                            <i class="fa-solid fa-rocket me-1"></i> Aktivitas
                        </span>

                        <h4 class="fw-bold mb-2">
                            Algoritma Sorting
                        </h4>

                        <p class="text-white opacity-75 small mb-4">
                            Mari lanjutkan membaca materi, menjalankan simulasi, atau berlatih coding.
                        </p>

                    </div>


                    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','sorting']) }}"
                       class="btn btn-light text-primary fw-bold rounded-pill w-100 py-2 shadow-sm d-flex justify-content-center align-items-center gap-2 mt-auto">

                        Lanjutkan Belajar
                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection