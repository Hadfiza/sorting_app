@extends('layouts.hlmnd')

@section('content')
<style>
    .card-panel {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.001);
        transition: all 0.2s;
    }
    .progress {
        height: 8px;
        border-radius: 10px;
        background-color: #e9ecef;
    }
    .avatar-circle {
        width: 45px;
        height: 45px;
        font-size: 1.2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>

<div class="container py-4">
    <div class="card card-panel bg-white mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div>
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-2 px-3 py-2 rounded-pill fw-semibold">
                        <i class="bi bi-people-fill me-1"></i> Manajemen Mahasiswa
                    </span>
                    <h2 class="fw-bold text-dark mb-1">Daftar Mahasiswa</h2>
                    <p class="text-muted mb-0">Kelola data, pantau progres, dan atur kelas mahasiswa Anda.</p>
                </div>
                <div class="mt-4 mt-md-0">
                    <div class="bg-light px-4 py-3 rounded-4 border text-center">
                        <span class="d-block text-secondary small fw-bold mb-1 text-uppercase tracking-wide">Total Mahasiswa</span>
                        <span class="fs-3 fw-bold text-dark">{{ $mahasiswas->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card card-panel bg-white border">
        <div class="card-body p-0 p-md-4">
            <div class="table-responsive rounded-4">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-secondary fw-bold border-bottom-0">Profil Mahasiswa</th>
                            <th scope="col" class="px-4 py-3 text-secondary fw-bold border-bottom-0 text-center">NIM & Angkatan</th>
                            <th scope="col" class="px-4 py-3 text-secondary fw-bold border-bottom-0 text-center">Kelas</th>
                            <th scope="col" class="px-4 py-3 text-secondary fw-bold border-bottom-0" style="min-width: 200px;">Progres Belajar</th>
                            <th scope="col" class="px-4 py-3 text-secondary fw-bold border-bottom-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $mahasiswa)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if($mahasiswa->photo)
                                        <img src="{{ asset('storage/'.$mahasiswa->photo) }}" class="avatar-circle object-fit-cover shadow-sm">
                                    @else
                                        <div class="avatar-circle bg-primary bg-opacity-10 text-primary shadow-sm">
                                            {{ strtoupper(substr($mahasiswa->user->name ?? 'M', 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold text-dark fs-6">{{ $mahasiswa->user->nama ?? 'Nama Mahasiswa' }}</div>
                                        <div class="text-muted small"><i class="bi bi-envelope"></i> {{ $mahasiswa->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                <div class="fw-bold text-dark">{{ $mahasiswa->nim }}</div>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border">Angkatan {{ $mahasiswa->angkatan }}</span>
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2 fs-6 rounded-pill">
                                    {{ $mahasiswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 border-start">
                                @php
                                    // Placeholder progres (Nanti bisa diganti dengan perhitungan dari database)
                                    // Misal: $progres = $mahasiswa->hitungProgres();
                                    $progres = min(100, 40 + ($mahasiswa->id * 7) % 60);
                                    $color = $progres >= 75 ? 'success' : ($progres >= 50 ? 'primary' : 'warning');
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="small fw-medium text-muted">Penyelesaian Materi</span>
                                    <span class="small fw-bold text-{{ $color }}">{{ $progres }}%</span>
                                </div>
                                <div class="progress shadow-sm">
                                    <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $progres }}%" aria-valuenow="{{ $progres }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-3 d-flex align-items-center gap-1" 
                                        data-id="{{ $mahasiswa->id }}"
                                        data-nama="{{ $mahasiswa->user->name ?? '' }}"
                                        data-nim="{{ $mahasiswa->nim }}"
                                        data-angkatan="{{ $mahasiswa->angkatan }}"
                                        data-id_kelas="{{ $mahasiswa->id_kelas }}"
                                        onclick="openEditModal(this)" title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                    
                                    <form action="{{ route('dosen.datamahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengeluarkan mahasiswa ini dari kelas? Data nilainya mungkin akan ikut terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 d-flex align-items-center gap-1" title="Hapus Data">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-person-x fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                <h6 class="fw-bold text-muted">Belum ada mahasiswa yang bergabung ke kelas Anda.</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editMahasiswaModal" tabindex="-1" aria-labelledby="editMahasiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="editMahasiswaModalLabel">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditMahasiswa" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="alert alert-info py-2 small mb-4 d-flex gap-2 align-items-center">
                        <i class="bi bi-info-circle-fill"></i> Mengedit nama/email harus dilakukan oleh mahasiswa di menu profil mereka.
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium text-muted small">Nama Lengkap (Read-Only)</label>
                        <input type="text" class="form-control bg-light" id="edit_nama" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nim" class="form-label fw-medium">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nim" name="nim" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_angkatan" class="form-label fw-medium">Angkatan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_angkatan" name="angkatan" required min="2000" max="2100">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="edit_id_kelas" class="form-label fw-medium">Pindah Kelas <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_id_kelas" name="id_kelas" required>
                            @foreach($kelases as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm fw-medium">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(button) {
        // Ambil data dari atribut tombol
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const nim = button.getAttribute('data-nim');
        const angkatan = button.getAttribute('data-angkatan');
        const id_kelas = button.getAttribute('data-id_kelas');

        // Set action form
        document.getElementById('formEditMahasiswa').action = `/dosen/datamahasiswa/${id}`;
        
        // Isi input form di dalam modal
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_nim').value = nim;
        document.getElementById('edit_angkatan').value = angkatan;
        document.getElementById('edit_id_kelas').value = id_kelas;

        // Tampilkan Modal
        var editModal = new bootstrap.Modal(document.getElementById('editMahasiswaModal'));
        editModal.show();
    }
</script>
@endsection