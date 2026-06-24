@extends('layouts.hlmns')

@section('title','Materi Selection Sort')

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
                <br><br>
                Kompleksitas waktu Selection Sort adalah O(n²) pada kondisi terbaik, rata-rata, maupun terburuk karena algoritma selalu melakukan pencarian elemen terkecil atau terbesar pada bagian data yang belum terurut. Meskipun jumlah pertukaran data relatif sedikit dibandingkan Bubble Sort, jumlah perbandingan yang dilakukan tetap sama sehingga waktu eksekusinya tidak banyak berubah. Sementara itu, kompleksitas ruangnya adalah O(1) karena hanya menggunakan beberapa variabel tambahan selama proses pengurutan.
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


    {{-- ILUSTRASI VISUALISASI --}}
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play-circle"></i>
                <span class="materi-badge">Ilustrasi Visualisasi</span>
            </div>

            <p class="mb-2">
                Berikut adalah simulasi interaktif yang memperlihatkan proses kerja algoritma Selection Sort dalam mengurutkan data.
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
                    <span>Time Complexity: O(n²)</span>
                    <span>Space Complexity: O(1)</span>
                </div> --}}

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

    <div class="card mb-1 materi-box mt-2 shadow-sm" id="quizActivity">
        <div class="card-body materi-text p-1 p-md-3">

            <div class="materi-header mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-tasks text-primary"></i>
                    <span class="materi-badge fs-6">Aktivitas 2.1: Uji Pemahaman Selection Sort</span>
                </div>
                <span class="badge bg-secondary rounded-pill" id="quizProgress">Soal 1 dari 5</span>
            </div>

            <div class="mb-2">
                <button class="btn btn-sm btn-outline-primary"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#instruksiPilganSelection">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Instruksi Pengerjaan
                </button>
            </div>

            <div class="collapse" id="instruksiPilganSelection">
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
                        1. Bagaimana prinsip utama cara kerja algoritma Selection Sort secara ascending?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq1a">
                            a. Membandingkan elemen bersebelahan dan menukarnya secara terus menerus
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq1b">
                            b. Menyisipkan elemen ke posisi yang tepat pada bagian yang sudah terurut
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq1c">
                            c. Memecah data menjadi dua bagian hingga tersisa satu elemen
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq1d">
                            d. Memilih elemen terkecil dari data yang belum terurut dan menempatkannya di posisi awal
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-1">
                    <p class="fw-semibold mb-2 text-dark">
                        2. Berapa jumlah maksimal pertukaran atau swap yang dilakukan Selection Sort untuk mengurutkan <code>n</code> data?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq2a">
                            a. n kali
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq2b">
                            b. n - 1 kali
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq2c">
                            c. n² kali
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq2d">
                            d. n/2 kali
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-2">
                    <p class="fw-semibold mb-2 text-dark">
                        3. Mengapa kompleksitas waktu Selection Sort tetap O(n²) meskipun jumlah pertukarannya lebih sedikit dari Bubble Sort?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq3a">
                            a. Karena memerlukan ruang memori tambahan yang besar untuk menyimpan nilai minimum
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq3b">
                            b. Karena pertukaran selalu dilakukan dengan elemen yang berada di posisi paling akhir
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq3c">
                            c. Karena array selalu dipecah menjadi dua bagian yang tidak seimbang
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq3d">
                            d. Karena algoritma ini tetap melakukan proses pencarian minimum pada setiap iterasi yang membandingkan semua sisa elemen
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-3">
                    <p class="fw-semibold mb-2 text-dark">
                        4. Jika array <code>[64, 25, 12, 22, 11]</code> diurutkan secara ascending menggunakan Selection Sort, nilai manakah yang akan menempati posisi pertama setelah iterasi pertama selesai?
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq4" id="sq4a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq4a">
                            a. 64
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq4" id="sq4b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq4b">
                            b. 25
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq4" id="sq4c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq4c">
                            c. 11
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq4" id="sq4d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq4d">
                            d. 12
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-4">
                    <p class="fw-semibold mb-2 text-dark">
                        5. Keunggulan utama Selection Sort dibandingkan Bubble Sort dalam hal penggunaan sumber daya adalah:
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq5" id="sq5a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq5a">
                            a. Jumlah operasi penulisan ke memori atau swap lebih sedikit dan terukur
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq5" id="sq5b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq5b">
                            b. Memiliki kompleksitas waktu yang lebih kecil, yaitu O(n)
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq5" id="sq5c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq5c">
                            c. Lebih cepat dalam mengurutkan data yang sudah hampir terurut
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="sq5" id="sq5d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="sq5d">
                            d. Tidak memerlukan perbandingan elemen sama sekali
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
    
    <a href="{{ route('mahasiswa.aktivitas.show',['selection','simulasi']) }}" 
    id="btnNextSelection" 
    class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
    {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
        <i class="fa-solid {{ $isSelesai ? 'fa-unlock' : 'fa-lock' }} me-1" id="lockIcon"></i>
        Selanjutnya
    </a>
    </div>

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

    const btnNextMateri = document.getElementById('btnNextSelection');
    const lockIcon = document.getElementById('lockIcon');

    const totalQuestions = slides.length;
    let currentSlide = 0;

    const kunciJawaban = {
        sq1: 'D',
        sq2: 'B',
        sq3: 'D',
        sq4: 'C',
        sq5: 'A'
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

            if (radio) radio.checked = true;
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

        const q1Val = document.querySelector('input[name="sq1"]:checked');
        const q2Val = document.querySelector('input[name="sq2"]:checked');
        const q3Val = document.querySelector('input[name="sq3"]:checked');
        const q4Val = document.querySelector('input[name="sq4"]:checked');
        const q5Val = document.querySelector('input[name="sq5"]:checked');

        if (q1Val && q2Val && q3Val && q4Val && q5Val && btnReset.classList.contains('d-none')) {
            btnCheck.classList.remove('d-none');
        }
    }

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', checkAllAnswered);
    });

    btnCheck.addEventListener('click', function() {
        if (isSelesai) return;

        const q1Val = document.querySelector('input[name="sq1"]:checked');
        const q2Val = document.querySelector('input[name="sq2"]:checked');
        const q3Val = document.querySelector('input[name="sq3"]:checked');
        const q4Val = document.querySelector('input[name="sq4"]:checked');
        const q5Val = document.querySelector('input[name="sq5"]:checked');

        let correctCount = 0;

        if (q1Val.value === kunciJawaban.sq1) correctCount++;
        if (q2Val.value === kunciJawaban.sq2) correctCount++;
        if (q3Val.value === kunciJawaban.sq3) correctCount++;
        if (q4Val.value === kunciJawaban.sq4) correctCount++;
        if (q5Val.value === kunciJawaban.sq5) correctCount++;

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
            await sleepS(1200); // jeda 1,2 detik saat menampilkan nilai minimum awal

            for (let j = i + 1; j < n; j++) {
                renderS(j, min_idx, sortedIndices);
                await sleepS(1200); // jeda 1,2 detik saat memeriksa atau membandingkan data

                if (sData[j] < sData[min_idx]) {
                    min_idx = j;
                    renderS(-1, min_idx, sortedIndices);
                    await sleepS(1200); // jeda 1,2 detik saat minimum baru ditemukan
                }
            }

            if (min_idx !== i) {
                [sData[i], sData[min_idx]] = [sData[min_idx], sData[i]];
            }
            sortedIndices.push(i);
            renderS(-1, -1, sortedIndices);
            await sleepS(1200); // jeda 1,2 detik saat menandai data sudah terurut
        }
        
        sortedIndices.push(n - 1);
        renderS(-1, -1, sortedIndices);
        sResetBtn.disabled = false;
        
        // Menghapus sweetalert "Selesai!" agar tidak ada alert bawaan.
    }
    document.addEventListener('DOMContentLoaded', initS);
</script>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>window.IMG_PATH = "{{ asset('images/aset/kaleng') }}/";</script>
<script src="{{ asset('js/selectionsort.js') }}"></script>

@endsection