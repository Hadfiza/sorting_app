@extends('layouts.hlmnd')

@section('title', 'Pengaturan KKM')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white pb-0 pt-4 border-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-white rounded d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                            <i class="fa-solid fa-sliders fs-5"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-dark">Pengaturan KKM Kuis</h4>
                            <p class="text-muted small mt-1 mb-0">Atur kriteria kelulusan minimal untuk masing-masing topik algoritma.</p>
                        </div>
                    </div>
                    <hr>
                </div>
                
                <div class="card-body pt-2">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('dosen.kkm.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            @forelse($aktivitas as $item)
                                @php
                                    // Default 75 jika dosen belum pernah mengatur KKM
                                    $nilaiKkm = isset($settings[$item->id]) ? $settings[$item->id]->kkm : 75;
                                @endphp
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="p-4 border rounded shadow-sm h-100" style="background-color: #f8fafc; border-color: #e2e8f0 !important;">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h6 class="fw-bold mb-0 text-dark lh-base">
                                                <i class="fa-solid fa-file-signature text-primary me-2"></i>{{ $item->judul }}
                                                <span>{{ ucfirst($item->folder) }}</span>
                                            </h6>
                                            
                                        </div>
                                        
                                        <div class="mt-auto pt-3 border-top">
                                            <label class="form-label text-muted small fw-bold mb-2">Nilai Minimal Lulus:</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white"><i class="fa-solid fa-award text-warning"></i></span>
                                                <input type="number" name="kkm[{{ $item->id }}]" class="form-control fw-bold fs-5 text-center text-primary" 
                                                       value="{{ $nilaiKkm }}" required min="0" max="100" style="background-color: white;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning text-center">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Belum ada data aktivitas kuis yang tersedia di sistem.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-4 pt-3 border-top text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" {{ $aktivitas->isEmpty() ? 'disabled' : '' }} style="border-radius: 8px;">
                                <i class="fa-solid fa-save me-2"></i> Simpan KKM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection