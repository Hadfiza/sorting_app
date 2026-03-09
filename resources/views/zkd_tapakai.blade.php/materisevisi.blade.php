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
        bottom: 0;
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
        bottom: 0;
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
        width: 60px; /* Diperkecil sedikit agar muat banyak */
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

<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body">
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
                <i class="fa-sharp-duotone fa-solid fa-square-pen"></i>
                <span class="materi-badge">BubbleSort</span>
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
                <i class="fa-sharp-duotone fa-solid fa-square-pen"></i>
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
                <i class="fa-sharp-duotone fa-solid fa-square-pen"></i>
                <span class="materi-badge">Ilustrasi BubbleSort</span>
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
    <div class="card mb-4">
        <div class="card-body">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program BubbleSort</span>
            </div>
            <p>Cobalah jalankan kode Bubble Sort di bawah ini untuk melihat bagaimana Python memproses datanya.</p>
            
            <div class="app-wrapper">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        <span id="status" style="font-size: 0.8rem; color: #aaa;">⏳ Loading Pyodide...</span>
                        <button id="runBtn" class="btn-run" disabled>▶ Run Code</button>
                    </div>
                </header>
                <div class="split-container">
                    <div class="panel-left">
                        <div class="panel-label">Input Kode</div>
<textarea id="code">
def bubble_sort(data):
    n = len(data)
    for i in range(n):
        for j in range(0, n - i - 1):
            if data[j] > data[j + 1]:
                data[j], data[j + 1] = data[j + 1], data[j]
    return data

angka = [4, 2, 5, 1, 3]
print(f"Data sebelum diurutkan: {angka}")
hasil = bubble_sort(angka)
print(f"Data sesudah diurutkan: {hasil}")
</textarea>
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
        ← Sebelumnya
    </button>

    <button id="btnNext"
            class="btn btn-primary"
            onclick="nextMateri()">
        Selanjutnya →
    </button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>

let editor;
let pyodideInstance;

// =========================================================
// BAGIAN 1: LOGIKA NAVIGASI MATERI
// =========================================================
document.addEventListener('DOMContentLoaded', function () {
    const materiPages = document.querySelectorAll('.materi-page');
    if (materiPages.length === 0) return; 

    const submenuPages = document.querySelectorAll('.submenu-page');
    let materiIndex = 0;
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');

    function updateSidebarActive(index) {
        submenuPages.forEach(link => {
            link.classList.toggle(
                'active-sub',
                Number(link.dataset.index) === index
            );
        });
    }

    function tampilMateri(i) {
        materiPages.forEach((page, idx) => {
            page.classList.toggle('d-none', idx !== i);
        });

        materiIndex = i;
        // updateSidebarActive(i); // Aktifkan jika sidebar logic ada
        updateButtonState();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function updateButtonState() {
        if (btnPrev) btnPrev.disabled = materiIndex === 0;
        if (btnNext) btnNext.disabled = materiIndex === materiPages.length - 1;
    }

    window.goMateri = function(i){ tampilMateri(i); }
    window.nextMateri = function(){
        if (materiIndex < materiPages.length - 1) {
            tampilMateri(materiIndex + 1);
        }
    }
    window.prevMateri = function(){
        if (materiIndex > 0) {
            tampilMateri(materiIndex - 1);
        }
    }

    // Init halaman pertama
    tampilMateri(0);
    
    // Init Simulasi (Render awal buku)
    renderBooks();
    addHistoryRow('Data Awal', [...arr]);

    // JALANKAN EDITOR
    initPythonEditor();
});


// =========================================================
// BAGIAN 2: LOGIKA SIMULASI BUBBLE SORT
// =========================================================

const IMG_PATH = "{{ asset('images/buku') }}/";

const initialData = [4, 2, 5, 1, 3];
let arr = [...initialData];
let i = 0, j = 0, state = 'START';

// Ambil elemen DOM (akan tersedia karena script dijalankan di bawah)
const shelf = document.getElementById('shelf');
const highlightBox = document.getElementById('highlight-box');
const explanation = document.getElementById('explanation');
const mainBtn = document.getElementById('main-btn');
const iterBadge = document.getElementById('iter-badge');
const historyContainer = document.getElementById('history-container');

const startX = 150;
const gap = 95;

/* RENDER AWAL */
function renderBooks() {
    // Bersihkan buku lama jika ada (kecuali highlight box)
    document.querySelectorAll('.book-wrap').forEach(e => e.remove());

    arr.forEach((val, idx) => {
        const wrap = document.createElement('div');
        wrap.className = 'book-wrap';
        wrap.style.left = (startX + idx * gap) + 'px';

        const img = document.createElement('img');
        img.src = `${IMG_PATH}edisi${val}.png`;
        img.className = 'book-img';
        img.id = `book-${val}`;

        wrap.appendChild(img);
        shelf.appendChild(wrap);
    });
}

/* HIGHLIGHT */
function showHighlight(a, b) {
    highlightBox.style.display = 'block';
    highlightBox.style.left = (startX + a * gap - 12) + 'px';
    highlightBox.style.width = (gap + 90) + 'px';
}

/* TOMBOL */
function setBtn(text, cls) {
    mainBtn.innerText = text;
    mainBtn.className = `btn-action ${cls}`;
}

/* STATE MACHINE (LOGIKA UTAMA) */
function nextAction() {
    const n = arr.length;

    if (state === 'START') {
        state = 'COMPARE';
        i = 0; j = 0;
        iterBadge.innerText = `Iterasi ke-${i + 1}`;
        
        // PERBAIKAN: Ganti 'btn-check' jadi 'btn-cek'
        setBtn('Cek Edisi', 'btn-cek'); 
        
        explanation.innerHTML = 'Bandingkan dua buku pertama.';
        return;
    }

    if (state === 'COMPARE') {
        showHighlight(j, j + 1);
        const a = arr[j], b = arr[j + 1];

        explanation.innerHTML = `
            Bandingkan <strong style="color:#e67e22">Edisi ${a}</strong>
            dan <strong style="color:#e67e22">Edisi ${b}</strong>.<br>
        `;

        if (a > b) {
            explanation.innerHTML += `
                Karena ${a} &gt; ${b}, maka posisi harus
                <strong style="color:#e74c3c">DITUKAR</strong>.
            `;
            setBtn('LAKUKAN TUKAR', 'btn-swap');
        } else {
            explanation.innerHTML += `
                Karena ${a} &lt; ${b}, maka posisi
                <strong style="color:#27ae60">TETAP</strong>.
            `;
            setBtn('POSISI TETAP', 'btn-stay');
        }
        state = 'DECIDE';
        return;
    }

    if (state === 'DECIDE') {
        const a = arr[j], b = arr[j + 1];

        if (a > b) {
            [arr[j], arr[j + 1]] = [b, a];
            swapVisuals(a, b, j, j + 1);
        }
        j++;

        if (j >= n - 1 - i) {
            // Selesai satu putaran iterasi
            addHistoryRow(`Iterasi ${i + 1}`, [...arr]);
            i++; 
            j = 0;
            highlightBox.style.display = 'none';

            if (i >= n - 1) {
                finish();
                return;
            }

            iterBadge.innerText = `Iterasi ke-${i + 1}`;
            explanation.innerHTML = 'Iterasi sebelumnya selesai.';
            setBtn('Lanjut Iterasi', 'btn-start');
            state = 'COMPARE';
        } else {
            // Lanjut ke pasangan berikutnya dalam iterasi yang sama
            state = 'COMPARE';
            
            // PERBAIKAN: Ganti 'btn-check' jadi 'btn-cek'
            setBtn('Cek Berikutnya', 'btn-cek');
        }
    }
}

/* FINISH STATE */
function finish() {
    iterBadge.innerText = 'SELESAI';
    explanation.innerHTML = '<strong style="color:#27ae60">DATA SUDAH TERURUT!</strong>';
    mainBtn.style.display = 'none'; // Sembunyikan tombol
    highlightBox.style.display = 'none';
}

/* SWAP VISUAL */
function swapVisuals(v1, v2, idx1, idx2) {
    const el1 = document.getElementById(`book-${v1}`).parentElement;
    const el2 = document.getElementById(`book-${v2}`).parentElement;

    el1.style.left = (startX + idx2 * gap) + 'px';
    el2.style.left = (startX + idx1 * gap) + 'px';
}

/* HISTORY ROW */
function addHistoryRow(label, arrSnapshot) {
    const row = document.createElement('div');
    row.className = 'history-row';

    let html = `<strong>${label}</strong>&nbsp;`;

    arrSnapshot.forEach(v => {
        html += `<img src="${IMG_PATH}edisi${v}.png" class="mini-book-img">`;
    });

    row.innerHTML = html;
    historyContainer.appendChild(row);
}

// LOGIKA EDITOR PYTHON (PYODIDE)
async function initPythonEditor() {
    const codeArea = document.getElementById("code");
    if(!codeArea) return;

    // 1. Setup CodeMirror
    editor = CodeMirror.fromTextArea(codeArea, {
        mode: {name: "python", version: 3},
        theme: "dracula",
        lineNumbers: true,
        indentUnit: 4,
        smartIndent: true,
        matchBrackets: true,
        autofocus: true
    });

    // SET UKURAN EDITOR AGAR FULL (Height 100% mengikuti .panel-left)
    editor.setSize("100%", "100%");

    const outputDiv = document.getElementById("output");
    const runBtn = document.getElementById("runBtn");
    const statusSpan = document.getElementById("status");

    try {
        // Pyodide dimuat di latar belakang
        pyodideInstance = await loadPyodide({
            stdout: (text) => { outputDiv.innerText += text + "\n"; },
            stderr: (text) => { outputDiv.innerText += text + "\n"; }
        });
        runBtn.disabled = false;
        statusSpan.innerText = "Ready";
    } catch (err) {
        statusSpan.innerText = "Error Loading";
    }

    runBtn.onclick = async () => {
        outputDiv.innerText = "";
        runBtn.disabled = true;
        try {
            await pyodideInstance.runPythonAsync(editor.getValue());
        } catch (err) {
            outputDiv.innerText += err;
        } finally {
            runBtn.disabled = false;
        }
    };
}
</script>

@endsection