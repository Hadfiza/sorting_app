@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


<style>
    /* Container Ilustrasi agar rapi di tengah */
    .simulation-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #f4f6f8;
        padding: 20px;
        border-radius: 12px;
    }

    .sub-title { color: #7f8c8d; margin-bottom: 25px; text-align: center; }

    .main-stage {
        width: 100%;
        max-width: 760px; /* Supaya tidak terlalu lebar di layar besar */
        background: #fff;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,.08);
        position: relative;
        margin-bottom: 20px;
    }

    .iteration-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #1f2d3d;
        color: #fff;
        padding: 6px 18px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .shelf-container {
        position: relative;
        height: 260px;
        margin-top: 45px;
        border-bottom: 4px solid #bfc5ca;
    }

    /* WRAPPER BUKU */
    .book-wrap {
        position: absolute;
        bottom: 20px;
        transition: left .6s cubic-bezier(.175,.885,.32,1.275);
    }

    /* GAMBAR BUKU */
    .book-img {
        width: 80px;
        height: 170px;
        object-fit: cover;
        border-radius: 10px;
        filter: drop-shadow(-4px 6px 6px rgba(0,0,0,.35));
        display: block;
    }

    /* HIGHLIGHT BOX */
    .highlight-box {
        position: absolute;
        bottom: 10px;
        height: 190px;
        border: 3px dashed #2c3e50;
        border-radius: 10px;
        background: rgba(0,0,0,.04);
        display: none;
        z-index: 0;
    }

    .info-panel {
        text-align: center;
        margin-top: 25px;
        min-height: 95px;
    }

    .explanation {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 16px;
        color: #333;
    }

    /* TOMBOL AKSI SIMULASI */
    .btn-action {
        padding: 14px 36px;
        font-size: 16px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        color: #fff !important;
        min-width: 220px;
        box-shadow: 0 4px 0 rgba(0,0,0,.25);
        transition: transform 0.1s;
        display: inline-block;
    }

    .btn-start { background-color: #3498db !important; } 
    
    /* GANTI NAMA DISINI DARI btn-check JADI btn-cek */
    .btn-cek   { background-color: #f39c12 !important; } 
    
    .btn-swap  { background-color: #e74c3c !important; } 
    .btn-stay  { background-color: #27ae60 !important; } 
    
    .btn-action:active { transform: translateY(2px); box-shadow: none; }

    /* HISTORY */
    .history-section {
        width: 100%;
        max-width: 760px;
    }

    .history-row {
        background: #fff;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        border-left: 5px solid #34495e;
        overflow-x: auto;
    }

    .history-row:first-child {
        background: #eef3f8;
        border-left: 5px solid #3498db;
    }

    .mini-book-img {
        width: 80px; /* Diperkecil sedikit agar muat banyak */
        height: auto;
        margin-right: 10px;
        filter: drop-shadow(-2px 3px 3px rgba(0,0,0,.25));
    }

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

    .panel-right { flex: 4; display: flex; flex-direction: column; background: #101010; }
    .panel-label { background: #333; color: #ccc; padding: 5px 15px; font-size: 0.75rem; text-transform: uppercase; }
    .CodeMirror { flex-grow: 1; height: 100%; font-size: 14px; text-align: left; }
    #output { padding: 15px; color: #00ff00; font-family: 'Courier New', monospace; white-space: pre-wrap; overflow-y: auto; flex-grow: 1; font-size: 13px; text-align: left; }
    .btn-run { padding: 5px 15px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; }

    .panel-left { 
    flex: 6; 
    border-right: 1px solid #444; 
    display: flex; 
    flex-direction: column; 
    height: 100%; /* Pastikan tingginya penuh */
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

<div class="materi-page ">
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <h5 class="card-title">Tujuan Pembelajaran</h5> 
            <p>Setelah menyelesaikan materi pada bab ini, mahasiswa diharapkan mampu:</p>
            <ul>
                <li>menguraikan mekanisme langkah demi langkah pada algoritma Bubble Sort. </li>
                <li>mengimplementasikan kode program Bubble Sort. </li>
                <li>menganalisis efisiensi Bubble Sort pada berbagai kondisi data. </li>
            </ul>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">Pengertian BubbleSort</span>
            </div>
            <p class="card-text text-justify">
                Bubble Sort adalah algoritma pengurutan berbasis perbandingan yang bekerja dengan cara membandingkan elemen-elemen yang bersebelahan dalam suatu daftar, kemudian menukarnya jika urutannya salah. Proses ini diulang terus menerus hingga seluruh elemen tersusun dengan benar. Nama "Bubble Sort" diambil dari fakta bahwa elemen yang lebih besar "menggelembung" ke posisi akhir daftar, sementara elemen yang lebih kecil bergerak ke awal.<br><br>

                Jika terdapat n data, maka proses perbandingan dilakukan sebanyak n–1 kali dalam satu iterasi. Proses ini terus berlanjut hingga tidak ada lagi pertukaran data yang terjadi, yang berarti data sudah terurut dengan sempurna. Setiap satu kali pemeriksaan seluruh data disebut satu iterasi (siklus).
            </p>
        </div>
    </div>
</div>

<div class="materi-page d-none">
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-shuffle"></i>
                <span class="materi-badge">Cara Kerja</span>
            </div>
            <p class="card-text text-justify">
                Pada setiap langkah, dua elemen yang bersebelahan akan dibandingkan:
            </p>
            <ul class="card-text">
                <li>Jika elemen kiri lebih besar dari elemen kanan → tukar posisi.</li>
                <li>Jika elemen sudah berurutan → tidak terjadi pertukaran.</li>
            </ul>
            <p class="card-text text-justify">
                Langkah ini diulang dari awal sampai akhir kumpulan data. Setelah satu kali iterasi selesai, elemen terbesar akan berada di posisi paling akhir. Iterasi berikutnya dilakukan terhadap sisa data lainnya sampai semuanya terurut.
            </p>
        </div>
    </div>
</div>


<div class="materi-page d-none">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-cube"></i>
                <span class="materi-badge">Simulasi BubbleSort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title">Studi Kasus: Pengurutan Nomor Edisi Buku</div>

                <div class="main-stage">
                    <div class="iteration-badge" id="iter-badge">Data Awal</div>

                    <div class="shelf-container" id="shelf">
                        <div class="highlight-box" id="highlight-box"></div>
                    </div>

                    <div class="info-panel">
                        <div class="explanation" id="explanation">
                            Klik tombol di bawah untuk memulai proses pengurutan.
                        </div>
                        <button class="btn-action btn-start" id="main-btn" onclick="nextAction()">
                            Mulai Iterasi 1
                        </button>
                    </div>
                </div>

                <div class="history-section">
                    <h4>Hasil Per Iterasi</h4>
                    <div id="history-container"></div>
                </div>
            </div>
            </div>
    </div>
</div>

<div class="materi-page d-none">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program BubbleSort</span>
            </div>

            <div class="text-center my-4">
                <img 
                    src="{{ asset('images/bubble/bubble.png') }}" 
                    alt="Code BubbleSort"
                    class="img-fluid"
                    style="max-width: 700px;"
                >
            </div>
            <p>Penjelasan:</p>
            <ul>
                <li>
                    Baris <code>def bubblesort(list)</code> : Menyatakan bahwa program mendefinisikan sebuah fungsi bernama <code>bubblesort</code> yang menerima satu parameter berupa list angka yang akan diurutkan.
                </li>
                <li>
                    Baris <code>for i in range(len(list)-1, 0, -1)</code> : Digunakan untuk mengatur jumlah iterasi pemeriksaan terhadap list. Setiap satu kali iterasi akan memindahkan satu elemen terbesar ke posisi yang benar pada bagian kanan list.
                </li>
                <li>
                    Baris <code>for j in range(0, i, 1)</code> : Digunakan untuk membandingkan elemen-elemen yang bersebelahan, yaitu <code>list[j]</code> dan <code>list[j+1]</code>. Proses perbandingan dilakukan dari indeks awal hingga sebelum batas <code>i</code>.
                </li>
                <li>
                    Baris logika pertukaran (<em>swap</em>) : Melakukan pertukaran elemen apabila elemen kiri lebih besar dibanding elemen kanan. Dengan cara ini, nilai yang lebih besar akan bergerak ke arah kanan list secara bertahap, seperti gelembung yang naik ke permukaan.
                </li>
                <li>
                    Baris <code>print(f"Hasil setelah iterasi ke-{len(list)-i}: {list}")</code> : Digunakan untuk menampilkan kondisi list setelah satu iterasi selesai dijalankan, sehingga proses pengurutan dapat diamati secara bertahap.
                </li>
                <li>
                    <strong>Pemanggilan fungsi & keluaran</strong> : Pada bagian akhir program, list awal didefinisikan (<code>angka = [4, 2, 5, 1, 3]</code>), kemudian fungsi <code>bubblesort(angka)</code> dipanggil untuk menjalankan proses pengurutan dan menampilkan hasil sebelum serta sesudah sorting.
                </li>
            </ul>

        </div>
    </div>



    <div class="card mb-4">
        <div class="card-body materi-text">
            <p>Cobalah jalankan kode Bubble Sort di bawah ini untuk melihat bagaimana Python memproses datanya.</p>
          
            <div class="app-wrapper">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        {{-- <span id="status" style="font-size: 0.8rem; color: #aaa;">⏳ Loading Pyodide...</span> --}}
                        <button id="runBtn" class="btn-run" disabled>▶ Run Code</button>
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

<div class="d-flex justify-content-center gap-3 mt-4">
    <button id="btnPrev"
            class="btn btn-outline-secondary"
            onclick="prevMateri()">
        Sebelumnya
    </button>

    <button id="btnNext"
            class="btn btn-primary"
            onclick="nextMateri()">
        Selanjutnya
    </button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>


@endsection