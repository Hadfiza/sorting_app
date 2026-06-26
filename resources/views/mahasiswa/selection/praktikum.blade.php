@extends('layouts.hlmns')

@section('title','Praktikum Selection Sort')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

@php
    // 1. Cek apakah aktivitas ini sudah masuk tabel progres_mahasiswa
    $isSelesai = in_array($item->id, $progresSelesai);

    // 2. Ambil relasi mahasiswa dari user yang sedang login
    $mahasiswa = auth()->user()->mahasiswa;

    // 3. AMBIL DATA SOAL PRAKTIKUM (JUDUL, DESKRIPSI, PDF)
    $praktikumData = \App\Models\Praktikum::where('id_aktivitas', $item->id)->first();
    
    // 4. Cari data pengumpulan praktikum mahasiswa ini
    $submission = null;
    if ($mahasiswa) {
        $submission = \App\Models\PengumpulanPraktikum::where('id_mahasiswa', $mahasiswa->id)
                        ->where('id_praktikum', $praktikumData ? $praktikumData->id : 0) 
                        ->first();
    }
@endphp


<style>
/* =========================
   CODEMIRROR
========================= */

.live-editor {
    width: 100%;
    height: 500px;
    background: #1e1e1e;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    margin-top: 20px;
}

/* Header */
.live-editor .editor-header {
    padding: 10px 20px;
    background: #2d2d2d;
    border-bottom: 1px solid #444;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
}

.live-editor .editor-header h1 {
    margin: 0;
    font-size: 1rem;
}

/* Split layout */
.live-editor .split-container {
    display: flex;
    flex: 1;
    overflow: hidden;
}

/* Panel kiri */
.live-editor .panel-left {
    flex: 6;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #444;
}

/* Panel kanan */
.live-editor .panel-right {
    flex: 4;
    display: flex;
    flex-direction: column;
    background: #101010;
}

/* Label */
.live-editor .panel-label {
    background: #333;
    color: #ccc;
    padding: 5px 15px;
    font-size: 0.75rem;
    text-transform: uppercase;
}

/* CodeMirror */
.live-editor .CodeMirror {
    flex: 1;
    font-size: 14px;
}

/* Output */
.live-editor #output {
    flex: 1;
    padding: 15px;
    color: #00ff00;
    font-family: 'Courier New', monospace;
    white-space: pre-wrap;
    overflow-y: auto;
    font-size: 13px;
}

/* Run button */
.live-editor .btn-run {
    padding: 5px 15px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
}

/* ========================================= */
/* ===== TABEL SORTING MODERN =====          */
/* ========================================= */
.praktikum-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 16px;
    font-size: 15px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
}

.praktikum-table th {
    background: #f8fafc;
    color: #1e293b;
    font-weight: 700;
    padding: 12px;
    text-align: center;
    border-bottom: 2px solid #e5e7eb;
}

.praktikum-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #f1f5f9;
    background: white;
}

.praktikum-table td:first-child,
.praktikum-table th:first-child {
    text-align: left;
    font-weight: 600;
}

.praktikum-table td:not(:first-child) {
    font-family: 'Courier New', Courier, monospace;
    color: #2563eb;
    font-weight: 700;
}

@media (max-width: 768px) {

    .pdf-container iframe {
        width: 100%;
        height: 60vh;
        border-radius: 8px;
    }

    .live-editor {
        height: auto;
    }

    .live-editor .split-container {
        flex-direction: column;
        gap: 10px; /* biar ada jarak */
    }

    .live-editor .panel-left,
    .live-editor .panel-right {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    /* ===== SAMAKAN AREA ISI ===== */
    .live-editor .panel-left textarea,
    .live-editor .CodeMirror,
    .live-editor #output {
        height: 200px !important;
    }

    .live-editor .CodeMirror {
        flex: none !important;
        height: 200px !important;
    }

    .CodeMirror {
        height: 200px !important;
        overflow: hidden !important;
    }

    /* CodeMirror scroll */
    .CodeMirror-scroll {
        height: 200px !important;
        overflow-y: auto !important;   /* scroll vertikal */
        overflow-x: auto !important;
    }
    /* OUTPUT */
    .live-editor #output {
        flex: none !important;
        overflow-y: auto;
        overflow-x: auto;
    }

}
</style>

<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma BubbleSort</h3>
            </div>
        </div>
    </div>
</div>

{{-- <div class="materi-page">
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-shuffle"></i>
                <span class="materi-badge">Soal Praktikum</span>
            </div>
            <p class="card-text text-justify">
                Sebuah program akademik ingin menampilkan urutan nilai UAS mahasiswa dari nilai yang paling rendah hingga yang paling tinggi. Data mahasiswa disimpan menggunakan struktur list of dictionary, dengan setiap dictionary berisi informasi:
            </p>
            <ul class="card-text">
                <li>Nama mahasiswa</li>
                <li>Nilai mahasiswa</li>
                <li>Nomor induk mahasiswa</li>
            </ul>
            <div class="my-4">
                <img 
                    src="{{ asset('images/bubble/praktikumbubble.png') }}" 
                    alt="praktikum bubbleSort"
                    class="img-fluid"
                    style="max-width: 300px;"
                >
            </div>

            <p class="card-text text-justify">
                Data mahasiswa yang tersedia seperti gambar diatas.<br>
                Bagian akademik meminta Anda membuat program Python untuk:<br>
            <ol class="card-text">
                <li>Mengurutkan data mahasiswa berdasarkan nilai UAS dari yang paling rendah ke tertinggi</li>
                <li>Sorting dilakukan menggunakan algoritma Bubble Sort manual, bukan fungsi sort() atau sorted().</li>
                <li>Fungsi Bubble Sort harus dapat menerima index key (misalnya 'uas') sebagai dasar pengurutan.</li>
                <li>Setelah pengurutan selesai, tampilkan daftar mahasiswa sesuai urutan nilai UAS tersebut.</li>
            </ol>
            </p>
        </div>
    </div> --}}

<div class="materi-page">
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fa-sharp-duotone fa-solid fa-shuffle"></i>
                <span class="materi-badge">Soal Praktikum</span>
            </div>

            @if($praktikumData)
                {{-- <div class="mb-4">
                    <h4 class="fw-bold text-dark">{{ $praktikumData->judul }}</h4>
                    <p class="text-muted text-justify" style="font-size: 15px;">{{ $praktikumData->deskripsi }}</p>
                </div> --}}

                @if($praktikumData->file_soal)
                    <div class="p-2 rounded shadow-sm border" style="background-color: #f8fafc; border-color: #cbd5e1 !important;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 border-bottom bg-light rounded-top mb-2">
                            <i class="fa-solid fa-file-pdf text-danger fs-5"></i>
                            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">File Soal Praktikum</h5>
                            <a href="{{ asset('soal_praktikum/' . $praktikumData->file_soal) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-auto fw-bold">
                                <i class="fa-solid fa-expand"></i> Layar Penuh
                            </a>
                        </div>
                        
                        {{-- <iframe src="{{ asset('storage/soal_praktikum/' . $praktikumData->file_soal) }}"
                                width="100%" height="600px"
                                style="border: none; border-radius: 8px;">
                        </iframe> --}}
                     
                        <iframe 
                            src="{{ asset('soal_praktikum/' . $praktikumData->file_soal) }}" 
                            width="100%" 
                            height="500"
                            class="d-none d-md-block">
                        </iframe>

                        <a href="{{ asset('soal_praktikum/' . $praktikumData->file_soal) }}" 
                        target="_blank"
                        class="btn btn-danger d-md-none mt-3">
                            📄 Buka PDF
                        </a>
                    </div>
                @else
                    <div class="alert alert-warning mb-0 border-0 shadow-sm">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Dosen belum mengunggah file PDF untuk praktikum ini.
                    </div>
                @endif
            @else
                <div class="alert alert-warning mb-0 border-0 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> Data soal praktikum belum diatur oleh dosen di sistem.
                </div>
            @endif
        </div>
    </div>

    <div class="alert alert-info">
        <b>Instruksi:</b>
        <ol class="mb-0 mt-2">
            <li>Perhatikan Soal praktikum diatas.</li>
            <li>Ketikkan kode jawaban pada kode editor di bawah ini.</li>
            <li>Klik tombol <b>Run Code</b> untuk menjalankan program.</li>
            <li>Pastikan <b>output berhasil muncul</b> pada bagian Console Output.</li>
            <li>Jika sudah sesuai, klik tombol <b>Submit Praktikum</b> dibawah untuk mengumpulkan jawaban.</li>
        </ol>
    </div>

    <div class="card mb-4">
        <div class="card-body materi-text">
            {{-- <p>Cobalah jalankan kode Bubble Sort di bawah ini untuk melihat bagaimana Python memproses datanya.</p> --}}
          
            <div class="live-editor">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        <button id="runBtn" class="btn-run" disabled>Run Code</button>
                    </div>
                </header>
                <div class="split-container">
                    <div class="panel-left">
                        <div class="panel-label">Input Kode</div>
                        <textarea id="code">{{ $submission ? $submission->kode_program : '' }}</textarea>
                        </div>

                    <div class="panel-right">
                        <div class="panel-label">Console Output</div>
                        <div id="output"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fa-solid fa-pen-to-square"></i>
                <span class="materi-badge">Penjelasan Kode & Pengumpulan</span>
            </div>

            @if($submission)
                <div class="alert alert-success mb-4">
                    <i class="fa-solid fa-check-circle me-1"></i> <strong>Praktikum telah dikumpulkan!</strong> 
                    Kode program dan penjelasan Anda sudah tersimpan dengan aman. Anda masih dapat memperbaruinya jika diinginkan.
                    
                    @if($submission->status == 'dinilai')
                        <hr>
                        <div class="mt-2">
                            <span class="badge bg-primary fs-6 me-2">Nilai: {{ $submission->nilai }}</span>
                            <strong>Catatan Dosen:</strong> {{ $submission->feedback_dosen ?? 'Tidak ada catatan.' }}
                        </div>
                    @endif
                </div>
            @else
                <div class="alert alert-info mb-4">
                    <strong>Instruksi:</strong> Tuliskan penjelasan mengenai alur kerja algoritma Selection Sort yang telah Anda buat pada kode di atas. Jika sudah yakin, klik tombol <strong>Submit Praktikum</strong> untuk mengumpulkan jawaban Anda.
                </div>
            @endif
            <div class="mb-4">
                <label for="penjelasanMahasiswa" class="form-label fw-bold">Penjelasan Kode Algoritma:</label>
                <textarea 
                    id="penjelasanMahasiswa"
                    class="form-control"
                    rows="6"
                    placeholder="Jelaskan secara singkat namun jelas bagaimana algoritma Selection Sort Anda bekerja..."
                >{{ $submission ? $submission->penjelasan : '' }}</textarea>
                </div>

            <div class="text-end">
                <button id="submitBtn" class="btn {{ $submission ? 'btn-secondary' : 'btn-primary' }} px-4 py-2" style="font-weight: 600;" {{ $submission ? 'disabled' : '' }}>
                    <i class="fa-solid {{ $submission ? 'fa-lock' : 'fa-paper-plane' }} me-1"></i> 
                    {{ $submission ? 'Telah Dikumpulkan' : 'Submit Praktikum' }}
                </button>
            </div>
        </div>
    </div>
    
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="{{ route('mahasiswa.aktivitas.show',['selection','quiz']) }}" 
       class="btn btn-outline-secondary">
       Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','materi']) }}" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       id="btnNextPraktikum" 
       @if(!$isSelesai) tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;" @endif>
       Lanjut
    </a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
const PRAKTIKUM_ID = 2;
const AKTIVITAS_ID = {{ $item->id }};
const TANDAI_SELESAI_URL = "{{ route('mahasiswa.aktivitas.tandai_selesai') }}";
const SUBMIT_URL = "{{ route('mahasiswa.praktikum.submit') }}";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection