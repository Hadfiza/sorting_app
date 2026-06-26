@extends('layouts.hlmns')

@section('title','Materi Merge Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/merge.css') }}">

<style>
    .sim-visual-container {
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        padding: 25px;
        margin: 20px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        text-align: center;
        overflow-x: auto;
    }

    .stats-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: #58a6ff;
        margin-bottom: 25px;
    }

    .tree-root {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 30px;
        min-height: 250px;
        padding: 10px;
    }

    .tree-level {
        display: flex;
        justify-content: center;
        gap: 40px;
        width: 100%;
    }

    .array-node {
        display: flex;
        gap: 2px;
        border: 1px solid #30363d;
        padding: 3px;
        border-radius: 6px;
        background: #0d1117;
        transition: all 0.4s ease;
    }

    .data-element {
        background: #8b949e;
        color: white;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.85rem;
        border-radius: 4px;
    }

    .array-node.splitting {
        border-color: #f1c40f;
        box-shadow: 0 0 10px rgba(241, 196, 15, 0.3);
    }

    .array-node.splitting .data-element {
        background: #f1c40f;
    }

    .array-node.merging {
        border-color: #ffffff;
    }

    .array-node.merging .data-element {
        background: #ffffff;
        color: black;
    }

    .array-node.is-sorted .data-element {
        background: #3fb950;
    }

    .legend-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 25px;
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
        border: 1px solid #30363d;
    }

    .btn-start-v {
        background: #238636;
        color: white;
        border: none;
    }

    .btn-reset-v {
        background: #21262d;
        color: white;
    }

    .materi-text p {
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .form-check {
        padding: 8px 10px 8px 30px;
        border-radius: 6px;
        background-color: #f8f9fa;
        transition: background 0.2s, border 0.2s;
        border: 1px solid transparent;
    }

    .form-check:hover {
        background-color: #e9ecef;
    }

    .form-check-input:checked + .form-check-label {
        font-weight: 600;
        color: #0d6efd;
    }

    .fade-in {
        animation: fadeInOpacity 0.3s ease-in-out;
    }

    @keyframes fadeInOpacity {
        0% { opacity: 0; transform: translateX(5px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    @media (min-width: 768px) {
        .w-md-auto { width: auto !important; }
    }
</style>
@endsection

@section('content')

@php
    // Mengecek apakah materi ini sudah pernah diselesaikan
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-layer-group"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma Merge Sort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page">

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <h5 class="card-title">Tujuan Pembelajaran</h5>
            <p>Setelah menyelesaikan materi pada bab ini, mahasiswa diharapkan mampu:</p>
            <ul>
                <li>menjelaskan prinsip Divide, Conquer, and Combine pada proses pengurutan data berbasis rekursif.</li>
                <li>mensimulasikan tahap pembagian dan penggabungan data secara sistematis.</li>
                <li>merancang algoritma Merge Sort kedalam bahasa pemrograman.</li>
            </ul>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">Pengertian Merge Sort</span>
            </div>
            <p class="card-text text-justify">
                Merge Sort adalah algoritma pengurutan berbasis strategi Divide and Conquer (membagi dan menaklukkan), yaitu dengan membagi masalah menjadi bagian-bagian yang lebih kecil, menyelesaikannya secara terpisah, kemudian menggabungkan hasilnya kembali. Algoritma ini dikenal efisien untuk mengurutkan data berukuran besar karena memiliki performa yang konsisten pada berbagai kondisi data.</br></br>

                Pada tahap awal, jika sebuah daftar kosong atau hanya memiliki satu elemen, daftar tersebut dianggap sudah berada dalam keadaan terurut. Namun, jika jumlah elemennya lebih dari satu, daftar akan dipecah menjadi dua sublist. Kedua sublist tersebut kemudian diurutkan kembali menggunakan prosedur yang sama secara rekursif. Setelah kedua sublist berada dalam kondisi terurut, dilakukan proses penggabungan, yaitu menggabungkan dua daftar terurut tersebut menjadi satu urutan baru yang terurut sepenuhnya.<br> <br>

                Disebut Merge Sort karena operasi utamanya adalah proses penggabungan dua sublist terurut menjadi satu urutan yang juga terurut. Dengan pendekatan divide and conquer ini, Merge Sort termasuk algoritma pengurutan yang stabil, rekursif, dan sangat efisien. Kompleksitas waktu Merge Sort adalah O(n log n) pada kondisi terbaik, rata-rata, maupun terburuk karena proses pembagian dan penggabungan data dilakukan secara sistematis pada setiap tingkat rekursi. Efisiensi ini membuat Merge Sort cocok digunakan untuk mengurutkan data dalam jumlah besar. Namun, algoritma ini memiliki kompleksitas ruang O(n) karena memerlukan memori tambahan untuk menyimpan hasil penggabungan sementara selama proses pengurutan.  
            </p>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-shuffle"></i>
                <span class="materi-badge">Cara Kerja</span>
            </div>
            <p class="card-text text-justify">
                Algoritma Merge Sort bekerja dengan membagi daftar data menjadi dua bagian yang lebih kecil, mengurutkan masing-masing bagian tersebut, lalu menggabungkannya kembali menjadi satu daftar yang terurut. Proses ini menggunakan pendekatan rekursif, di mana fungsi memanggil dirinya sendiri untuk menangani sublist yang lebih kecil. <br><br> Tahapan prosesnya adalah sebagai berikut:
            </p>
            <ul class="card-text">
                <li>Membagi (Divide): daftar data dibagi menjadi dua bagian dengan ukuran hampir sama.</li>
                <li>Menaklukkan (Conguer): setiap bagian diurutkan kembali secara rekursif hingga hanya tersisa satu elemen di tiap sublist.</li>
                <li>Menggabungkan (Merge): dua sublist yang sudah terurut digabungkan menjadi satu daftar baru dengan membandingkan elemen-elemen terkecil dari masing-masing sublist, lalu menyusunnya ke dalam urutan yang benar.</li>
            </ul>
            <p class="card-text text-justify">
                Langkah-langkah di atas akan terus berulang sampai seluruh data tergabung kembali menjadi satu daftar lengkap yang sudah terurut sempurna. Dengan cara ini, Merge Sort dapat mengurutkan data secara efisien karena proses pengurutan dilakukan selama proses penggabungan (merging), bukan setelahnya.
            </p>
        </div>
    </div>


    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play-circle"></i>
                <span class="materi-badge">Ilustrasi Visualisasi (Divide & Conquer)</span>
            </div>

            <p class="mb-2">
                Berikut adalah simulasi interaktif yang memperlihatkan proses kerja algoritma Merge Sort dalam mengurutkan data.
            </p>

            <div class="alert alert-info py-1 mb-1">
                <strong>Petunjuk:</strong>
                <ol class="mb-0 ps-3">
                    <li>Klik <strong>Mulai Visualisasi</strong> untuk menjalankan simulasi.</li>
                    <li>Amati proses perbandingan dan pertukaran data yang terjadi.</li>
                    <li>Perhatikan perubahan warna balok sesuai keterangan status di bawah.</li>
                    <li>Klik <strong>Acak Data</strong> untuk mencoba susunan data yang berbeda.</li>
                </ol>
            </div>

            <div class="sim-visual-container">
                {{-- <div class="stats-row">
                    <span>Complexity: O(n log n)</span>
                    <span>Space Complexity: O(n)</span>
                </div> --}}

                <div id="tree-container" class="tree-root"></div>

                <div class="legend-row">
                    <div class="legend-item">
                        <div class="color-box" style="background:#f1c40f;"></div>
                        Proses Membagi
                    </div>
                    <div class="legend-item">
                        <div class="color-box" style="background:#ffffff;border:1px solid #8b949e;"></div>
                        Proses Menggabung
                    </div>
                    <div class="legend-item">
                        <div class="color-box" style="background:#3fb950;"></div>
                        Bagian Terurut
                    </div>
                </div>

                <div class="controls-row">
                    <button id="mResetBtn" class="btn-visual btn-reset-v" onclick="initM()">
                        Acak Data
                    </button>
                    <button id="mStartBtn" class="btn-visual btn-start-v" onclick="startM()">
                        Mulai Visualisasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-1 materi-box mt-2 shadow-sm" id="quizActivity">
        <div class="card-body materi-text p-1 p-md-3">

            <div class="materi-header mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-tasks text-primary"></i>
                    <span class="materi-badge fs-6">Aktivitas 2.1: Uji Pemahaman Merge Sort</span>
                </div>
                <span class="badge bg-secondary rounded-pill" id="quizProgress">Soal 1 dari 5</span>
            </div>

            <div class="mb-2">
                <button class="btn btn-sm btn-outline-primary"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#instruksiPilganMerge">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Instruksi Pengerjaan
                </button>
            </div>

            <div class="collapse" id="instruksiPilganMerge">
                <div class="alert alert-light border small py-2 px-3">
                    • Terdapat 5 soal pilihan ganda.<br>
                    • Pilih satu jawaban yang paling tepat pada setiap soal.<br>
                    • Semua soal harus dijawab dengan benar untuk membuka materi selanjutnya.
                </div>
            </div>

            <hr>

            <div class="quiz-container">

                <div class="quiz-slide fade-in" id="slide-0">
                    <p><strong>Soal :</strong></p>
                    <p class="fw-semibold mb-2 text-dark">
                        1. Strategi algoritma apa yang menjadi dasar dari algoritma Merge Sort?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq1" id="mq1a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq1a">
                            a. Divide and Conquer
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq1" id="mq1b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq1b">
                            b. Brute Force
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq1" id="mq1c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq1c">
                            c. Dynamic Programming
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq1" id="mq1d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq1d">
                            d. Greedy
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-1">
                    <p class="fw-semibold mb-2 text-dark">
                        2. Pada tahap pembagian atau <em>Divide</em>, kapan sebuah sublist dianggap sudah berada dalam keadaan terurut?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq2" id="mq2a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq2a">
                            a. Saat daftar telah dibagi menjadi dua bagian yang sama besar
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq2" id="mq2b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq2b">
                            b. Saat daftar kosong atau hanya memiliki satu elemen
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq2" id="mq2c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq2c">
                            c. Saat elemen terbesar sudah berada di akhir daftar
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq2" id="mq2d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq2d">
                            d. Saat seluruh elemen telah dibandingkan satu per satu
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-2">
                    <p class="fw-semibold mb-2 text-dark">
                        3. Berdasarkan materi, mengapa Merge Sort dinilai lebih boros ruang dibandingkan algoritma <em>in-place</em> seperti Quick Sort?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq3" id="mq3a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq3a">
                            a. Karena memiliki kompleksitas waktu rata-rata O(n log n)
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq3" id="mq3b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq3b">
                            b. Karena selalu membagi daftar menjadi dua sublist
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq3" id="mq3c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq3c">
                            c. Karena memerlukan memori tambahan untuk menyimpan hasil penggabungan
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq3" id="mq3d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq3d">
                            d. Karena menggunakan proses perulangan bersarang
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-3">
                    <p class="fw-semibold mb-2 text-dark">
                        4. Apa yang dilakukan algoritma pada tahap <em>Combine/Merge</em> dalam proses Merge Sort?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq4" id="mq4a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq4a">
                            a. Menggabungkan dua sublist yang sudah terurut menjadi satu daftar terurut dengan membandingkan elemen terkecil dari masing-masing sublist
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq4" id="mq4b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq4b">
                            b. Membagi array menjadi dua bagian yang terus mengecil secara acak
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq4" id="mq4c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq4c">
                            c. Menghapus elemen-elemen yang memiliki nilai ganda dalam daftar
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq4" id="mq4d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq4d">
                            d. Mencari nilai pivot untuk menentukan pembagian data selanjutnya
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-4">
                    <p class="fw-semibold mb-2 text-dark">
                        5. Jika sebuah array memiliki 8 elemen, berapa kali proses pembagian atau <em>Divide</em> akan dilakukan hingga setiap elemen berdiri sendiri sebagai satu sublist?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq5" id="mq5a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq5a">
                            a. 7 kali
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq5" id="mq5b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq5b">
                            b. 1 kali
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq5" id="mq5c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq5c">
                            c. 8 kali
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="mq5" id="mq5d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="mq5d">
                            d. 3 kali
                        </label>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                <button type="button" id="btnPrevQuiz" class="btn btn-sm btn-secondary px-3 d-none">
                    <i class="fa-solid fa-chevron-left"></i> Kembali
                </button>

                <div class="flex-grow-1 text-center px-2">
                    <button id="btnCheckQuiz" class="btn btn-sm btn-primary px-3 fw-bold d-none shadow-sm w-100 w-md-auto">
                        <i class="fa-solid fa-check-double me-1"></i> Periksa
                    </button>

                    <button id="btnResetQuiz" class="btn btn-sm btn-warning px-3 fw-bold d-none shadow-sm text-dark w-100 w-md-auto">
                        <i class="fa-solid fa-rotate-right me-1"></i> Ulangi Kuis
                    </button>
                </div>

                <button type="button" id="btnNextQuiz" class="btn btn-sm btn-primary px-3">
                    Lanjut <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <div id="quizFeedback" class="alert d-none mt-3 shadow-sm text-center py-2 mb-0 small"></div>

        </div>
    </div>
    </div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','simulasi']) }}" 
    id="btnNextMerge"
    class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}"
    {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
        <i class="fa-solid {{ $isSelesai ? 'fa-unlock' : 'fa-lock' }} me-1" id="lockIcon"></i>
        Selanjutnya
    </a>
    </div>

<script>
    let currentData = [];
    const treeCont = document.getElementById("tree-container");
    const mStartBtn = document.getElementById("mStartBtn");
    const mResetBtn = document.getElementById("mResetBtn");

    function initM() {
        currentData = Array.from({ length: 8 }, () => Math.floor(Math.random() * 80) + 10);
        treeCont.innerHTML = "";
        createNode(currentData, 0);
        mStartBtn.disabled = false;
        mResetBtn.disabled = false;
    }

    function createNode(arr, level, nodeId = "") {
        let levelDiv = document.getElementById("level-" + level);
        if (!levelDiv) {
            levelDiv = document.createElement("div");
            levelDiv.id = "level-" + level;
            levelDiv.className = "tree-level";
            treeCont.appendChild(levelDiv);
        }

        const node = document.createElement("div");
        node.className = "array-node";
        if (nodeId) node.id = nodeId;

        arr.forEach(val => {
            const el = document.createElement("div");
            el.className = "data-element";
            el.innerText = val;
            node.appendChild(el);
        });

        levelDiv.appendChild(node);
        return node;
    }

    const sleepM = (ms) => new Promise(res => setTimeout(res, ms));

    async function combine(nodeId, start, mid, end) {
        let left = currentData.slice(start, mid + 1);
        let right = currentData.slice(mid + 1, end + 1);
        let merged = [];
        let i = 0;
        let j = 0;

        while (i < left.length && j < right.length) {
            if (left[i] <= right[j]) merged.push(left[i++]);
            else merged.push(right[j++]);
        }

        while (i < left.length) merged.push(left[i++]);
        while (j < right.length) merged.push(right[j++]);

        for (let x = 0; x < merged.length; x++) {
            currentData[start + x] = merged[x];
        }

        const node = document.getElementById(nodeId);
        node.classList.remove("splitting");
        node.classList.add("merging");

        await sleepM(800); // jeda 0,8 detik saat proses penggabungan data dimulai
        node.innerHTML = "";

        merged.forEach(val => {
            const el = document.createElement("div");
            el.className = "data-element";
            el.innerText = val;
            node.appendChild(el);
        });

        node.classList.remove("merging");
        node.classList.add("is-sorted");
        await sleepM(600); // jeda 0,6 detik setelah data hasil gabungan ditandai terurut
    }

    async function divide(level, start, end, nodeId) {
        if (start < end) {
            let mid = Math.floor((start + end) / 2);
            let leftArr = currentData.slice(start, mid + 1);
            let rightArr = currentData.slice(mid + 1, end + 1);

            const parent = document.getElementById(nodeId);
            parent.classList.add("splitting");
            await sleepM(600); // jeda 0,6 detik saat data mulai dibagi menjadi dua bagian

            let leftId = "node-" + level + "-" + start;
            let rightId = "node-" + level + "-" + end;

            createNode(leftArr, level + 1, leftId);
            await sleepM(600); // jeda 0,6 detik setelah bagian kiri ditampilkan

            createNode(rightArr, level + 1, rightId);
            await sleepM(800); // jeda 0,8 detik setelah bagian kanan ditampilkan

            await divide(level + 1, start, mid, leftId);
            await divide(level + 1, mid + 1, end, rightId);

            await combine(nodeId, start, mid, end);
        } else {
            const node = document.getElementById(nodeId);
            node.classList.add("is-sorted");
            await sleepM(400); // jeda 0,4 detik saat data tunggal ditandai sebagai bagian terurut
        }
    }

    async function startM() {
        mStartBtn.disabled = true;
        mResetBtn.disabled = true;

        const rootNodeId = "root-node";
        document.querySelector("#level-0 .array-node").id = rootNodeId;

        await divide(0, 0, currentData.length - 1, rootNodeId);

        mResetBtn.disabled = false;

        Swal.fire({
            title: 'Selesai!',
            text: 'Merge Sort berhasil divisualisasikan.',
            icon: 'success',
            timer: 2000
        });
    }

    document.addEventListener("DOMContentLoaded", initM);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isSelesai = @json($isSelesai);

    const slides = document.querySelectorAll('.quiz-slide');
    if (slides.length === 0) return;

    const btnPrev = document.getElementById('btnPrevQuiz');
    const btnNext = document.getElementById('btnNextQuiz');
    const progressText = document.getElementById('quizProgress');

    const btnCheck = document.getElementById('btnCheckQuiz');
    const btnReset = document.getElementById('btnResetQuiz');
    const feedback = document.getElementById('quizFeedback');

    const btnNextMateri = document.getElementById('btnNextMerge');
    const lockIcon = document.getElementById('lockIcon');

    const totalQuestions = slides.length;
    let currentSlide = 0;

    const kunciJawaban = {
        mq1: 'A',
        mq2: 'B',
        mq3: 'C',
        mq4: 'A',
        mq5: 'D'
    };

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('d-none', i !== index);
        });

        progressText.innerText = `Soal ${index + 1} dari ${totalQuestions}`;

        if (index === 0) {
            btnPrev.classList.add('d-none');
            btnPrev.style.visibility = 'hidden';
        } else {
            btnPrev.classList.remove('d-none');
            btnPrev.style.visibility = 'visible';
        }

        if (index === totalQuestions - 1) {
            btnNext.classList.add('d-none');
        } else {
            btnNext.classList.remove('d-none');
        }
    }

    function tampilkanJawabanBenar() {
        Object.keys(kunciJawaban).forEach(function(name) {
            const radio = document.querySelector(
                `input[name="${name}"][value="${kunciJawaban[name]}"]`
            );

            if (radio) {
                radio.checked = true;
            }
        });

        // Pilihan tetap aktif agar bisa reset dan pilih ulang
        document.querySelectorAll('#quizActivity input[type="radio"]').forEach(function(radio) {
            radio.disabled = false;
        });
        // Periksa disembunyikan, reset ditampilkan
        if (btnCheck) btnCheck.classList.add('d-none');
        if (btnReset) btnReset.classList.remove('d-none');
        btnReset.innerHTML = '<i class="fa-solid fa-rotate-right me-1"></i> Reset Latihan'; // Agar walau sudah benar semua tombol reset tetap ada

        feedback.className = 'alert alert-success mt-3 shadow-sm text-center py-2 mb-0 small fade-in';
        feedback.innerHTML = `<i class="fa-solid fa-circle-check me-1"></i> <strong>Selesai!</strong> Jawaban benar telah ditampilkan.`;
        feedback.classList.remove('d-none');

        btnNextMateri.classList.remove('disabled');
        btnNextMateri.removeAttribute('tabindex');
        btnNextMateri.removeAttribute('aria-disabled');
        btnNextMateri.style.pointerEvents = 'auto';
        btnNextMateri.style.opacity = '1';

        if (lockIcon) {
            lockIcon.className = 'fa-solid fa-unlock me-1';
        }
    }

    btnNext.addEventListener('click', function() {
        if (currentSlide < totalQuestions - 1) {
            currentSlide++;
            showSlide(currentSlide);
        }
    });

    btnPrev.addEventListener('click', function() {
        if (currentSlide > 0) {
            currentSlide--;
            showSlide(currentSlide);
        }
    });

    function checkAllAnswered() {
        // if (isSelesai) return;

        const q1Val = document.querySelector('input[name="mq1"]:checked');
        const q2Val = document.querySelector('input[name="mq2"]:checked');
        const q3Val = document.querySelector('input[name="mq3"]:checked');
        const q4Val = document.querySelector('input[name="mq4"]:checked');
        const q5Val = document.querySelector('input[name="mq5"]:checked');

        if (q1Val && q2Val && q3Val && q4Val && q5Val && btnReset.classList.contains('d-none')) {
            btnCheck.classList.remove('d-none');
        }
    }

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', checkAllAnswered);
    });

    btnCheck.addEventListener('click', function() {
        // if (isSelesai) return;

        const q1Val = document.querySelector('input[name="mq1"]:checked');
        const q2Val = document.querySelector('input[name="mq2"]:checked');
        const q3Val = document.querySelector('input[name="mq3"]:checked');
        const q4Val = document.querySelector('input[name="mq4"]:checked');
        const q5Val = document.querySelector('input[name="mq5"]:checked');

        let correctCount = 0;

        if (q1Val.value === 'A') correctCount++;
        if (q2Val.value === 'B') correctCount++;
        if (q3Val.value === 'C') correctCount++;
        if (q4Val.value === 'A') correctCount++;
        if (q5Val.value === 'D') correctCount++;

        if (correctCount === totalQuestions) {
            feedback.className = 'alert alert-success mt-3 shadow-sm text-center py-2 mb-0 small fade-in';
            feedback.innerHTML = `<i class="fa-solid fa-unlock-keyhole me-1"></i> <strong>Luar Biasa!</strong> (${correctCount}/${totalQuestions}) Benar.`;
            feedback.classList.remove('d-none');

            btnCheck.classList.add('d-none');
            btnReset.classList.remove('d-none');
            btnReset.innerHTML = '<i class="fa-solid fa-rotate-right me-1"></i> Reset Latihan';

            btnNextMateri.classList.remove('disabled');
            btnNextMateri.removeAttribute('tabindex');
            btnNextMateri.removeAttribute('aria-disabled');
            btnNextMateri.style.pointerEvents = 'auto';
            btnNextMateri.style.opacity = '1';

            if (lockIcon) {
                lockIcon.className = 'fa-solid fa-unlock me-1';
            }
            if(!isSelesai){ // agar kalau sdh pernah selesai progres tidak perlu disimpan
                fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        id_aktivitas: {{ $item->id }}
                    })
                }).catch(err => console.error(err));
            }

        } else {
            feedback.className = 'alert alert-danger mt-3 shadow-sm text-center py-2 mb-0 small fade-in';
            feedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation me-1"></i> Anda menjawab ${correctCount} dari ${totalQuestions} soal dengan benar. Silakan ulangi!`;
            feedback.classList.remove('d-none');

            btnCheck.classList.add('d-none');
            btnReset.classList.remove('d-none');
        }
    });

    btnReset.addEventListener('click', function() {
        document.querySelectorAll('#quizActivity input[type="radio"]').forEach(radio => {
            radio.checked = false;
            radio.disabled = false;
        });

        btnReset.classList.add('d-none');
        btnCheck.classList.add('d-none');

        feedback.classList.add('d-none');
        feedback.innerHTML = '';

        currentSlide = 0;
        showSlide(currentSlide);

        btnNextMateri.classList.remove('disabled');
        btnNextMateri.removeAttribute('tabindex');
        btnNextMateri.removeAttribute('aria-disabled');
        btnNextMateri.style.pointerEvents = 'auto';
        btnNextMateri.style.opacity = '1';

        if (lockIcon) {
            lockIcon.className = 'fa-solid fa-unlock me-1';
        }
    });

    showSlide(0);

    if (isSelesai) {
        tampilkanJawabanBenar();
    }
});
</script>
@endsection