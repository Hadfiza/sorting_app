@extends('layouts.hlmns')

@section('title','Materi Insertion Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/insertion.css') }}">
<style>
    /* Style Tambahan untuk Ilustrasi Visualisasi Insertion Sort */
    .sim-visual-container {
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        /* padding: 25px; */
        margin: 20px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        text-align: center;
        overflow-x: auto; /* Memungkinkan scroll horizontal jika tree terlalu lebar */
        -webkit-overflow-scrolling: touch;
        padding: 15px !important;
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

    .tree-level {
        display: flex;
        justify-content: center;
        gap: 10px !important; /* Perkecil jarak antar node di HP */
        width: max-content; /* Pastikan container mengikuti lebar isi agar bisa di-scroll */
        min-width: 100%;
        margin-bottom: 20px;
    }

    #insertion-visualizer {
        display: flex;
        align-items: flex-end;
        justify-content: center; /* Center di desktop */
        gap: 5px;
        height: 200px;
        padding: 10px;
        overflow-x: auto; /* Wajib untuk responsif HP */
        -webkit-overflow-scrolling: touch;
        background: #161b22;
        border-radius: 8px;
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
                Insertion Sort adalah algoritma pengurutan sederhana yang bekerja dengan cara mengambil elemen satu per satu, kemudian menyisipkannya pada posisi yang sesuai di antara elemen-elemen yang telah diurutkan sebelumnya. Cara kerjanya mirip seperti seseorang menyusun kartu nama berdasarkan urutan abjad. Setiap kartu nama baru dibandingkan dengan kartu-kartu yang sudah tersusun, kemudian disisipkan pada posisi yang tepat sehingga urutan nama tetap terjaga. Dalam prosesnya, Insertion Sort selalu menjaga agar bagian awal list berada dalam keadaan terurut, kemudian setiap item berikutnya disisipkan satu per satu ke posisi yang tepat di antara elemen-elemen yang sudah terurut tersebut. Disebut Insertion karena proses utamanya adalah penyisipan elemen pada tempat yang benar.
                <br><br>
                Kompleksitas waktu Insertion Sort tergantung pada kondisi data yang diurutkan. Pada kondisi terbaik, yaitu ketika data sudah terurut, algoritma memiliki kompleksitas O(n) karena hanya memerlukan satu kali perbandingan untuk setiap elemen. Namun, pada kondisi rata-rata dan terburuk, kompleksitas waktunya menjadi O(n²) karena setiap elemen mungkin harus digeser beberapa kali hingga berada pada posisi yang tepat. Sementara itu, kompleksitas ruangnya adalah O(1) karena hanya menggunakan sedikit variabel tambahan selama proses pengurutan.
            </p>
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

    {{-- ILUSTRASI VISUALISASI INTERAKTIF --}}
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play-circle"></i>
                <span class="materi-badge">Ilustrasi Visualisasi</span>
            </div>
            
            <p class="mb-2">
                Berikut adalah simulasi interaktif yang memperlihatkan proses kerja algoritma Insertion Sort dalam mengurutkan data.
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
                    <span>Complexity: O(n²)</span>
                    <span>Space: O(1)</span>
                </div> --}}

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

    <div class="card mb-1 materi-box mt-2 shadow-sm" id="quizActivity">
        <div class="card-body materi-text p-1 p-md-3">

            <div class="materi-header mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-tasks text-primary"></i>
                    <span class="materi-badge fs-6">Aktivitas 4.1: Uji Pemahaman Insertion Sort</span>
                </div>
                <span class="badge bg-secondary rounded-pill" id="quizProgress">Soal 1 dari 5</span>
            </div>

            <div class="mb-2">
                <button class="btn btn-sm btn-outline-primary"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#instruksiPilganInsertion">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Instruksi Pengerjaan
                </button>
            </div>

            <div class="collapse" id="instruksiPilganInsertion">
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
                        1. Bagaimana analogi yang paling tepat untuk menggambarkan cara kerja Insertion Sort?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq1a">
                            a. Memilih nilai terkecil dari sisa data dan menaruhnya di awal
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq1b">
                            b. Menggelembungkan nilai terbesar ke posisi paling akhir secara bertahap
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq1c">
                            c. Menyusun kartu di tangan dengan menyisipkan kartu baru ke posisi yang tepat
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq1d">
                            d. Memecah barisan data menjadi dua bagian yang lebih kecil terus menerus
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-1">
                    <p class="fw-semibold mb-2 text-dark">
                        2. Mengapa Insertion Sort dianggap lebih efisien untuk data yang hampir terurut?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq2a">
                            a. Karena jumlah pertukaran dan pergeseran elemen yang dibutuhkan menjadi sangat sedikit
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq2b">
                            b. Karena algoritma ini secara otomatis mengubah kompleksitas waktunya menjadi O(1)
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq2c">
                            c. Karena membagi data menjadi kelompok-kelompok kecil mempercepat proses komputasi
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq2d">
                            d. Karena algoritma ini tidak menggunakan proses perulangan bersarang
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-2">
                    <p class="fw-semibold mb-2 text-dark">
                        3. Apa yang dilakukan Insertion Sort secara ascending jika menemukan elemen di sebelah kiri yang lebih besar dari elemen yang disisipkan atau <em>key</em>?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq3a">
                            a. Menghapus elemen yang lebih besar tersebut dari daftar
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq3b">
                            b. Menukar posisinya secara langsung dengan elemen yang paling akhir
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq3c">
                            c. Membatalkan proses pengurutan karena urutan dianggap salah dari awal
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq3d">
                            d. Menggeser elemen yang lebih besar ke kanan untuk memberi ruang bagi elemen key
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-3">
                    <p class="fw-semibold mb-2 text-dark">
                        4. Pada algoritma Insertion Sort, elemen pertama dari kumpulan data dianggap sebagai ...
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq4" id="iq4a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq4a">
                            a. Elemen yang harus dipindahkan ke posisi paling akhir
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq4" id="iq4b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq4b">
                            b. Bagian dari daftar yang sudah terurut
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq4" id="iq4c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq4c">
                            c. Elemen yang memiliki nilai paling besar secara otomatis
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq4" id="iq4d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq4d">
                            d. Data sementara yang harus dihapus untuk memberi ruang bagi key
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-4">
                    <p class="fw-semibold mb-2 text-dark">
                        5. Perhatikan array berikut: <code>[3, 10, 4, 1, 5]</code>. Jika angka <code>4</code> dipilih sebagai key, urutan data yang benar setelah disisipkan adalah ...
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq5" id="iq5a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq5a">
                            a. [3, 1, 4, 5, 10]
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq5" id="iq5b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq5b">
                            b. [1, 3, 4, 10, 5]
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq5" id="iq5c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq5c">
                            c. [3, 4, 10, 1, 5]
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="iq5" id="iq5d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="iq5d">
                            d. [4, 3, 10, 1, 5]
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
    
    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','simulasi']) }}" 
    id="btnNextInsertion"
    class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}"
    {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
        <i class="fa-solid {{ $isSelesai ? 'fa-unlock' : 'fa-lock' }} me-1" id="lockIcon"></i>
        Selanjutnya
    </a>
    </div>

{{-- SCRIPT VISUALISASI INSERTION SORT --}}
<script>
    let iData = [];
    const iCont = document.getElementById("insertion-visualizer");
    const iStartBtn = document.getElementById("iStartBtn");
    const iResetBtn = document.getElementById("iResetBtn");

    function initI() {
        // Menyesuaikan jumlah data untuk layar kecil agar tidak terlalu panjang
        const dataCount = window.innerWidth < 768 ? 6 : 10;
        iData = Array.from({ length: dataCount }, () => Math.floor(Math.random() * 70) + 15);
        renderI();
        iStartBtn.disabled = false;
        iResetBtn.disabled = false;
    }

    // Fungsi pembantu untuk scroll otomatis di HP
    function scrollToActiveBar(idx) {
        const bars = iCont.getElementsByClassName("bar-item");
        if (bars[idx]) {
            bars[idx].scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });
        }
    }

    function renderI(activeKey = -1, compareIdx = -1, sortedLimit = -1) {
        iCont.innerHTML = "";
        iData.forEach((val, idx) => {
            const bar = document.createElement("div");
            bar.className = "bar-item";
            
            // Menggunakan transform atau variabel CSS agar lebih fleksibel di HP
            bar.style.height = `${val * 2}px`;
            
            if (idx <= sortedLimit) bar.classList.add("is-sorted");
            if (idx === activeKey) {
                bar.classList.add("active-key");
                // Scroll otomatis ke elemen yang sedang aktif
                setTimeout(() => scrollToActiveBar(idx), 50);
            }
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

            renderI(i, -1, i - 1);
            await sleepI(1200); // saat memilih key

            while (j >= 0 && iData[j] > key) {
                renderI(j + 1, j, i - 1);
                await sleepI(1000); // saat membandingkan

                iData[j + 1] = iData[j];
                j = j - 1;
                
                renderI(j + 1, -1, i - 1);
                await sleepI(800);  // saat menggeser data
            }
            iData[j + 1] = key;
            
            renderI(-1, -1, i);
            await sleepI(1200); // setelah key disisipkan
        }

        iResetBtn.disabled = false;
        
        // Tetap memberikan feedback visual tanpa SweetAlert
        iCont.style.border = "2px solid #3fb950";
        setTimeout(() => { iCont.style.border = "1px solid #30363d"; }, 2000);
    }

    document.addEventListener('DOMContentLoaded', initI);
    // Re-init saat layar diputar/diubah ukurannya
    window.addEventListener('resize', () => {
        if (!iStartBtn.disabled) initI();
    });
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

    const btnNextMateri = document.getElementById('btnNextInsertion');
    const lockIcon = document.getElementById('lockIcon');

    const totalQuestions = slides.length;
    let currentSlide = 0;

    const kunciJawaban = {
        iq1: 'C',
        iq2: 'A',
        iq3: 'D',
        iq4: 'B',
        iq5: 'C'
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

        document.querySelectorAll('#quizActivity input[type="radio"]').forEach(function(radio) {
            radio.disabled = true;
        });

        btnCheck.classList.add('d-none');
        btnReset.classList.add('d-none');

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
        if (isSelesai) return;

        const q1Val = document.querySelector('input[name="iq1"]:checked');
        const q2Val = document.querySelector('input[name="iq2"]:checked');
        const q3Val = document.querySelector('input[name="iq3"]:checked');
        const q4Val = document.querySelector('input[name="iq4"]:checked');
        const q5Val = document.querySelector('input[name="iq5"]:checked');

        if (q1Val && q2Val && q3Val && q4Val && q5Val && btnReset.classList.contains('d-none')) {
            btnCheck.classList.remove('d-none');
        }
    }

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', checkAllAnswered);
    });

    btnCheck.addEventListener('click', function() {
        if (isSelesai) return;

        const q1Val = document.querySelector('input[name="iq1"]:checked');
        const q2Val = document.querySelector('input[name="iq2"]:checked');
        const q3Val = document.querySelector('input[name="iq3"]:checked');
        const q4Val = document.querySelector('input[name="iq4"]:checked');
        const q5Val = document.querySelector('input[name="iq5"]:checked');

        let correctCount = 0;

        if (q1Val.value === kunciJawaban.iq1) correctCount++;
        if (q2Val.value === kunciJawaban.iq2) correctCount++;
        if (q3Val.value === kunciJawaban.iq3) correctCount++;
        if (q4Val.value === kunciJawaban.iq4) correctCount++;
        if (q5Val.value === kunciJawaban.iq5) correctCount++;

        if (correctCount === totalQuestions) {
            feedback.className = 'alert alert-success mt-3 shadow-sm text-center py-2 mb-0 small fade-in';
            feedback.innerHTML = `<i class="fa-solid fa-unlock-keyhole me-1"></i> <strong>Luar Biasa!</strong> (${correctCount}/${totalQuestions}) Benar.`;
            feedback.classList.remove('d-none');

            btnCheck.classList.add('d-none');

            btnNextMateri.classList.remove('disabled');
            btnNextMateri.removeAttribute('tabindex');
            btnNextMateri.removeAttribute('aria-disabled');
            btnNextMateri.style.pointerEvents = 'auto';
            btnNextMateri.style.opacity = '1';

            if (lockIcon) {
                lockIcon.className = 'fa-solid fa-unlock me-1';
            }

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

        } else {
            feedback.className = 'alert alert-danger mt-3 shadow-sm text-center py-2 mb-0 small fade-in';
            feedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation me-1"></i> Anda menjawab ${correctCount} dari ${totalQuestions} soal dengan benar. Silakan ulangi!`;
            feedback.classList.remove('d-none');

            btnCheck.classList.add('d-none');
            btnReset.classList.remove('d-none');
        }
    });

    btnReset.addEventListener('click', function() {
        if (isSelesai) return;

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.checked = false;
        });

        btnReset.classList.add('d-none');
        feedback.classList.add('d-none');

        currentSlide = 0;
        showSlide(currentSlide);
    });

    showSlide(0);

    if (isSelesai) {
        tampilkanJawabanBenar();
    }
});
</script>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script src="{{ asset('js/insertionsort.js') }}"></script>

@endsection