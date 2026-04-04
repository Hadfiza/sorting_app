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
                Insertion Sort adalah algoritma pengurutan sederhana yang bekerja dengan cara menyisipkan elemen ke posisi yang tepat dalam kumpulan data yang sebagian telah terurut. Cara kerjanya mirip seperti seseorang menyusun kartu di tangan: setiap kartu baru dibandingkan dengan kartu-kartu sebelumnya, lalu ditempatkan pada posisi yang sesuai agar urutan tetap benar. Dalam prosesnya, Insertion Sort selalu menjaga agar bagian awal list berada dalam keadaan terurut, kemudian setiap item berikutnya disisipkan satu per satu ke posisi yang tepat di antara elemen-elemen yang sudah terurut tersebut.</br></br>

                Disebut Insertion karena proses utamanya adalah penyisipan elemen pada tempat yang benar. Meskipun memiliki kompleksitas waktu O(n²), algoritma ini bekerja dengan pendekatan yang berbeda dari Bubble Sort dan Selection Sort, yaitu dengan memastikan sebagian list sudah terurut pada setiap langkah. Pendekatan ini membuat Insertion Sort lebih efisien untuk data yang hampir terurut, karena hanya membutuhkan sedikit pergeseran elemen untuk mencapai urutan yang benar.
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
            
            <p>Berikut adalah simulasi interaktif untuk membantu Anda memahami cara kerja algoritma secara langsung. Klik tombol <strong> Mulai Visualisasi </strong> untuk mengamati proses pengurutan langkah demi langkah, atau tekan tombol <strong> Acak Data </strong> untuk mencoba simulasi dengan susunan angka yang baru. Pastikan Anda memperhatikan perubahan warna pada balok sesuai dengan keterangan status di bagian bawah.</p>

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

    <div class="card mb-4 materi-box mt-4" id="quizActivity">
        <div class="card-body materi-text">

            <div class="materi-header mb-3">
                <span class="materi-badge">Aktivitas 2.1: Uji Pemahaman Insertion Sort</span>
            </div>

            @if(!$isSelesai)
            <p class="card-text mb-4 text-danger fw-bold">
                Jawablah pertanyaan berikut secara berurutan dengan benar untuk membuka akses ke materi selanjutnya!
            </p>

            <div class="quiz-container">
                <div class="mb-4 fade-in" id="q1-container">
                    <p class="fw-semibold mb-2">1. Bagaimana analogi yang paling tepat untuk menggambarkan cara kerja Insertion Sort?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1a" value="A">
                        <label class="form-check-label" for="iq1a">A. Memilih nilai terkecil dari sisa data dan menaruhnya di awal.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1b" value="B">
                        <label class="form-check-label" for="iq1b">B. Menggelembungkan nilai terbesar ke posisi paling akhir secara bertahap.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1c" value="C">
                        <label class="form-check-label" for="iq1c">C. Menyusun kartu di tangan dengan menyisipkan kartu baru ke posisi yang tepat.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq1" id="iq1d" value="D">
                        <label class="form-check-label" for="iq1d">D. Memecah barisan data menjadi dua bagian yang lebih kecil terus menerus.</label>
                    </div>
                </div>

                <div class="mb-4 fade-in d-none" id="q2-container">
                    <p class="fw-semibold mb-2">2. Mengapa Insertion Sort dianggap lebih efisien untuk data yang hampir terurut (nearly sorted)?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2a" value="A">
                        <label class="form-check-label" for="iq2a">A. Karena jumlah pertukaran dan pergeseran elemen yang dibutuhkan menjadi sangat sedikit.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2b" value="B">
                        <label class="form-check-label" for="iq2b">B. Karena algoritma ini secara otomatis mengubah kompleksitas waktunya menjadi O(1).</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2c" value="C">
                        <label class="form-check-label" for="iq2c">C. Karena membagi data menjadi kelompok-kelompok kecil mempercepat proses komputasi.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq2" id="iq2d" value="D">
                        <label class="form-check-label" for="iq2d">D. Karena algoritma ini tidak menggunakan proses perulangan bersarang (nested loop).</label>
                    </div>
                </div>

                <div class="mb-4 fade-in d-none" id="q3-container">
                    <p class="fw-semibold mb-2">3. Apa yang dilakukan algoritma Insertion Sort (Ascending) jika menemukan elemen di sebelah kiri yang lebih besar dari elemen yang disisipkan (key)?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3a" value="A">
                        <label class="form-check-label" for="iq3a">A. Menghapus elemen yang lebih besar tersebut dari daftar.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3b" value="B">
                        <label class="form-check-label" for="iq3b">B. Menukar posisinya secara langsung dengan elemen yang paling akhir.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3c" value="C">
                        <label class="form-check-label" for="iq3c">C. Membatalkan proses pengurutan karena urutan dianggap salah dari awal.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq3" id="iq3d" value="D">
                        <label class="form-check-label" for="iq3d">D. Menggeser elemen yang lebih besar ke kanan untuk memberi ruang bagi elemen key.</label>
                    </div>
                </div>
            </div>

            <div id="insertionQuizFeedback" class="alert d-none mt-3"></div>
            <div class="text-start mt-3">
                <button id="btnCheckInsertionQuiz" class="btn btn-primary d-none">
                    Periksa Jawaban
                </button>
            </div>
            @else
                <div class="alert alert-success mt-2 mb-0">
                    <i class="bi bi-check-circle-fill me-2"></i> 
                    <strong>Selesai!</strong> Anda sudah menyelesaikan uji pemahaman ini. Tombol navigasi di bawah telah terbuka.
                </div>
            @endif

        </div>
    </div>
    </div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>
    
    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','simulasi']) }}" 
       id="btnNextInsertion" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
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
        
        // === KODE YANG DIEDIT AI MULAI: MENGHAPUS SWEETALERT ===
        // Menghapus notifikasi SweetAlert "Selesai!" agar tidak mengganggu fokus.
        // === KODE YANG DIEDIT AI SELESAI ===
    }

    document.addEventListener('DOMContentLoaded', initI);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const q1Inputs = document.querySelectorAll('input[name="iq1"]');
    const q2Inputs = document.querySelectorAll('input[name="iq2"]');
    const q3Inputs = document.querySelectorAll('input[name="iq3"]');
    
    const q2Container = document.getElementById('q2-container');
    const q3Container = document.getElementById('q3-container');
    const btnCheck = document.getElementById('btnCheckInsertionQuiz');
    
    const feedback = document.getElementById('insertionQuizFeedback');
    const btnNext = document.getElementById('btnNextInsertion');

    // Memunculkan soal 2 saat soal 1 dipilih
    q1Inputs.forEach(input => {
        input.addEventListener('change', () => {
            q2Container.classList.remove('d-none');
        });
    });

    // Memunculkan soal 3 saat soal 2 dipilih
    q2Inputs.forEach(input => {
        input.addEventListener('change', () => {
            q3Container.classList.remove('d-none');
        });
    });

    // Memunculkan tombol periksa saat soal 3 dipilih
    q3Inputs.forEach(input => {
        input.addEventListener('change', () => {
            btnCheck.classList.remove('d-none');
        });
    });

    // Pengecekan Jawaban Akhir
    btnCheck.addEventListener('click', function() {
        const q1 = document.querySelector('input[name="iq1"]:checked');
        const q2 = document.querySelector('input[name="iq2"]:checked');
        const q3 = document.querySelector('input[name="iq3"]:checked');

        if (!q1 || !q2 || !q3) {
            feedback.className = 'alert alert-warning mt-3';
            feedback.innerHTML = 'Harap pilih jawaban untuk semua soal terlebih dahulu!';
            feedback.classList.remove('d-none');
            return;
        }

        let correctCount = 0;
        if (q1.value === 'C') correctCount++; // Jawaban: Menyusun kartu di tangan...
        if (q2.value === 'A') correctCount++; // Jawaban: Jumlah pertukaran dan pergeseran sedikit...
        if (q3.value === 'D') correctCount++; // Jawaban: Menggeser elemen yang lebih besar ke kanan...

        if (correctCount === 3) {
            feedback.className = 'alert alert-success mt-3';
            feedback.innerHTML = 'Luar Biasa! Pemahaman Anda tentang Insertion Sort sangat tepat. Akses ke halaman selanjutnya telah dibuka.';
            feedback.classList.remove('d-none');
            
            // Tembak data ke database tanpa reload halaman (AJAX)
            fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    id_aktivitas: {{ $item->id }} // Mengirim ID aktivitas saat ini
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    feedback.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Bubble Sort sangat tepat. Akses ke halaman selanjutnya telah dibuka.';
                    
                    // Buka kunci tombol Selanjutnya
                    btnNext.classList.remove('disabled');
                    btnNext.removeAttribute('tabindex');
                    btnNext.removeAttribute('aria-disabled');
                    btnNext.style.pointerEvents = 'auto'; 
                    btnNext.style.opacity = '1';          
                }
            })
            .catch(error => {
                console.error("Error:", error);
                feedback.innerHTML = 'Gagal menyimpan progres, silakan periksa koneksi Anda.';
            });

        } else {
            feedback.className = 'alert alert-danger mt-3';
            feedback.innerHTML = 'Kurang Tepat! Ada jawaban yang masih salah. Coba baca kembali materi di atas.';
            feedback.classList.remove('d-none');
        }
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script src="{{ asset('js/insertionsort.js') }}"></script>

@endsection