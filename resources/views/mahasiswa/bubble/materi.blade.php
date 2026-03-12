@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bubble.css') }}">
<style>
    /* Style Tambahan khusus untuk Ilustrasi Visualisasi */
    .sim-visual-container {
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        padding: 25px;
        margin: 20px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        text-align: center;
    }

    .stats-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: #58a6ff;
        margin-bottom: 20px;
    }

    .visualizer-area {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        height: 180px;
        gap: 8px;
        border-bottom: 2px solid #30363d;
        padding-bottom: 10px;
    }

    .bar-item {
        background: #f85149; 
        width: 35px;
        border-radius: 4px 4px 0 0;
        transition: all 0.3s ease;
        position: relative;
    }

    .bar-item span {
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.75rem;
        color: #8b949e;
    }

    .bar-item.active-comp {
        background: #ffffff !important;
        transform: scaleX(1.1);
        box-shadow: 0 0 10px rgba(255,255,255,0.3);
    }

    .bar-item.is-sorted {
        background: #3fb950 !important;
    }

    .legend-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
        font-size: 0.8rem;
        color: #8b949e;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .color-box {
        width: 14px;
        height: 14px;
        border-radius: 3px;
    }

    .controls-row {
        margin-top: 25px;
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn-visual {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
        border: 1px solid #30363d;
    }

    .btn-start-v { background: #238636; color: white; border: none; }
    .btn-reset-v { background: #21262d; color: white; }
    
    .btn-visual:disabled { opacity: 0.5; cursor: not-allowed; }
</style>
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

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
    {{-- MATERI ASLI 1: TUJUAN PEMBELAJARAN --}}
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

    {{-- MATERI ASLI 2: PENGERTIAN --}}
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

    {{-- TAMBAHAN: ILUSTRASI VISUALISASI INTERAKTIF --}}
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play-circle"></i>
                <span class="materi-badge">Ilustrasi Visualisasi</span>
            </div>
            
            <div class="sim-visual-container">
                <div class="stats-row">
                    <span>Time Complexity: O(n²)</span>
                    <span>Space Complexity: O(1)</span>
                </div>

                <div id="visualizer-content" class="visualizer-area">
                    </div>

                <div class="legend-row">
                    <div class="legend-item"><div class="color-box" style="background: #f85149;"></div> Belum Terurut</div>
                    <div class="legend-item"><div class="color-box" style="background: #ffffff; border: 1px solid #8b949e;"></div> Membandingkan</div>
                    <div class="legend-item"><div class="color-box" style="background: #3fb950;"></div> Posisi Benar</div>
                </div>

                <div class="controls-row">
                    <button id="vResetBtn" class="btn-visual btn-reset-v" onclick="initV()">Acak Data</button>
                    <button id="vStartBtn" class="btn-visual btn-start-v" onclick="startV()">Mulai Visualisasi</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MATERI ASLI 3: CARA KERJA --}}
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

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>
    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','simulasi']) }}" class="btn btn-primary">Selanjutnya</a>
</div>

{{-- SCRIPT VISUALISASI --}}
<script>
    let vData = [];
    const vCont = document.getElementById("visualizer-content");
    const vStartBtn = document.getElementById("vStartBtn");
    const vResetBtn = document.getElementById("vResetBtn");

    function initV() {
        vData = Array.from({ length: 10 }, () => Math.floor(Math.random() * 70) + 15);
        renderV();
        vStartBtn.disabled = false;
    }

    function renderV(active = [], sorted = []) {
        vCont.innerHTML = "";
        vData.forEach((val, i) => {
            const bar = document.createElement("div");
            bar.className = "bar-item";
            bar.style.height = `${val * 2}px`;
            if (active.includes(i)) bar.classList.add("active-comp");
            if (sorted.includes(i)) bar.classList.add("is-sorted");
            
            const txt = document.createElement("span");
            txt.innerText = val;
            bar.appendChild(txt);
            vCont.appendChild(bar);
        });
    }

    const sleepV = (ms) => new Promise(res => setTimeout(res, ms));

    async function startV() {
        vStartBtn.disabled = true;
        vResetBtn.disabled = true;
        let n = vData.length;
        let sortedIdx = [];

        for (let i = 0; i < n; i++) {
            for (let j = 0; j < n - i - 1; j++) {
                renderV([j, j + 1], sortedIdx);
                await sleepV(700);
                if (vData[j] > vData[j + 1]) {
                    [vData[j], vData[j + 1]] = [vData[j + 1], vData[j]];
                    renderV([j, j + 1], sortedIdx);
                    await sleepV(700);
                }
            }
            sortedIdx.push(n - 1 - i);
            renderV([], sortedIdx);
        }
        vResetBtn.disabled = false;
    }

    document.addEventListener('DOMContentLoaded', initV);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>window.IMG_PATH = "{{ asset('images/buku') }}/";</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>

@endsection