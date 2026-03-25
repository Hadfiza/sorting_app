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

    {{-- ILUSTRASI VISUALISASI --}}
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

    <div class="card mb-4 materi-box mt-4" id="quizActivity">
        <div class="card-body materi-text">

            <div class="materi-header mb-3">
                <span class="materi-badge">Aktivitas 2.1: Uji Pemahaman Selection Sort</span>
            </div>

            <p class="card-text mb-4 text-danger fw-bold">
                Jawablah pertanyaan berikut secara berurutan dengan benar untuk membuka akses ke materi selanjutnya!
            </p>

            <div class="quiz-container">
                <div class="mb-4 fade-in" id="q1-container">
                    <p class="fw-semibold mb-2">1. Bagaimana prinsip utama cara kerja algoritma Selection Sort (Ascending)?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1a" value="A">
                        <label class="form-check-label" for="sq1a">A. Membandingkan elemen bersebelahan dan menukarnya secara terus menerus.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1b" value="B">
                        <label class="form-check-label" for="sq1b">B. Memilih elemen terkecil dari data yang belum terurut dan menempatkannya di posisi awal.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1c" value="C">
                        <label class="form-check-label" for="sq1c">C. Memecah data menjadi dua bagian hingga tersisa satu elemen.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq1" id="sq1d" value="D">
                        <label class="form-check-label" for="sq1d">D. Menyisipkan elemen ke posisi yang tepat pada bagian yang sudah terurut.</label>
                    </div>
                </div>

                <div class="mb-4 fade-in d-none" id="q2-container">
                    <p class="fw-semibold mb-2">2. Berapa jumlah maksimal pertukaran (swap) yang dilakukan Selection Sort untuk mengurutkan n data?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2a" value="A">
                        <label class="form-check-label" for="sq2a">A. n kali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2b" value="B">
                        <label class="form-check-label" for="sq2b">B. n - 1 kali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2c" value="C">
                        <label class="form-check-label" for="sq2c">C. n² kali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq2" id="sq2d" value="D">
                        <label class="form-check-label" for="sq2d">D. n/2 kali</label>
                    </div>
                </div>

                <div class="mb-4 fade-in d-none" id="q3-container">
                    <p class="fw-semibold mb-2">3. Mengapa kompleksitas waktu Selection Sort tetap O(n²) meskipun jumlah pertukarannya lebih sedikit dari Bubble Sort?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3a" value="A">
                        <label class="form-check-label" for="sq3a">A. Karena memerlukan ruang memori tambahan yang besar untuk menyimpan nilai minimum.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3b" value="B">
                        <label class="form-check-label" for="sq3b">B. Karena algoritma ini tetap melakukan proses pencarian minimum pada setiap iterasi yang membandingkan semua sisa elemen.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3c" value="C">
                        <label class="form-check-label" for="sq3c">C. Karena array selalu dipecah menjadi dua bagian yang tidak seimbang.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sq3" id="sq3d" value="D">
                        <label class="form-check-label" for="sq3d">D. Karena pertukaran selalu dilakukan dengan elemen yang berada di posisi paling akhir.</label>
                    </div>
                </div>
            </div>

            <div id="selectionQuizFeedback" class="alert d-none mt-3"></div>
            <div class="text-start mt-3">
                <button id="btnCheckSelectionQuiz" class="btn btn-primary d-none">
                    Periksa Jawaban
                </button>
            </div>

        </div>
    </div>
    </div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>
    
    <a href="{{ route('mahasiswa.aktivitas.show',['selection','simulasi']) }}" 
       class="btn btn-success disabled" id="btnNextSelection" tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;">
        Selanjutnya
    </a>
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
        
        // Menghapus sweetalert "Selesai!" agar tidak ada alert bawaan.
    }

    document.addEventListener('DOMContentLoaded', initS);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const q1Inputs = document.querySelectorAll('input[name="sq1"]');
    const q2Inputs = document.querySelectorAll('input[name="sq2"]');
    const q3Inputs = document.querySelectorAll('input[name="sq3"]');
    
    const q2Container = document.getElementById('q2-container');
    const q3Container = document.getElementById('q3-container');
    const btnCheck = document.getElementById('btnCheckSelectionQuiz');
    
    const feedback = document.getElementById('selectionQuizFeedback');
    const btnNext = document.getElementById('btnNextSelection');

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
        const q1 = document.querySelector('input[name="sq1"]:checked');
        const q2 = document.querySelector('input[name="sq2"]:checked');
        const q3 = document.querySelector('input[name="sq3"]:checked');

        if (!q1 || !q2 || !q3) {
            feedback.className = 'alert alert-warning mt-3';
            feedback.innerHTML = 'Harap pilih jawaban untuk semua soal terlebih dahulu!';
            feedback.classList.remove('d-none');
            return;
        }

        let correctCount = 0;
        if (q1.value === 'B') correctCount++; 
        if (q2.value === 'B') correctCount++; 
        if (q3.value === 'B') correctCount++; 

        if (correctCount === 3) {
            feedback.className = 'alert alert-success mt-3';
            feedback.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Selection Sort sangat tepat. Akses ke halaman selanjutnya telah dibuka.';
            feedback.classList.remove('d-none');
            
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto'; 
            btnNext.style.opacity = '1';          

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
<script>window.IMG_PATH = "{{ asset('images/aset/kaleng') }}/";</script>
<script src="{{ asset('js/selectionsort.js') }}"></script>

@endsection