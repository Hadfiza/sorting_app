@extends('layouts.hlmns')

@section('title','SelectionSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/selection.css') }}">
<style>
    /* Style Tambahan khusus untuk Ilustrasi Visualisasi Selection Sort */
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
        background: #8b949e; 
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

    /* Selection Sort Animation States */
    .bar-item.scanning {
        background: #ffffff !important;
        transform: scaleX(1.1);
    }

    .bar-item.min-current {
        background: #f1c40f !important;
        box-shadow: 0 0 10px rgba(241, 196, 15, 0.5);
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
                <h3 class="mb-0">Algoritma SelectionSort</h3>
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
                <li>mensimulasikan proses pencarian nilai pada algoritma selection sort. </li>
                <li>menganalisis hasil proses pengurutan data menggunakan algoritma Selection Sort. </li>
                <li>menyusun algoritma Selection Sort ke dalam bahasa pemrograman python. </li>
            </ul>
        </div>
    </div>

    {{-- MATERI ASLI 2: PENGERTIAN --}}
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">Pengertian SelectionSort</span>
            </div>
            <p class="card-text text-justify">
                Selection Sort adalah algoritma pengurutan yang bekerja dengan cara memilih nilai tertentu dari bagian data yang belum terurut, kemudian menempatkannya pada posisi yang sesuai. Cara kerja algoritma ini mirip dengan kebiasaan manusia saat mengurutkan daftar buku atau nilai: kita mencari nilai terkecil terlebih dahulu, lalu meletakkannya di posisi paling awal. Setelah itu, kita kembali mencari nilai terkecil berikutnya dari sisa data, dan menempatkannya di posisi kedua, dan begitu seterusnya hingga seluruh data berada pada urutan yang benar. <br><br>
                Algoritma ini dinamakan Selection Sort karena setiap iterasi melakukan proses seleksi nilai minimum (untuk ascending) atau seleksi nilai maksimum (untuk descending). Tidak seperti Bubble Sort yang melakukan banyak pertukaran selama iterasi, Selection Sort hanya melakukan satu kali pertukaran pada setiap siklus, yaitu ketika nilai terkecil ditemukan dan diletakkan pada posisinya. Karena itulah jumlah pertukaran dalam Selection Sort relatif sedikit, yakni hanya sebanyak n − 1 swap untuk n data. Meskipun lebih hemat pertukaran dibanding Bubble Sort, Selection Sort tetap melakukan proses pencarian minimum pada setiap iterasi, sehingga memerlukan waktu komputasi yang cukup besar. Kompleksitas waktu algoritma ini adalah O(n²) karena harus membandingkan nilai-nilai pada setiap posisi secara berulang.
            </p>
        </div>
    </div>

    {{-- TAMBAHAN: ILUSTRASI VISUALISASI --}}
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

                <div id="selection-visualizer-area" class="visualizer-area">
                    </div>

                <div class="legend-row">
                    <div class="legend-item"><div class="color-box" style="background: #8b949e;"></div> Belum Dicek</div>
                    <div class="legend-item"><div class="color-box" style="background: #ffffff; border: 1px solid #8b949e;"></div> Membandingkan</div>
                    <div class="legend-item"><div class="color-box" style="background: #f1c40f;"></div> Minimum Sementara</div>
                    <div class="legend-item"><div class="color-box" style="background: #3fb950;"></div> Posisi Benar</div>
                </div>

                <div class="controls-row">
                    <button id="sResetBtn" class="btn-visual btn-reset-v" onclick="initS()">Acak Data</button>
                    <button id="sStartBtn" class="btn-visual btn-start-v" onclick="startS()">Mulai Visualisasi</button>
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
                Pada setiap langkah, algoritma akan mencari elemen dengan nilai terkecil dari kumpulan data yang belum terurut:
            </p>
            <ul class="card-text">
                <li>Setelah elemen terkecil ditemukan → tukar posisinya dengan elemen pertama dari bagian yang belum terurut.</li>
                <li>Jika proses pencarian selesai → lanjutkan ke elemen berikutnya pada posisi kedua, dan ulangi langkah yang sama.</li>
            </ul>
            <p class="card-text text-justify">
                Langkah ini diulang sampai seluruh elemen berada di posisi yang benar. Setelah setiap satu siklus seleksi selesai, elemen terkecil akan berada di posisi paling awal, dan bagian tersebut dianggap sudah terurut. Proses ini berlanjut hingga tidak ada lagi data yang tersisa untuk diseleksi.
            </p>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>
    <a href="{{ route('mahasiswa.aktivitas.show',['selection','simulasi']) }}" class="btn btn-primary">Selanjutnya</a>
</div>

{{-- SCRIPT VISUALISASI SELECTION SORT --}}
<script>
    let sData = [];
    const sCont = document.getElementById("selection-visualizer-area");
    const sStartBtn = document.getElementById("sStartBtn");
    const sResetBtn = document.getElementById("sResetBtn");

    function initS() {
        sData = Array.from({ length: 10 }, () => Math.floor(Math.random() * 70) + 15);
        renderS();
        sStartBtn.disabled = false;
        sResetBtn.disabled = false;
    }

    function renderS(scanIdx = -1, minIdx = -1, sortedIdx = []) {
        sCont.innerHTML = "";
        sData.forEach((val, i) => {
            const bar = document.createElement("div");
            bar.className = "bar-item";
            bar.style.height = `${val * 2}px`;
            
            if (sortedIdx.includes(i)) bar.classList.add("is-sorted");
            if (i === scanIdx) bar.classList.add("scanning");
            if (i === minIdx) bar.classList.add("min-current");
            
            const txt = document.createElement("span");
            txt.innerText = val;
            bar.appendChild(txt);
            sCont.appendChild(bar);
        });
    }

    const sleepS = (ms) => new Promise(res => setTimeout(res, ms));

    async function startS() {
        sStartBtn.disabled = true;
        sResetBtn.disabled = true;
        let n = sData.length;
        let sortedIndices = [];

        for (let i = 0; i < n - 1; i++) {
            let min_idx = i;
            renderS(-1, min_idx, sortedIndices);
            await sleepS(600);

            for (let j = i + 1; j < n; j++) {
                renderS(j, min_idx, sortedIndices);
                await sleepS(600);

                if (sData[j] < sData[min_idx]) {
                    min_idx = j;
                    renderS(-1, min_idx, sortedIndices);
                    await sleepS(600);
                }
            }

            if (min_idx !== i) {
                [sData[i], sData[min_idx]] = [sData[min_idx], sData[i]];
            }
            sortedIndices.push(i);
            renderS(-1, -1, sortedIndices);
            await sleepS(600);
        }
        
        sortedIndices.push(n - 1);
        renderS(-1, -1, sortedIndices);
        sResetBtn.disabled = false;
        
        Swal.fire({
            title: 'Selesai!',
            text: 'Selection Sort berhasil divisualisasikan.',
            icon: 'success',
            timer: 2000
        });
    }

    document.addEventListener('DOMContentLoaded', initS);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>window.IMG_PATH = "{{ asset('images/aset/kaleng') }}/";</script>
<script src="{{ asset('js/selectionsort.js') }}"></script>

@endsection