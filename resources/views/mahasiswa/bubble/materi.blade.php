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
            
            <p>Berikut adalah simulasi interaktif untuk membantu Anda memahami cara kerja algoritma secara langsung. Klik tombol <strong> Mulai Visualisasi </strong> untuk mengamati proses pengurutan langkah demi langkah, atau tekan tombol <strong> Acak Data </strong> untuk mencoba simulasi dengan susunan angka yang baru. Pastikan Anda memperhatikan perubahan warna pada balok sesuai dengan keterangan status di bagian bawah.</p>
            
            <div class="sim-visual-container">
                <div class="stats-row">
                    <span>Time Complexity: O(n²)</span>
                    <span>Space Complexity: O(1)</span>
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

    <div class="card mb-4 materi-box mt-4" id="quizActivity">
        <div class="card-body materi-text">

            <div class="materi-header mb-3">
                <span class="materi-badge">Aktivitas 2.1: Uji Pemahaman</span>
            </div>

            @if(!$isSelesai)
            <p class="card-text mb-4 text-danger fw-bold">
                Jawablah pertanyaan berikut secara berurutan dengan benar untuk membuka akses ke materi selanjutnya!
            </p>

            <div class="quiz-container">
                <div class="mb-4 fade-in" id="q1-container">
                    <p class="fw-semibold mb-2">1. Bagaimana prinsip utama cara kerja algoritma Bubble Sort?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq1" id="bq1a" value="A">
                        <label class="form-check-label" for="bq1a">A. Membagi data menjadi dua bagian yang lebih kecil secara terus menerus</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq1" id="bq1b" value="B">
                        <label class="form-check-label" for="bq1b">B. Membandingkan dan menukar elemen yang bersebelahan jika urutannya salah</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq1" id="bq1c" value="C">
                        <label class="form-check-label" for="bq1c">C. Mencari nilai terkecil dan meletakkannya di posisi paling awal</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq1" id="bq1d" value="D">
                        <label class="form-check-label" for="bq1d">D. Menggabungkan dua array yang sudah terurut menjadi satu array</label>
                    </div>
                </div>

                <div class="mb-4 fade-in d-none" id="q2-container">
                    <p class="fw-semibold mb-2">2. Berdasarkan penjelasan materi, apa yang dijamin terjadi setelah satu kali iterasi (siklus) selesai dilakukan pada Bubble Sort (Ascending)?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq2" id="bq2a" value="A">
                        <label class="form-check-label" for="bq2a">A. Elemen terbesar akan berada di posisi paling akhir</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq2" id="bq2b" value="B">
                        <label class="form-check-label" for="bq2b">B. Seluruh data langsung terurut dengan sempurna</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq2" id="bq2c" value="C">
                        <label class="form-check-label" for="bq2c">C. Elemen terkecil akan berada di posisi paling akhir</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq2" id="bq2d" value="D">
                        <label class="form-check-label" for="bq2d">D. Data terbagi menjadi dua kelompok besar dan kecil</label>
                    </div>
                </div>

                <div class="mb-4 fade-in d-none" id="q3-container">
                    <p class="fw-semibold mb-2">3. Jika terdapat n data, berapakah jumlah perbandingan yang dilakukan dalam satu iterasi?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq3" id="bq3a" value="A">
                        <label class="form-check-label" for="bq3a">A. n kali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq3" id="bq3b" value="B">
                        <label class="form-check-label" for="bq3b">B. n-1 kali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq3" id="bq3c" value="C">
                        <label class="form-check-label" for="bq3c">C. n+1 kali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq3" id="bq3d" value="D">
                        <label class="form-check-label" for="bq3d">D. n/2 kali</label>
                    </div>
                </div>

                <!-- SOAL 4 -->
                <div class="mb-4 fade-in d-none" id="q4-container">
                    <p class="fw-semibold mb-2">
                        4. Dalam algoritma Bubble Sort, kapan proses pertukaran (swap) data berhenti dilakukan dalam satu iterasi?
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq4" id="bq4a" value="A">
                        <label class="form-check-label" for="bq4a">
                            A. Ketika elemen pertama sudah lebih kecil dari elemen kedua.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq4" id="bq4b" value="B">
                        <label class="form-check-label" for="bq4b">
                            B. Ketika elemen terkecil sudah berada di posisi paling akhir daftar.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq4" id="bq4c" value="C">
                        <label class="form-check-label" for="bq4c">
                            C. Ketika indeks array sudah mencapai jumlah data.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq4" id="bq4d" value="D">
                        <label class="form-check-label" for="bq4d">
                            D. Ketika sudah tidak ada lagi elemen yang lebih besar di kiri dibandingkan kanan.
                        </label>
                    </div>
                </div>


                <!-- SOAL 5 -->
                <div class="mb-4 fade-in d-none" id="q5-container">
                    <p class="fw-semibold mb-2">
                        5. Jika array [1, 2, 3, 5, 4] diurutkan menggunakan Bubble Sort, berapa iterasi minimal hingga data pasti terurut?
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq5" id="bq5a" value="A">
                        <label class="form-check-label" for="bq5a">A. 1 iterasi</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq5" id="bq5b" value="B">
                        <label class="form-check-label" for="bq5b">B. 5 iterasi</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq5" id="bq5c" value="C">
                        <label class="form-check-label" for="bq5c">C. 2 iterasi</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bq5" id="bq5d" value="D">
                        <label class="form-check-label" for="bq5d">D. 4 iterasi</label>
                    </div>
                </div>

            </div>

            <div id="bubbleQuizFeedback" class="alert d-none mt-3"></div>
            <div class="text-start mt-3">
                <button id="btnCheckBubbleQuiz" class="btn btn-primary d-none">
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
    
    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','simulasi']) }}" 
       id="btnNextBubble" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
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

{{-- LOGIKA AKTIVITAS QUIZ --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const q1Inputs = document.querySelectorAll('input[name="bq1"]');
    const q2Inputs = document.querySelectorAll('input[name="bq2"]');
    const q3Inputs = document.querySelectorAll('input[name="bq3"]');
    const q4Inputs = document.querySelectorAll('input[name="bq4"]');
    const q5Inputs = document.querySelectorAll('input[name="bq5"]');
    
    const q2Container = document.getElementById('q2-container');
    const q3Container = document.getElementById('q3-container');
    const q4Container = document.getElementById('q4-container');
    const q5Container = document.getElementById('q5-container');
    const btnCheck = document.getElementById('btnCheckBubbleQuiz');
    
    const feedback = document.getElementById('bubbleQuizFeedback');
    const btnNext = document.getElementById('btnNextBubble');

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

    // tampil soal 4
    q3Inputs.forEach(input => {
        input.addEventListener('change', () => {
            q4Container.classList.remove('d-none');
        });
    });

    // tampil soal 5
    q4Inputs.forEach(input => {
        input.addEventListener('change', () => {
            q5Container.classList.remove('d-none');
        });
    });

    // tombol check muncul di akhir
    q5Inputs.forEach(input => {
        input.addEventListener('change', () => {
            btnCheck.classList.remove('d-none');
        });
    });

    // Pengecekan Jawaban Akhir
    btnCheck.addEventListener('click', function() {
        const q1 = document.querySelector('input[name="bq1"]:checked');
        const q2 = document.querySelector('input[name="bq2"]:checked');
        const q3 = document.querySelector('input[name="bq3"]:checked');
        const q4 = document.querySelector('input[name="bq4"]:checked');
        const q5 = document.querySelector('input[name="bq5"]:checked');

        if (!q1 || !q2 || !q3 || !q4 || !q5) {
            feedback.className = 'alert alert-warning mt-3';
            feedback.innerHTML = 'Harap pilih jawaban untuk semua soal terlebih dahulu!';
            feedback.classList.remove('d-none');
            return;
        }

        let correctCount = 0;
        if (q1.value === 'B') correctCount++; 
        if (q2.value === 'A') correctCount++; 
        if (q3.value === 'B') correctCount++; 
        if (q4.value === 'D') correctCount++; 
        if (q5.value === 'C') correctCount++; 

        if (correctCount === 5) {
            feedback.className = 'alert alert-success mt-3';
            feedback.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Bubble Sort sangat tepat. Akses ke halaman selanjutnya telah dibuka.';
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
            feedback.innerHTML = '<strong>Kurang Tepat!</strong> Ada jawaban yang masih salah. Coba baca kembali materi di atas.';
            feedback.classList.remove('d-none');
        }
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>window.IMG_PATH = "{{ asset('images/buku') }}/";</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>

@endsection