@extends('layouts.hlmnd')

@section('title','Dashboard Dosen')

<style>
    .card-panel { border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
    .stat-icon { width: 55px; height: 55px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.5rem; }
    .table-hover tbody tr:hover { background-color: #f8f9fa; transition: 0.2s; }
    .progress { height: 10px; border-radius: 10px; background-color: #e9ecef; }

    #dashboard-wrapper {
    background: linear-gradient(145deg, #eef4ff, #f7faff);
    padding: 28px;
    border-radius: 24px;
    /* margin: 20px; */
    box-shadow: 
        0 10px 30px rgba(0,0,0,0.04),
        0 1px 2px rgba(0,0,0,0.03);
}
</style>

@section('content')


<div class="container-fluid py-4 px-4" id="dashboard-wrapper">

    <div class="card card-panel bg-white mb-4 border border-light">
        <div class="card-body p-4">
            <h3 class="fw-bold text-dark mb-1">Selamat Datang, Pak {{ auth()->user()->nama ?? auth()->user()->name }}</h3>
            <p class="text-muted mb-0">Pantau performa dan tingkat penyelesaian kelas Anda di sini.</p>
        </div>
    </div>

    <div class="row mb-4 g-3 row-cols-5">
        <div class="col">
            <div class="card card-panel border-0 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1 tracking-wide">Jumlah Kelas</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $jumlahKelas }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-panel border-0 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1 tracking-wide">Mahasiswa</p><br>
                        <h3 class="fw-bold text-dark mb-0">{{ $jumlahMahasiswa }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-panel border-0 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1 tracking-wide">Nilai Tertinggi</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $nilaiTertinggi }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-panel border-0 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3">
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1 tracking-wide">
                            Nilai Terendah
                        </p>
                        <h3 class="fw-bold text-dark mb-0">{{ $nilaiTerendah }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-panel border-0 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-info bg-opacity-10 text-info me-3">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1 tracking-wide">Progress Tertinggi</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $progresTertinggi }}%</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="card card-panel bg-white mb-4 border">
        <div class="card-body p-3">
            <form action="" method="GET" class="row g-2 align-items-center">
                <div class="col-12 col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama mahasiswa..." value="{{ request('search') }}">
                </div>
                <div class="col-12 col-md-4">
                    <select name="kelas_id" class="form-select">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 fw-bold"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                    @if(request()->has('search') || request()->has('kelas_id'))
                        <a href="{{ url()->current() }}" class="btn btn-light border" title="Reset Filter"><i class="fa-solid fa-rotate-right"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card card-panel bg-white border">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-bars-progress text-primary me-2"></i> Progress Mahasiswa</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th class="px-4 py-3" style="width: 5%;">No</th>
                            <th class="py-3" style="width: 25%;">Nama Mahasiswa</th>
                            <th class="py-3" style="width: 15%;">NIM</th>
                            <th class="py-3" style="width: 15%;">Kelas</th>
                            <th class="px-4 py-3" style="width: 40%;">Tingkat Penyelesaian (Progress)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $index => $mahasiswa)
                        <tr>
                            <td class="px-4 fw-medium text-muted">{{ $index + 1 }}</td>
                            <td class="fw-bold text-dark">{{ $mahasiswa->user->nama ?? $mahasiswa->user->name ?? 'Siswa' }}</td>
                            <td class="text-muted">{{ $mahasiswa->nim }}</td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1">
                                    {{ $mahasiswa->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-grow-1">
                                        <div class="progress border">
                                            @php
                                                $prog = $mahasiswa->progress_percentage;
                                                $bgColor = $prog < 40 ? 'bg-danger' : ($prog < 75 ? 'bg-warning' : 'bg-success');
                                            @endphp
                                            <div class="progress-bar {{ $bgColor }} progress-bar-striped progress-bar-animated" 
                                                 role="progressbar" 
                                                 style="width: {{ $prog }}%;" 
                                                 aria-valuenow="{{ $prog }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-bold text-dark" style="min-width: 45px;">{{ $prog }}%</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox fs-2 d-block mb-2 opacity-50"></i>
                                Belum ada data mahasiswa untuk kelas ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection