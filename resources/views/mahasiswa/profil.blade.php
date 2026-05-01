@extends('layouts.hlmns')

@section('title', 'Profil Saya')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-1">
    
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center">
            <i class="fa-solid fa-circle-check fs-4 me-3"></i> 
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <h6 class="fw-bold mb-2"><i class="fa-solid fa-triangle-exclamation me-2"></i>Terjadi Kesalahan:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $mahasiswa = auth()->user()->mahasiswa;
    @endphp

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header border-0 text-white p-4 p-md-3 position-relative" style="background: linear-gradient(135deg, #2563eb, #3b82f6);">
            <div class="position-absolute rounded-circle bg-white opacity-25" style="width: 150px; height: 150px; top: -50px; right: -20px; filter: blur(20px);"></div>
            <div class="position-absolute rounded-circle bg-info opacity-25" style="width: 100px; height: 100px; bottom: -30px; left: 20%; filter: blur(15px);"></div>
            
            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start position-relative z-1">
                
                <div class="me-md-4 mb-3 mb-md-0 position-relative">
                    @php
                        $fotoPath = ($mahasiswa && $mahasiswa->foto && file_exists(public_path('profil_mahasiswa/' . $mahasiswa->foto))) 
                            ? asset('profil_mahasiswa/' . $mahasiswa->foto)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nama) . '&background=ffffff&color=2563eb&size=200';
                    @endphp
                    <img src="{{ $fotoPath }}" alt="Foto Profil" class="rounded-circle border border-4 border-white shadow" style="width: 130px; height: 130px; object-fit: cover;">
                </div>
                
                <div class="text-center text-md-start mt-md-2">
                    <h2 class="fw-bold mb-1">{{ auth()->user()->nama }}</h2>
                    <p class="mb-2 text-light"><i class="fa-solid fa-envelope me-2"></i>{{ auth()->user()->email }}</p>
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm border">
                        <i class="fa-solid fa-user-graduate me-1"></i> Mahasiswa
                    </span>
                </div>

                <div class="ms-md-auto mt-4 mt-md-2">
                    <button type="button" class="btn btn-warning fw-bold rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                        <i class="fa-solid fa-user-pen me-2"></i> Edit Profil
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-3">
            <h5 class="fw-bold text-dark mb-4 border-bottom pb-3"><i class="fa-solid fa-id-card text-primary me-2"></i>Detail Informasi Mahasiswa</h5>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-4 border h-100">
                        <p class="text-muted small text-uppercase fw-bold mb-1">Nama Lengkap</p>
                        <h5 class="text-dark fw-bold mb-0">{{ auth()->user()->nama }}</h5>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-4 border h-100">
                        <p class="text-muted small text-uppercase fw-bold mb-1">Email Akun</p>
                        <h5 class="text-dark fw-bold mb-0">{{ auth()->user()->email }}</h5>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-4 border h-100">
                        <p class="text-muted small text-uppercase fw-bold mb-1">NIM (Nomor Induk Mahasiswa)</p>
                        <h5 class="text-dark fw-bold mb-0" style="font-family: monospace;">{{ $mahasiswa->nim ?? '-' }}</h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-4 border h-100">
                        <p class="text-muted small text-uppercase fw-bold mb-1">Kelas / Kelompok</p>
                        <h5 class="text-dark fw-bold mb-0">{{ $mahasiswa->kelas->nama_kelas ?? 'Belum terdaftar di kelas' }}</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #2563eb, #3b82f6);">
                <h5 class="modal-title fw-bold" id="editProfilModalLabel"><i class="fa-solid fa-user-pen me-2"></i>Edit Informasi Profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('mahasiswa.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 p-md-5">
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ auth()->user()->nama }}" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Email Akun</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control rounded-3" required>
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-light rounded-4 border border-dashed text-center">
                        <label class="form-label fw-bold text-secondary d-block mb-3"><i class="fa-solid fa-camera me-2"></i>Ubah Foto Profil</label>
                        <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg" class="form-control form-control-sm w-75 mx-auto rounded-3">
                        <small class="text-muted d-block mt-2">Maksimal 2MB. Format: JPG, PNG.</small>
                    </div>

                </div>
                
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa-solid fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
@endsection