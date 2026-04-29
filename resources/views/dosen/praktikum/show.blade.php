@extends('layouts.hlmnd')

@section('title', 'Show-Praktikum')


<style>
/* Header Styling */
.title-card {
    background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);
    color: white;
}

.title-card .card-body {
    padding: 24px 30px;
}

.title-card h3 {
    font-size: 28px;
    font-weight: 700;
    color: white;
}

.title-card p.text-muted {
    color: rgba(255, 255, 255, 0.85) !important;
    font-size: 16px;
    margin-top: 8px;
}

/* Navigasi & Breadcrumb */
.nav-wrapper {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.btn-back {
    border: 1.5px solid #2563eb;
    color: #2563eb;
    border-radius: 30px;
    padding: 5px 20px;
    font-weight: 600;
    transition: all 0.3s;
    text-decoration: none;
    font-size: 14px;
}

.btn-back:hover {
    background: #2563eb;
    color: white;
}

.breadcrumb-custom {
    font-size: 15px;
    color: #64748b;
}

.breadcrumb-custom a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
}

/* Code & Output Styling */
.code-box {
    background: #1a1a1a;
    color: #00ff88;
    padding: 20px;
    border-radius: 10px;
    font-family: 'Fira Code', monospace;
    font-size: 0.9rem;
    border: 1px solid #333;
}
</style>

@section('content')
<div class="container py-4">

    <div class="nav-wrapper">
        <a href="{{ url('dosen/praktikum') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <div class="breadcrumb-custom">
            <a href="{{ url('dosen/praktikum') }}">Daftar Praktikum</a> 
            <span class="mx-2 text-muted">/</span> 
            <span class="text-dark fw-bold">Detail Pengumpulan</span>
        </div>
    </div>

    <div class="card title-card mb-4">
        <div class="card-body py-4">
            <h3 class="mb-0"> Detail Praktikum {{ $praktikum->judul }}</h3>
        </div>
    </div>

    @foreach($pengumpulan as $item)
    <div class="card shadow-sm border-0 mb-4 overflow-hidden">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-bold text-dark">{{ $item->mahasiswa->user->nama ?? 'Mahasiswa' }}</h5>
                <small class="text-muted">{{ $item->mahasiswa->nim ?? '-' }} | Kelas {{ $item->mahasiswa->kelas->nama_kelas ?? '-' }}</small>
            </div>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                Status: {{ ucfirst($item->status) }}
            </span>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <label class="fw-bold text-primary mb-2 small text-uppercase">Penjelasan:</label>
                <div class="p-3 bg-light rounded border-start border-primary border-4" style="white-space: pre-wrap;">
                    {{ $item->penjelasan }}</div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <label class="fw-bold text-primary mb-2 small text-uppercase">Kode Program:</label>
                    <pre class="code-box"><code>{{ $item->kode_program }}</code></pre>
                </div>
                <div class="col-md-5">
                    <label class="fw-bold text-primary mb-2 small text-uppercase">Output:</label>
                    <pre class="bg-dark text-white p-3 rounded" style="font-size: 0.85rem; height: auto;">{{ $item->output }}</pre>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection