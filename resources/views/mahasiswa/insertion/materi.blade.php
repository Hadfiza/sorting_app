@extends('layouts.hlmns')

@section('title','Insertion Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/insertion.css') }}">
<style>
    /* Style Tambahan untuk Ilustrasi Visualisasi Insertion Sort */
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

    /* Insertion Sort States */
    .bar-item.active-key {
        background: #f1c40f !important; /* Elemen yang sedang disisipkan (Key) */
        transform: translateY(-10px);
        box-shadow: 0 0 15px rgba(241, 196, 15, 0.5);
    }

    .bar-item.comparing {
        background: #ffffff !important; /* Sedang dibandingkan dengan key */
    }

    .bar-item.is-sorted {
        background: #3fb950 !important; /* Bagian kiri yang sudah terurut relatif */
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
                <h3 class="mb-0">Algoritma Insertion Sort</h3>
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
                <li>mensimulasikan cara kerja Insertion Sort .  </li>
                <li>Menganalisis hasil proses pengurutan data menggunakan algoritma insertion Sort. </li>
                <li>membangun fungsi program Insertion Sort kedalam bahasa pemrograman. </li>
            </ul>
        </div>
    </div>

    {{-- MATERI ASLI 2: PENGERTIAN --}}
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">Pengertian Insertion Sort</span>
            </div>
            <p class="card-text text-justify">
                Insertion Sort adalah algoritma pengurutan sederhana yang bekerja dengan cara menyisipkan elemen ke posisi yang tepat dalam kumpulan data yang sebagian telah terurut. Cara kerjanya mirip seperti seseorang menyusun kartu di tangan: setiap kartu baru dibandingkan dengan kartu-kartu sebelumnya, lalu ditempatkan pada posisi yang sesuai agar urutan tetap benar. Dalam prosesnya, Insertion Sort selalu menjaga agar bagian awal list berada dalam keadaan terurut, kemudian setiap item berikutnya disisipkan satu per satu ke posisi yang tepat di antara elemen-elemen yang sudah terurut tersebut.</br></br>

                Disebut Insertion karena proses utamanya adalah penyisipan elemen pada tempat yang benar. Meskipun memiliki kompleksitas waktu O(n²), algoritma ini bekerja dengan pendekatan yang berbeda dari Bubble Sort dan Selection Sort, yaitu dengan memastikan sebagian list sudah terurut pada setiap langkah. Pendekatan ini membuat Insertion Sort lebih efisien untuk data yang hampir terurut, karena hanya membutuhkan sedikit pergeseran elemen untuk mencapai urutan yang benar.
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
                    <span>Complexity: O(n²)</span>
                    <span>Space: O(1)</span>
                </div>

                <div id="insertion-visualizer" class="visualizer-area">
                    </div>

                <div class="legend-row">
                    <div class="legend-item"><div class="color-box" style="background: #8b949e;"></div> Belum Dicek</div>
                    <div class="legend-item"><div class="color-box" style="background: #f1c40f;"></div> Elemen Sisip (Key)</div>
                    <div class="legend-item"><div class="color-box" style="background: #ffffff; border: 1px solid #8b949e;"></div> Membandingkan</div>
                    <div class="legend-item"><div class="color-box" style="background: #3fb950;"></div> Bagian Terurut</div>
                </div>

                <div class="controls-row">
                    <button id="iResetBtn" class="btn-visual btn-reset-v" onclick="initI()">Acak Data</button>
                    <button id="iStartBtn" class="btn-visual btn-start-v" onclick="startI()">Mulai Visualisasi</button>
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
                Pada algoritma Insertion Sort, proses pengurutan dilakukan dengan menyisipkan setiap elemen ke dalam posisi yang tepat di bagian data yang sudah terurut:
            </p>
            <ul class="card-text">
                <li>Algoritma menganggap bahwa elemen pertama sudah berada pada posisi yang benar.</li>
                <li>Elemen berikutnya akan dibandingkan dengan elemen-elemen sebelumnya untuk menemukan posisi yang sesuai.</li>
                <li>Jika ditemukan elemen yang lebih besar di sebelah kiri, maka elemen-elemen tersebut digeser ke kanan untuk memberi ruang bagi elemen baru.</li>
                <li>Elemen baru kemudian disisipkan di posisi yang tepat agar urutan tetap benar.</li>
            </ul>
            <p class="card-text text-justify">
                Langkah-langkah tersebut diulang untuk seluruh elemen dalam daftar hingga semua data berada dalam keadaan terurut. <br>
                Dengan cara ini, setiap iterasi menghasilkan bagian awal daftar yang selalu terjaga dalam kondisi terurut, sementara bagian sisanya menunggu untuk disisipkan.
            </p>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>
    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','simulasi']) }}" class="btn btn-primary">Selanjutnya</a>
</div>

{{-- SCRIPT VISUALISASI INSERTION SORT --}}
<script>
    let iData = [];
    const iCont = document.getElementById("insertion-visualizer");
    const iStartBtn = document.getElementById("iStartBtn");
    const iResetBtn = document.getElementById("iResetBtn");

    function initI() {
        iData = Array.from({ length: 10 }, () => Math.floor(Math.random() * 70) + 15);
        renderI();
        iStartBtn.disabled = false;
        iResetBtn.disabled = false;
    }

    function renderI(activeKey = -1, compareIdx = -1, sortedLimit = -1) {
        iCont.innerHTML = "";
        iData.forEach((val, idx) => {
            const bar = document.createElement("div");
            bar.className = "bar-item";
            bar.style.height = `${val * 2}px`;
            
            if (idx <= sortedLimit) bar.classList.add("is-sorted");
            if (idx === activeKey) bar.classList.add("active-key");
            if (idx === compareIdx) bar.classList.add("comparing");
            
            const txt = document.createElement("span");
            txt.innerText = val;
            bar.appendChild(txt);
            iCont.appendChild(bar);
        });
    }

    const sleepI = (ms) => new Promise(res => setTimeout(res, ms));

    async function startI() {
        iStartBtn.disabled = true;
        iResetBtn.disabled = true;
        let n = iData.length;

        for (let i = 1; i < n; i++) {
            let key = iData[i];
            let j = i - 1;

            // Highlight elemen yang sedang "dipegang" (Key)
            renderI(i, -1, i - 1);
            await sleepI(700);

            while (j >= 0 && iData[j] > key) {
                // Visualisasi perbandingan
                renderI(j + 1, j, i - 1);
                await sleepI(500);

                iData[j + 1] = iData[j];
                j = j - 1;
                
                // Visualisasi pergeseran
                renderI(j + 1, -1, i - 1);
                await sleepI(300);
            }
            iData[j + 1] = key;
            
            // Visualisasi setelah elemen disisipkan
            renderI(-1, -1, i);
            await sleepI(600);
        }

        iResetBtn.disabled = false;
        Swal.fire({
            title: 'Selesai!',
            text: 'Insertion Sort berhasil diurutkan.',
            icon: 'success',
            timer: 2000
        });
    }

    document.addEventListener('DOMContentLoaded', initI);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script src="{{ asset('js/insertionsort.js') }}"></script>

@endsection