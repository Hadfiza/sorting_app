@extends('layouts.hlmnd')

@section('title', 'Pengaturan KKM')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white pb-0 pt-4 border-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning text-white rounded d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 45px; height: 45px;">
                                <i class="fa-solid fa-sliders fs-5"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold text-dark">Pengaturan KKM Kuis</h4>
                                <p class="text-muted small mt-1 mb-0">Atur kriteria kelulusan minimal untuk masing-masing topik algoritma.</p>
                            </div>
                        </div>

                        <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center gap-2 bg-light p-2 rounded-3 border">
                            <label class="fw-bold text-dark small mb-0 ms-2"><i class="fa-solid fa-clock-rotate-left me-1"></i> Histori KKM:</label>
                            <select name="tahun" class="form-select form-select-sm fw-bold border-secondary cursor-pointer" style="width: 130px;" onchange="this.form.submit()">
                                <option value="">-- Tahun Ini --</option>
                                @if(isset($tahun_list))
                                    @foreach($tahun_list as $thn)
                                        <option value="{{ $thn }}" {{ (isset($selected_tahun) && $selected_tahun == $thn) ? 'selected' : '' }}>
                                            {{ $thn }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </form>
                    </div>
                    <hr class="mt-4">
                </div>

                <div class="card-body pt-2">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
                            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('dosen.kkm.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4 p-3 bg-light rounded-3 border d-flex flex-column flex-md-row gap-3 align-items-md-center">
                            <div>
                                <label class="fw-bold text-dark mb-2"><i class="fa-solid fa-calendar-days me-2 text-primary"></i>Simpan / Perbarui Untuk Tahun Ajaran:</label>
                                <input type="number" name="tahun" class="form-control fw-bold text-primary fs-5" value="{{ $selected_tahun ?? date('Y') }}" required style="max-width: 200px;">
                            </div>
                            <div class="text-muted small border-md-start ps-md-3 mt-2 mt-md-0">
                                <i class="fa-solid fa-circle-info me-1"></i> Angka KKM di bawah akan disimpan khusus untuk tahun ajaran ini.<br>
                                Ubah angka tahun jika Anda ingin membuat KKM baru untuk angkatan selanjutnya.
                            </div>
                        </div>

                        <div class="row">
                            @forelse($aktivitas as $item)
                                @php
                                    // Default 75 jika dosen belum pernah mengatur KKM
                                    $nilaiKkm = isset($settings[$item->id]) ? $settings[$item->id]->kkm : 75;
                                @endphp
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="p-4 border rounded-4 shadow-sm h-100 transition-hover" style="background-color: #f8fafc; border-color: #e2e8f0 !important;">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h6 class="fw-bold mb-0 text-dark lh-base">
                                                <i class="fa-solid fa-file-signature text-primary me-2"></i>{{ $item->judul }}
                                                <span class="d-block mt-1 text-muted small"><i class="fa-regular fa-folder-open me-1"></i>{{ ucfirst($item->folder) }}</span>
                                            </h6>
                                        </div>
                                        
                                        <div class="mt-auto pt-3 border-top">
                                            <label class="form-label text-muted small fw-bold mb-2">Nilai Minimal Lulus:</label>
                                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-award text-warning"></i></span>
                                                <input type="number" name="kkm[{{ $item->id }}]" class="form-control fw-bold fs-5 text-center text-primary border-start-0 ps-0" 
                                                       value="{{ $nilaiKkm }}" required min="0" max="100" style="background-color: white;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning text-center rounded-3 border-0 shadow-sm py-4">
                                        <i class="fa-solid fa-triangle-exclamation fs-3 mb-2 d-block text-warning"></i> 
                                        <span class="fw-medium">Belum ada data aktivitas kuis yang tersedia di sistem.</span>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-4 pt-4 border-top text-end">
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm" {{ $aktivitas->isEmpty() ? 'disabled' : '' }} style="border-radius: 8px;">
                                <i class="fa-solid fa-save me-2"></i> Simpan KKM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover:hover {
        transform: translateY(-3px);
        transition: all 0.3s ease;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection