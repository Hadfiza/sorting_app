@extends('layouts.hlmns') 

@section('css')
<link rel="stylesheet" href="{{ asset('css/siswa.css') }}">
@endsection


@section('content')


<div class="container-fluid py-4">

    {{-- =========================
        WELCOME BOX
    ========================== --}}
    <div class="welcome-box mb-4">
        <div>
            <h2>Selamat Datang, {{ auth()->user()->nama }}</h2>
            <p>Semangat belajar dan tingkatkan progresmu hari ini</p>
        </div>
    </div>

    {{-- =========================
        STATISTICS SECTION
    ========================== --}}
    <div class="row">

        {{-- KELAS --}}
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <h5>Kelas</h5>
                <h4>{{ $kelas ?? 0 }}</h4>
            </div>
        </div>

        {{-- NILAI --}}
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <h5>Nilai Saya</h5>
                <h3>{{ $nilai ?? 0 }}</h3>
            </div>
        </div>

        {{-- PROGRESS CIRCLE --}}
        <div class="col-md-4 mb-4 text-center">
            <div class="progress-wrapper">
                <div class="progress-circle" 
                     style="--progress: {{ $progress ?? 0 }};">
                    <span>{{ $progress ?? 0 }}%</span>
                </div>
                <p class="mt-3">Progres Belajar</p>
            </div>
        </div>

    </div>
</div>

@endsection