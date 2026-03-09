@extends('layouts.hlmnd')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dosen.css') }}">
@endsection

@section('title','Dashboard Dosen')

@section('content')

<div class="container-fluid py-4">

    <!-- WELCOME -->
    <div class="welcome-box mb-4">
        <h2>Selamat Datang, {{ auth()->user()->nama }}</h2>
        <p>Kelola kelas dan nilai mahasiswa dengan mudah.</p>
    </div>

    <div class="row">

        <!-- KELAS -->
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-green">
                <h5>Kelas</h5>
                <h3>{{ $kelas ?? 0 }}</h3>
            </div>
        </div>

        <!-- JUMLAH MAHASISWA -->
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-blue">
                <h5>Jumlah Mahasiswa</h5>
                <h3>{{ $jumlahMahasiswa ?? 0 }}</h3>
            </div>
        </div>

        <!-- KKM -->
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-yellow position-relative">

                <!-- TITIK 3 -->
                <div class="dropdown position-absolute top-0 end-0 p-2">
                    <a href="#" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#kkmModal">
                                Edit KKM
                            </a>
                        </li>
                    </ul>
                </div>

                <h5>KKM</h5>
                <h3>{{ $kkm ?? 75 }}</h3>

            </div>
        </div>

    </div>

</div>

<!-- MODAL EDIT KKM -->
<div class="modal fade" id="kkmModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('dosen.setKkm') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atur KKM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Nilai KKM</label>
                <input type="number" name="kkm" class="form-control" 
                       value="{{ $kkm ?? 75 }}" required min="0" max="100">
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </form>
  </div>
</div>

@endsection