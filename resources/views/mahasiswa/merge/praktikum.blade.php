@extends('layouts.hlmns')

@section('title','MergeSort')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- ===========================================================
     CSS KHUSUS ILUSTRASI (Diambil dari kode simulasi Anda)
     Saya hapus style 'body' agar tidak merusak layout utama
   =========================================================== --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


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



<div class="materi-page">
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
    </div>



    <div class="card mb-4">
        <div class="card-body materi-text">
            <p>Cobalah jalankan kode Bubble Sort di bawah ini untuk melihat bagaimana Python memproses datanya.</p>
          
            <div class="live-editor">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        {{-- <span id="status" style="font-size: 0.8rem; color: #aaa;">⏳ Loading Pyodide...</span> --}}
                        <button id="runBtn" class="btn-run" disabled>Run Code</button>
                        <button id="submitBtn" class="btn-run" style="background:#007bff;">Submit</button>
                    </div>
                </header>
                <div class="split-container">
                    <div class="panel-left">
                        <div class="panel-label">Input Kode</div>
                        <textarea id="code"></textarea>
                    </div>

                    <div class="panel-right">
                        <div class="panel-label">Console Output</div>
                        <div id="output"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <label class="form-label"><strong>Penjelasan Kode</strong></label>
            <textarea 
                id="penjelasanMahasiswa"
                class="form-control"
                rows="4"
                placeholder="Jelaskan bagaimana algoritma Bubble Sort Anda bekerja..."
            ></textarea>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
const PRAKTIKUM_ID = 4;
const SUBMIT_URL = "{{ route('mahasiswa.praktikum.submit') }}";
</script>
<script src="{{ asset('js/editor.js') }}"></script>


@endsection