@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('content')

{{-- ===========================================================
     CSS KHUSUS ILUSTRASI (Diambil dari kode simulasi Anda)
     Saya hapus style 'body' agar tidak merusak layout utama
   =========================================================== --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


<style>
 

    /* CSS EDITOR PYTHON (Disesuaikan agar muat di dalam Card) */
    .app-wrapper {
        width: 100%;
        height: 500px;
        background: #1e1e1e;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }
    .editor-header { padding: 10px 20px; background: #2d2d2d; border-bottom: 1px solid #444; display: flex; justify-content: space-between; align-items: center; color: white; }
    .editor-header h1 { margin: 0; font-size: 1rem; }
    .split-container { display: flex; flex: 1; overflow: hidden; border-top: 1px solid #444; }

    .panel-right { flex: 4; display: flex; flex-direction: column; background: #101010; height: 100%; }
    .panel-label { background: #333; color: #ccc; padding: 5px 15px; font-size: 0.75rem; text-transform: uppercase; }
    .CodeMirror { flex-grow: 1; height: 100% !important; font-size: 14px; text-align: left; }
    #output { padding: 15px; color: #00ff00; font-family: 'Courier New', monospace; white-space: pre-wrap; overflow-y: auto; flex-grow: 1; font-size: 13px; text-align: left; }
    .btn-run { padding: 5px 15px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; }

    .panel-left { 
    flex: 6; 
    border-right: 1px solid #444; 
    display: flex; 
    flex-direction: column; 
    height: 100%; /* Pastikan tingginya penuh */
    }

    textarea#code {
    display: none;
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
            <p>Silahkan tuliskan jawaban anda dikode editor dibawah, dan kalau sudah selesaikan klik simpan untuk menyimpan.</p>
          
            <div class="app-wrapper">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        {{-- <span id="status" style="font-size: 0.8rem; color: #aaa;">⏳ Loading Pyodide...</span> --}}
                        <button id="saveBtn" class="btn btn-primary">Save</button>
                        <button id="runBtn" class="btn-run" disabled>Run Code</button>
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
    </div>
</div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>


@endsection