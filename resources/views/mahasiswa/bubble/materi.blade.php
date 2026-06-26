@extends('layouts.hlmns')

@section('title','Materi Bubble Sort')

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
                <h3 class="mb-0">Algoritma BubbleSort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page">
    {{-- MATERI 1: TUJUAN PEMBELAJARAN --}}
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

    {{-- MATERI 2: PENGERTIAN --}}
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">Pengertian BubbleSort</span>
            </div>
            <p class="card-text text-justify">
                Bubble Sort adalah algoritma pengurutan berbasis perbandingan yang bekerja dengan cara membandingkan elemen-elemen yang bersebelahan dalam suatu daftar, kemudian menukarnya jika urutannya salah. Proses ini diulang terus menerus hingga seluruh elemen tersusun dengan benar. Nama "Bubble Sort" diambil dari fakta bahwa elemen yang lebih besar "menggelembung" ke posisi akhir daftar, sementara elemen yang lebih kecil bergerak ke awal.<br><br>

                Jika terdapat n data, maka proses perbandingan dilakukan sebanyak n–1 kali dalam satu iterasi. Proses ini terus berlanjut hingga tidak ada lagi pertukaran data yang terjadi, yang berarti data sudah terurut dengan sempurna. Setiap satu kali pemeriksaan seluruh data disebut satu iterasi (siklus).
                <br><br>
                Kompleksitas waktu Bubble Sort tergantung pada kondisi data yang diurutkan. Pada kondisi terbaik, yaitu ketika data sudah terurut, algoritma memiliki kompleksitas O(n) karena hanya memerlukan satu kali pemeriksaan. Namun, pada kondisi rata-rata dan terburuk, Bubble Sort memiliki kompleksitas O(n²) karena harus melakukan perbandingan dan pertukaran berulang kali hingga seluruh data terurut. Sementara itu, kompleksitas ruangnya adalah O(1) karena hanya membutuhkan sedikit variabel tambahan selama proses pengurutan.
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

    {{-- ILUSTRASI VISUALISASI INTERAKTIF --}}
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play-circle"></i>
                <span class="materi-badge">Ilustrasi Visualisasi</span>
            </div>
            
            <p class="mb-2">
                Berikut adalah simulasi interaktif yang memperlihatkan proses kerja algoritma Bubble Sort dalam mengurutkan data.
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
                <div class="stats-row">
                    {{-- <span>Time Complexity: O(n²)</span>
                    <span>Space Complexity: O(1)</span> --}}
                </div>

                <div id="visualizer-content" class="visualizer-area"></div>

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

<div class="card mb-1 materi-box mt-2 shadow-sm" id="quizActivity">
    <div class="card-body materi-text p-1 p-md-3">

        <div class="materi-header mb-3 d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-tasks text-primary"></i>
                <span class="materi-badge fs-6">Aktivitas 2.1: Uji Pemahaman</span>
            </div>
            <span class="badge bg-secondary rounded-pill" id="quizProgress">Soal 1 dari 5</span>
        </div>


        <div class="mb-2">
            <button class="btn btn-sm btn-outline-primary"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#instruksiPilganBubble">
                <i class="fa-solid fa-circle-info me-1"></i>
                Instruksi Pengerjaan
            </button>
        </div>

        <div class="collapse" id="instruksiPilganBubble">
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
                    1. Bagaimana prinsip utama cara kerja algoritma Bubble Sort?
                </p>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq1" id="bq1a" value="A">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq1a">
                        a. Membagi data menjadi dua bagian yang lebih kecil secara terus menerus
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq1" id="bq1b" value="B">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq1b">
                        b. Membandingkan dan menukar elemen yang bersebelahan jika urutannya salah
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq1" id="bq1c" value="C">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq1c">
                        c. Mencari nilai terkecil dan meletakkannya di posisi paling awal
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq1" id="bq1d" value="D">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq1d">
                        d. Menggabungkan dua array yang sudah terurut menjadi satu array
                    </label>
                </div>
            </div>

            <div class="quiz-slide d-none fade-in" id="slide-1">
                <p class="fw-semibold mb-2 text-dark">
                    2. Berdasarkan penjelasan materi, apa yang dijamin terjadi setelah satu kali iterasi atau siklus selesai dilakukan pada Bubble Sort secara ascending?
                </p>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq2" id="bq2a" value="A">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq2a">
                        a. Elemen terbesar akan berada di posisi paling akhir
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq2" id="bq2b" value="B">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq2b">
                        b. Seluruh data langsung terurut dengan sempurna
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq2" id="bq2c" value="C">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq2c">
                        c. Elemen terkecil akan berada di posisi paling akhir
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq2" id="bq2d" value="D">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq2d">
                        d. Data terbagi menjadi dua kelompok besar dan kecil
                    </label>
                </div>
            </div>

            <div class="quiz-slide d-none fade-in" id="slide-2">
                <p class="fw-semibold mb-2 text-dark">
                    3. Jika terdapat <code>n</code> data, berapakah jumlah perbandingan yang dilakukan dalam satu iterasi?
                </p>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq3" id="bq3a" value="A">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq3a">
                        a. n kali
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq3" id="bq3b" value="B">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq3b">
                        b. n-1 kali
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq3" id="bq3c" value="C">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq3c">
                        c. n+1 kali
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq3" id="bq3d" value="D">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq3d">
                        d. n/2 kali
                    </label>
                </div>
            </div>

            <div class="quiz-slide d-none fade-in" id="slide-3">
                <p class="fw-semibold mb-2 text-dark">
                    4. Dalam algoritma Bubble Sort, kapan proses pertukaran atau swap data berhenti dilakukan dalam satu iterasi?
                </p>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq4" id="bq4a" value="A">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq4a">
                        a. Ketika elemen pertama sudah lebih kecil dari elemen kedua
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq4" id="bq4b" value="B">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq4b">
                        b. Ketika elemen terkecil sudah berada di posisi paling akhir daftar
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq4" id="bq4c" value="C">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq4c">
                        c. Ketika indeks array sudah mencapai jumlah data
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq4" id="bq4d" value="D">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq4d">
                        d. Ketika sudah tidak ada lagi elemen yang lebih besar di kiri dibandingkan kanan
                    </label>
                </div>
            </div>

            <div class="quiz-slide d-none fade-in" id="slide-4">
                <p class="fw-semibold mb-2 text-dark">
                    5. Jika array <code>[1, 2, 3, 5, 4]</code> diurutkan menggunakan Bubble Sort, berapa iterasi minimal hingga data pasti terurut?
                </p>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq5" id="bq5a" value="A">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq5a">
                        a. 1 iterasi
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq5" id="bq5b" value="B">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq5b">
                        b. 5 iterasi
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq5" id="bq5c" value="C">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq5c">
                        c. 2 iterasi
                    </label>
                </div>

                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="bq5" id="bq5d" value="D">
                    <label class="form-check-label w-100" style="cursor:pointer;" for="bq5d">
                        d. 4 iterasi
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
    
    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','simulasi']) }}" 
    id="btnNextBubble" 
    class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
    {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
        <i class="fa-solid {{ $isSelesai ? 'fa-unlock' : 'fa-lock' }} me-1" id="lockIcon"></i>
        Selanjutnya
    </a>
</div>

{{-- LOGIKA ILUSTRASI --}}
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
                await sleepV(2000); //detik saat Membandingkan
                if (vData[j] > vData[j + 1]) {
                    [vData[j], vData[j + 1]] = [vData[j + 1], vData[j]];
                    renderV([j, j + 1], sortedIdx);
                    await sleepV(1500); //detik setelah menukar
                }
            }
            sortedIdx.push(n - 1 - i);
            renderV([], sortedIdx);
        }
        vResetBtn.disabled = false;
    }

    document.addEventListener('DOMContentLoaded', initV);
</script>

{{-- LOGIKA AKTIVITAS QUIZ --}}
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

    const btnNextMateri = document.getElementById('btnNextBubble');
    const lockIcon = document.getElementById('lockIcon');

    const totalQuestions = slides.length;
    let currentSlide = 0;

    const kunciJawaban = {
        bq1: 'B',
        bq2: 'A',
        bq3: 'B', 
        bq4: 'D',
        bq5: 'C'
    };

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('d-none', i !== index);
        });

        progressText.innerText = `Soal ${index + 1} dari ${totalQuestions}`;

        btnPrev.classList.toggle('d-none', index === 0);
        btnPrev.style.visibility = index === 0 ? 'hidden' : 'visible';

        btnNext.classList.toggle('d-none', index === totalQuestions - 1);
    }

    function tampilkanJawabanBenar() {
        Object.keys(kunciJawaban).forEach(function(name) {
            const radio = document.querySelector(
                `input[name="${name}"][value="${kunciJawaban[name]}"]`
            );

            if (radio) radio.checked = true;
        });

        // Pilihan tetap aktif agar bisa reset dan pilih ulang
        document.querySelectorAll('#quizActivity input[type="radio"]').forEach(function(radio) {
            radio.disabled = false;
        });
        // Periksa disembunyikan, reset ditampilkan
        btnCheck.classList.add('d-none');
        btnReset.classList.remove('d-none');
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
        // if (isSelesai) return; Agar saat klik reset, tombol periksa muncul lagi

        const q1Val = document.querySelector('input[name="bq1"]:checked');
        const q2Val = document.querySelector('input[name="bq2"]:checked');
        const q3Val = document.querySelector('input[name="bq3"]:checked');
        const q4Val = document.querySelector('input[name="bq4"]:checked');
        const q5Val = document.querySelector('input[name="bq5"]:checked');

        if (q1Val && q2Val && q3Val && q4Val && q5Val && btnReset.classList.contains('d-none')) {
            btnCheck.classList.remove('d-none');
        }
    }

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', checkAllAnswered);
    });

    btnCheck.addEventListener('click', function() {
        // if (isSelesai) return; // agar periksa ulang bisa

        const q1Val = document.querySelector('input[name="bq1"]:checked');
        const q2Val = document.querySelector('input[name="bq2"]:checked');
        const q3Val = document.querySelector('input[name="bq3"]:checked');
        const q4Val = document.querySelector('input[name="bq4"]:checked');
        const q5Val = document.querySelector('input[name="bq5"]:checked');

        let correctCount = 0;

        if (q1Val.value === kunciJawaban.bq1) correctCount++;
        if (q2Val.value === kunciJawaban.bq2) correctCount++;
        if (q3Val.value === kunciJawaban.bq3) correctCount++;
        if (q4Val.value === kunciJawaban.bq4) correctCount++;
        if (q5Val.value === kunciJawaban.bq5) correctCount++;

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>window.IMG_PATH = "{{ asset('images/buku') }}/";</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>

@endsection