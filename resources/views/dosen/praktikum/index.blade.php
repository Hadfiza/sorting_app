@extends('layouts.hlmnd')

@section('title', 'Praktikum')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
.title-card {
    background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);
    color: white;
    margin-top: 10px;
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

</style>

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Terjadi kesalahan saat menyimpan data.
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    @endif

    <div class="card title-card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Hasil Praktikum</h3>
                
                <a href="{{ route('dosen.praktikum.soal') }}" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                    <i class="bi bi-file-earmark-pdf-fill me-2 text-danger"></i> Kelola Soal PDF
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-4 align-items-center">

                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="height:45px;">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text"
                            name="search"
                            class="form-control border-start-0 ps-0"
                            style="height:45px;"
                            placeholder="Cari nama mahasiswa..."
                            value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <select name="kelas_id" class="form-select" style="height:45px;">
                        <option value="">Semua Kelas</option>

                        @foreach($kelases as $kelas)
                        <option value="{{ $kelas->id }}"
                            {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">

                    <button type="submit" 
                        class="btn btn-primary fw-bold flex-grow-1"
                        style="height:45px;">
                        <i class="bi bi-funnel"></i> Filter
                    </button>

                    @if(request()->has('search') || request()->has('kelas_id'))
                    <a href="{{ url()->current() }}" 
                    class="btn btn-primary d-flex align-items-center justify-content-center"
                    style="height:45px; width:45px;"
                    title="Reset Filter">

                    <i class="bi bi-arrow-repeat"></i>

                    </a>
                    @endif

                </div>

                </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Mahasiswa</th>
                            <th>Kelas</th>
                            <th>Judul Praktikum</th>
                            <th>Nilai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($praktikum as $item)
                        <tr>
                            <td class="ps-3">
                                <strong>{{ $item->mahasiswa->user->nama ?? 'N/A' }}</strong><br>
                                <small class="text-muted">{{ $item->mahasiswa->nim ?? '' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 fw-bold shadow-sm" style="font-size: 0.85rem;">
                                    {{ $item->mahasiswa->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $item->praktikum->judul }}</td>
                            <td>
                                @if($item->nilai)
                                    <span class="fw-bold text-success">{{ $item->nilai }}</span>
                                @else
                                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis border border-warning px-3">Belum Dinilai</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ url('dosen/praktikum/'.$item->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Detail
                                    </a>
                                    <button type="button" class="btn btn-sm btn-success rounded-pill px-3" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#feedbackModal{{ $item->id }}">
                                        Feedback
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="feedbackModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ url('dosen/praktikum/update/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-light border-0">
                                            <h5 class="modal-title fw-bold">Penilaian: {{ $item->mahasiswa->user->nama }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body py-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Nilai Praktikum (0-100)</label>
                                                <input type="number" name="nilai" class="form-control form-control-lg" 
                                                       value="{{ $item->nilai }}" min="0" max="100" required>
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label fw-semibold">Feedback / Catatan Dosen</label>
                                                <textarea name="feedback" class="form-control" rows="4" 
                                                          placeholder="Contoh: Logika pengurutan sudah benar, tingkatkan efisiensi kode...">{{ $item->feedback }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary px-4">Simpan Nilai</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted small italic">Tidak ada data mahasiswa ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection