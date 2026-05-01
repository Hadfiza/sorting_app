@extends('layouts.hlmnd')

@section('title', 'Manajemen Soal' )

@section('content')
<style>
    .card-panel { border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
    .table-soal tbody tr:hover { background-color: #f8f9fa; transition: all 0.2s; }
    .th-header { text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; color: #6c757d; border-bottom-width: 2px; }
    .soal-text { max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
</style>

<div class="container-fluid py-4 px-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-panel bg-white mb-4 border">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div>
                    {{-- <span class="badge bg-primary bg-opacity-10 text-primary mb-2 px-3 py-2 rounded-pill fw-semibold">
                        <i class="fa-solid fa-database me-1"></i> Manajemen Quiz & Evaluasi
                    </span> --}}
                    <h2 class="fw-bold text-dark mb-1">Kelolo Kuis & Evaluasi</h2>
                    <p class="text-muted mb-0">Kelola Durasi, pertanyaan, dan kunci jawaban untuk setiap materi.</p>
                </div>
                
                <div class="mt-4 mt-md-0">
                    <div class="d-flex flex-column gap-2">
                        <!-- Tombol 1: Tambah Soal -->
                        <button type="button" class="btn btn-primary rounded-3 shadow-sm px-4 py-2 fw-medium text-start" data-bs-toggle="modal" data-bs-target="#modalTambahSoal" onclick="resetModal()">
                            <i class="fa-solid fa-plus me-2"></i> Tambah Soal Baru
                        </button>
                        
                        <!-- Tombol 2: Atur Durasi -->
                        <button type="button" class="btn btn-primary rounded-3 shadow-sm px-4 py-2 fw-medium text-start" data-bs-toggle="modal" data-bs-target="#modalAturDurasi">
                            <i class="fa-solid fa-stopwatch me-2"></i> Atur Durasi Pengerjaan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-panel bg-white mb-4 border">
        <div class="card-body p-3">
            <form action="{{ route('dosen.soal.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-12 col-md-9">
                    <select name="id_aktivitas" class="form-select fw-medium">
                        <option value="">-- Tampilkan Semua Materi / Kuis --</option>
                        @foreach($aktivitasList as $akt)
                            <option value="{{ $akt->id }}" {{ request('id_aktivitas') == $akt->id ? 'selected' : '' }}>
                                {{ $akt->nama }} ({{ ucfirst($akt->tipe) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-dark flex-grow-1 fw-bold"><i class="fa-solid fa-filter me-1"></i> Filter Materi</button>
                    @if(request()->has('id_aktivitas'))
                        <a href="{{ route('dosen.soal.index') }}" class="btn btn-light border" title="Reset Filter"><i class="fa-solid fa-rotate-right"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card card-panel bg-white border">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-soal align-middle mb-0 border-top-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center" style="width: 80px;">No.</th>
                            <th scope="col" class="py-3 th-header fw-bold border-start">Aktivitas / Materi</th>
                            <th scope="col" class="py-3 th-header fw-bold border-start">Tipe</th>
                            <th scope="col" class="py-3 th-header fw-bold border-start">Pertanyaan</th>
                            <th scope="col" class="py-3 th-header fw-bold text-center border-start">Kunci / Aturan JSON</th>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center border-start" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soals as $soal)
                        <tr>
                            <td class="px-4 py-3 text-center fw-bold text-secondary">{{ $soal->nomor }}</td>
                            <td class="py-3 border-start">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">
                                    {{ $soal->aktivitas->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3 border-start text-uppercase small fw-bold text-muted">{{ $soal->tipe }}</td>
                            <td class="py-3 border-start">
                                <div class="soal-text text-dark" title="{{ strip_tags($soal->pertanyaan) }}">
                                    {!! Str::limit(strip_tags($soal->pertanyaan), 60) !!}
                                </div>
                            </td>
                            <td class="py-3 text-center border-start">
                                @if($soal->tipe === 'dragdrop')
                                    <span class="text-success fw-medium font-monospace" style="font-size: 0.75rem;" title="{{ $soal->jawaban_benar }}">
                                        {{ Str::limit($soal->jawaban_benar, 30) }}
                                    </span>
                                @else
                                    <span class="badge bg-success fs-6 text-uppercase">{{ $soal->jawaban_benar }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center border-start">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="editSoal({{ $soal }})" title="Edit Soal">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    
                                    <form action="{{ route('dosen.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Soal">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-1 d-block mb-3 opacity-25"></i>
                                Belum ada butir soal pada materi ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahSoal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-4">
            
            <form id="formSoal" action="{{ route('dosen.soal.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">

                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalSoalTitle"><i class="fa-solid fa-pen-to-square text-primary me-2"></i> Formulir Butir Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="row g-3">
                        
                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-muted text-uppercase">Materi / Aktivitas <span class="text-danger">*</span></label>
                            <select name="id_aktivitas" id="input_id_aktivitas" class="form-select" required>
                                <option value="">-- Pilih Materi --</option>
                                @foreach($aktivitasList as $akt)
                                    <option value="{{ $akt->id }}">{{ $akt->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nomor Soal <span class="text-danger">*</span></label>
                            <input type="number" name="nomor" id="input_nomor" class="form-control" required min="1" placeholder="Misal: 1">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tipe Soal <span class="text-danger">*</span></label>
                            <select name="tipe" id="input_tipe" class="form-select" onchange="togglePilihanGanda()" required>
                                <option value="pilgan">Pilihan Ganda</option>
                                <option value="essay">Essay</option>
                                <option value="truefalse">Benar / Salah</option>
                                <option value="dragdrop">Drag & Drop (JSON)</option>
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-muted text-uppercase">Kunci Jawaban Benar <span class="text-danger">*</span></label>
                            <input type="text" name="jawaban_benar" id="input_jawaban_benar" class="form-control" required placeholder="">
                            <small id="hint_jawaban" class="text-primary mt-1 d-block fw-medium" style="font-size: 0.75rem;">
                                </small>
                        </div>

                        <div class="col-12 mt-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Pertanyaan / Instruksi <span class="text-danger">*</span></label>
                            <textarea name="pertanyaan" id="input_pertanyaan" class="form-control" rows="4" required placeholder="Ketik instruksi/pertanyaan di sini..."></textarea>
                        </div>

                        <div class="col-12 mt-4" id="areaPilihanGanda">
                            <label class="form-label fw-bold small text-muted text-uppercase border-bottom pb-2 mb-3 d-block">Opsi Pilihan Ganda</label>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold bg-light">A</span>
                                        <input type="text" name="pilihan_a" id="input_pilihan_a" class="form-control" placeholder="Pilihan A">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold bg-light">B</span>
                                        <input type="text" name="pilihan_b" id="input_pilihan_b" class="form-control" placeholder="Pilihan B">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold bg-light">C</span>
                                        <input type="text" name="pilihan_c" id="input_pilihan_c" class="form-control" placeholder="Pilihan C">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold bg-light">D</span>
                                        <input type="text" name="pilihan_d" id="input_pilihan_d" class="form-control" placeholder="Pilihan D">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="modal-footer border-top-0 pt-0 pb-4 justify-content-end">
                    <button type="button" class="btn btn-light border fw-medium px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-medium px-4"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan Soal</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- MODAL ATUR DURASI -->
<div class="modal fade" id="modalAturDurasi" tabindex="-1" aria-labelledby="modalAturDurasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-slate-50 border-bottom-0">
                <h5 class="modal-title font-bold text-slate-700" id="modalAturDurasiLabel">
                    <i class="fa-solid fa-stopwatch text-blue-600 me-2"></i> Pengaturan Durasi Kuis & Evaluasi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info text-sm rounded-xl">
                    <i class="fa-solid fa-circle-info me-2"></i> Atur batas waktu pengerjaan (dalam menit) untuk masing-masing kuis.
                </div>

                <div class="table-responsive border rounded-xl">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-secondary text-sm">Nama Kuis / Evaluasi</th>
                                <th class="text-secondary text-sm text-center" width="250px">Durasi (Menit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- HANYA MENAMPILKAN TIPE QUIZ & EVALUASI, DAN MENGGUNAKAN NAMA BUKAN JUDUL -->
                            @foreach(\App\Models\Aktivitas::whereIn('tipe', ['quiz', 'evaluasi'])->get() as $akt)
                            <tr>
                                <td class="font-bold text-slate-700">{{ $akt->nama }}</td>
                                <td>
                                    <form action="{{ route('dosen.aktivitas.durasi', $akt->id) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        <input type="number" name="durasi" class="form-control form-control-sm text-center font-bold" value="{{ $akt->durasi ?? 60 }}" min="1" required>
                                        <button type="submit" class="btn btn-sm btn-primary px-3 rounded-lg"><i class="fa-solid fa-save"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi Menyembunyikan/Menampilkan Elemen berdasarkan Tipe Soal
    function togglePilihanGanda() {
        const tipeSelect = document.getElementById('input_tipe');
        const areaPilgan = document.getElementById('areaPilihanGanda');
        const hintJawaban = document.getElementById('hint_jawaban');
        const inputJawaban = document.getElementById('input_jawaban_benar');

        // Pengamanan: Cegah error jika elemen tidak ditemukan di DOM
        if (!tipeSelect || !areaPilgan || !hintJawaban || !inputJawaban) return;

        const tipe = tipeSelect.value;

        if (tipe === 'pilgan') {
            areaPilgan.style.display = 'block';
            hintJawaban.innerText = "Ketik satu huruf saja (a, b, c, atau d).";
            inputJawaban.placeholder = "Contoh: a";
        } 
        else if (tipe === 'dragdrop') {
            // Sembunyikan opsi ABCD karena DragDrop menggunakan JSON di jawaban_benar
            areaPilgan.style.display = 'none'; 
            hintJawaban.innerText = "Masukkan format JSON. Contoh: {\"source\":[5,2,8],\"correct\":[2,5,8]}";
            inputJawaban.placeholder = '{"source":[5,2,8],"correct":[2,5,8]}';
        }
        else if (tipe === 'truefalse') {
            areaPilgan.style.display = 'none';
            hintJawaban.innerText = "Ketik 'true' untuk Benar, atau 'false' untuk Salah.";
            inputJawaban.placeholder = "true / false";
        }
        else {
            // Default (misal: essay)
            areaPilgan.style.display = 'none';
            hintJawaban.innerText = "Ketik teks yang menjadi kunci kata untuk Essay.";
            inputJawaban.placeholder = "Jawaban essay...";
        }
    }

    // Fungsi Reset Form Saat Tombol "Tambah Soal" diklik
    function resetModal() {
        const modalTitle = document.getElementById('modalSoalTitle');
        const formSoal = document.getElementById('formSoal');
        const methodField = document.getElementById('methodField');

        if (modalTitle) modalTitle.innerHTML = '<i class="fa-solid fa-plus text-primary me-2"></i> Tambah Soal Baru';
        if (formSoal) {
            formSoal.action = "{{ route('dosen.soal.store') }}";
            formSoal.reset();
        }
        if (methodField) methodField.value = "POST";
        
        // Panggil untuk mereset tampilan sesuai pilihan default (biasanya pilgan)
        togglePilihanGanda();
    }

    // Fungsi Memasukkan Data Saat Tombol "Edit" diklik
    function editSoal(soal) {
        document.getElementById('modalSoalTitle').innerHTML = '<i class="fa-solid fa-pen text-primary me-2"></i> Edit Butir Soal';
        
        // Ubah action form menjadi update
        let url = "{{ route('dosen.soal.update', ':id') }}";
        url = url.replace(':id', soal.id);
        
        document.getElementById('formSoal').action = url;
        document.getElementById('methodField').value = "PUT";

        // Isi form dengan data soal
        if (document.getElementById('input_id_aktivitas')) document.getElementById('input_id_aktivitas').value = soal.id_aktivitas;
        if (document.getElementById('input_nomor')) document.getElementById('input_nomor').value = soal.nomor;
        
        // Pilih tipe yang sesuai dan paksa update tampilan
        if (document.getElementById('input_tipe')) {
            document.getElementById('input_tipe').value = soal.tipe;
        }

        if (document.getElementById('input_pertanyaan')) document.getElementById('input_pertanyaan').value = soal.pertanyaan;
        if (document.getElementById('input_jawaban_benar')) document.getElementById('input_jawaban_benar').value = soal.jawaban_benar;
        
        if (document.getElementById('input_pilihan_a')) document.getElementById('input_pilihan_a').value = soal.pilihan_a || '';
        if (document.getElementById('input_pilihan_b')) document.getElementById('input_pilihan_b').value = soal.pilihan_b || '';
        if (document.getElementById('input_pilihan_c')) document.getElementById('input_pilihan_c').value = soal.pilihan_c || '';
        if (document.getElementById('input_pilihan_d')) document.getElementById('input_pilihan_d').value = soal.pilihan_d || '';

        // Sesuaikan tampilan area pilihan ganda dengan data yang diload
        togglePilihanGanda();

        // Tampilkan Modal
        const modalElement = document.getElementById('modalTambahSoal');
        if (modalElement) {
            new bootstrap.Modal(modalElement).show();
        }
    }

    // Jalankan pemeriksaan tipe soal saat halaman pertama kali dimuat
    document.addEventListener("DOMContentLoaded", function() {
        togglePilihanGanda();
    });


document.addEventListener('DOMContentLoaded', function () {
    // Cari semua tombol close di dalam modal
    let closeButtons = document.querySelectorAll('.modal .btn-close, .modal [data-bs-dismiss="modal"]');
    
    closeButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Hilangkan fokus dari tombol segera setelah diklik
            this.blur();
        });
    });
});
</script>
@endsection