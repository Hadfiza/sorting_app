@extends('layouts.hlmnd')

@section('title','Kelas')

@section('content')
<style>
    .kelas-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        border: 1px solid #dee2e6;
    }
    .kelas-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        border-color: #0d6efd;
    }
    .token-box {
        background-color: #ffffff;
        border: 1px dashed #ced4da;
        border-radius: 8px;
        padding: 8px 12px;
    }

    .card-body{

    }
</style>

<div class="container py-4">
    
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
                <div class="mb-3 mb-md-0">
                    <h2 class="fw-bold text-dark mb-0">Manajemen Kelas</h2>
                    <p class="text-muted mb-0 mt-1">Kelola kelas praktikum dan bagikan token ke mahasiswa.</p>
                </div>
                <button type="button" class="btn btn-primary shadow-sm px-4 py-2 rounded-3 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#kelasModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                    Tambah Kelas
                </button>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <strong>Terjadi Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="p-4 rounded-4 border" style="background-color:#e3edff;">
                <h5 class="fw-bold text-secondary mb-4 d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                        <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                        <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                    </svg>
                    Daftar Kelas Aktif
                </h5>
                
                <div class="row g-4">
                    @forelse($kelases as $kelas)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm kelas-card bg-white position-relative">
                            <div class="card-body p-4">
                                
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title fw-bold text-dark mb-0 pe-3">{{ $kelas->nama_kelas }}</h5>
                                    
                                    <div class="dropdown">
                                        <button class="btn btn-link text-secondary p-0 text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius: 10px;">
                                            <li>
                                                <button type="button" class="dropdown-item d-flex align-items-center gap-2" 
                                                    onclick="openEditModal({{ $kelas->id }}, '{{ addslashes($kelas->nama_kelas) }}')">
                                                    <i class="bi bi-pencil-square text-primary"></i> Edit Nama Kelas
                                                </button>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('dosen.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                                        <i class="bi bi-trash"></i> Hapus Kelas
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="token-box d-flex justify-content-between align-items-center mt-4">
                                    <span class="text-secondary small fw-medium">Token Kelas:</span>
                                    <span class="text-primary fw-bold font-monospace fs-5 tracking-wide">{{ $kelas->token }}</span>
                                </div>

                            </div>
                            {{-- <div class="card-footer bg-transparent border-top-0 p-4 pt-0 d-flex justify-content-end">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-medium">
                                    Lihat Mahasiswa &rarr;
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center p-5 bg-white rounded-4 border border-dashed shadow-sm">
                            <h5 class="text-muted fw-bold">Belum ada kelas</h5>
                            <p class="text-muted small">Anda belum membuat kelas apapun. Klik "Tambah Kelas" untuk memulai.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div> </div>
    </div> </div>

<div class="modal fade" id="kelasModal" tabindex="-1" aria-labelledby="kelasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="kelasModalLabel">Buat Kelas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dosen.kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    {{-- nama kelas --}}
                    <div class="mb-4">
                        <label for="nama_kelas" class="form-label fw-medium">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg fs-6" id="nama_kelas" name="nama_kelas" placeholder="Contoh: Struktur Data A" required>
                    </div>
                    {{-- tahun ajaran --}}
                    <div class="mb-3">
                        <label for="tahun_ajaran" class="form-label font-bold text-slate-700">Tahun Ajaran</label>
                        <input type="number" class="form-control rounded-xl" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh: 2026" min="2020" max="2099" required>
                    </div>
                    {{-- token --}}
                    <div class="mb-2">
                        <label for="token" class="form-label fw-medium">Token Akses <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control text-center font-monospace fs-5 bg-light tracking-wide" id="token" name="token" readonly required>
                            <button class="btn btn-secondary px-3" type="button" onclick="generateToken()" title="Generate Ulang Token">
                                <i class="bi bi-arrow-repeat"></i> Ganti
                            </button>
                        </div>
                        <div class="form-text mt-2 text-muted"><small>Berikan token ini ke mahasiswa agar mereka bisa bergabung.</small></div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm">Simpan Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editKelasModal" tabindex="-1" aria-labelledby="editKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="editKelasModalLabel">Edit Nama Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditKelas" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="edit_nama_kelas" class="form-label fw-medium">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg fs-6" id="edit_nama_kelas" name="nama_kelas" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm">Update Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // 1. Script Generate Token (Tambah Kelas)
    function generateToken() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let token = '';
        for (let i = 0; i < 6; i++) {
            token += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        const tokenInput = document.getElementById('token');
        if(tokenInput) {
            tokenInput.style.opacity = '0.3';
            setTimeout(() => { tokenInput.value = token; tokenInput.style.opacity = '1'; }, 150);
        }
    }

    // Auto-generate saat modal tambah terbuka
    document.addEventListener('DOMContentLoaded', function () {
        var kelasModal = document.getElementById('kelasModal');
        if (kelasModal) {
            kelasModal.addEventListener('show.bs.modal', function () {
                const tokenInput = document.getElementById('token');
                if(!tokenInput.value) { generateToken(); }
            });
        }
    });

    // 2. Script Buka Modal Edit
    function openEditModal(id, nama_kelas) {
        // Set action url
        const form = document.getElementById('formEditKelas');
        form.action = `/dosen/kelas/${id}`; 
        // Set input value
        document.getElementById('edit_nama_kelas').value = nama_kelas;
        // Tampilkan modal
        var editModal = new bootstrap.Modal(document.getElementById('editKelasModal'));
        editModal.show();
    }
</script>
@endsection