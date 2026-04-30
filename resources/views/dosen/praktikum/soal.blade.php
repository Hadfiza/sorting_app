@extends('layouts.hlmnd')
@section('title', 'Kelola Soal Praktikum')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark"><i class="fa-solid fa-file-pdf text-danger me-2"></i>Kelola Soal Praktikum</h3>
            <p class="text-muted">Unggah file soal berformat PDF untuk masing-masing topik praktikum di bawah ini.</p>
        </div>
        <a href="{{ route('dosen.praktikum.index') }}" class="btn btn-outline-secondary fw-bold rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Penilaian
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0"><i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger shadow-sm border-0"><i class="fa-solid fa-triangle-exclamation me-2"></i>Terjadi kesalahan saat mengunggah file. Pastikan file berformat PDF dan maksimal 5MB.</div>
    @endif

    <div class="row">
        @forelse($aktivitas as $item)
            @php
                $praktikumData = $item->praktikum; // Mengambil data dari relasi
            @endphp
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-top: 4px solid #2563eb !important;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-1">{{ $item->judul }}</h5>
                        <p class="text-muted small mb-4"><i class="fa-solid fa-folder-open me-1"></i> Modul: {{ ucfirst($item->folder) }}</p>

                        <form action="{{ route('dosen.praktikum.simpanSoal', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Judul Praktikum (Tampil di Mahasiswa)</label>
                                <input type="text" name="judul" class="form-control" value="{{ $praktikumData->judul ?? $item->judul }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Deskripsi Singkat</label>
                                <textarea name="deskripsi" class="form-control" rows="2" required>{{ $praktikumData->deskripsi ?? 'Kerjakan praktikum sesuai instruksi pada modul PDF berikut.' }}</textarea>
                            </div>
                            
                            <div class="mb-3 p-3 bg-light rounded border border-dashed">
                                <label class="form-label fw-semibold text-danger small"><i class="fa-solid fa-upload me-1"></i> File PDF Soal Baru</label>
                                <input type="file" name="file_soal" class="form-control form-control-sm" accept=".pdf">
                                
                                @if($praktikumData && $praktikumData->file_soal)
                                    <div class="mt-2 pt-2 border-top">
                                        <span class="badge bg-success-subtle text-success border border-success"><i class="fa-solid fa-check"></i> File Tersimpan:</span>
                                        <a href="{{ asset('storage/soal_praktikum/' . $praktikumData->file_soal) }}" target="_blank" class="ms-1 small text-decoration-none fw-bold">{{ $praktikumData->file_soal }}</a>
                                    </div>
                                @else
                                    <div class="mt-2 pt-2 border-top">
                                        <span class="badge bg-secondary-subtle text-secondary"><i class="fa-solid fa-xmark"></i> Belum ada soal PDF</span>
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill"><i class="fa-solid fa-save me-2"></i>Simpan Modul Ini</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">Belum ada topik praktikum di sistem.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection