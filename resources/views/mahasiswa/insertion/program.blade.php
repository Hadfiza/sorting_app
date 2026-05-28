@extends('layouts.hlmns')

@section('title','Kode Program Imsertion Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/insertion.css') }}">
@endsection

@section('content')

@php
    // Mengecek apakah materi ini sudah pernah diselesaikan
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
/* =========================
   CODEMIRROR 
========================= */

.live-editor {
    width: 100%;
    height: 500px;
    background: #1e1e1e;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    margin-top: 20px;
}

/* Header */
.live-editor .editor-header {
    padding: 10px 20px;
    background: #2d2d2d;
    border-bottom: 1px solid #444;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
}

.live-editor .editor-header h1 {
    margin: 0;
    font-size: 1rem;
}

/* Split layout */
.live-editor .split-container {
    display: flex;
    flex: 1;
    overflow: hidden;
}

/* Panel kiri */
.live-editor .panel-left {
    flex: 6;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #444;
}

/* Panel kanan */
.live-editor .panel-right {
    flex: 4;
    display: flex;
    flex-direction: column;
    background: #101010;
}

/* Label */
.live-editor .panel-label {
    background: #333;
    color: #ccc;
    padding: 5px 15px;
    font-size: 0.75rem;
    text-transform: uppercase;
}

/* CodeMirror */
.live-editor .CodeMirror {
    flex: 1;
    font-size: 14px;
}

/* Output */
.live-editor #output {
    flex: 1;
    padding: 15px;
    color: #00ff00;
    font-family: 'Courier New', monospace;
    white-space: pre-wrap;
    overflow-y: auto;
    font-size: 13px;
}

/* Run button */
.live-editor .btn-run {
    padding: 5px 15px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
}

/* === KODE TAMBAHAN DARI AI MULAI: CSS INPUT KODE === */
.code-input {
    background: #2d2d2d;
    border: 1px solid #555;
    color: #569cd6; 
    font-family: 'Courier New', monospace;
    padding: 2px 6px;
    border-radius: 4px;
    outline: none;
    font-size: 14px;
    transition: 0.3s ease;
}

.code-input:focus {
    border-color: #007acc;
    background: #1e1e1e;
}

.code-input.correct {
    border-color: #28a745 !important;
    background: rgba(40, 167, 69, 0.2) !important;
    color: #28a745;
}

.code-input.wrong {
    border-color: #dc3545 !important;
    background: rgba(220, 53, 69, 0.2) !important;
    color: #dc3545;
}
/* === KODE TAMBAHAN DARI AI SELESAI === */
</style>

<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma InsertionSort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program InsertionSort</span>
            </div>

            <div class="my-4 text-start">
                <div class="alert alert-warning mb-3">
                    <strong>Instruksi:</strong> Amati kode berikut dengan saksama,
                    kemudian ketik ulang pada fitur <em>Live Coding</em> di bawah tanpa melakukan copy–paste.
                </div>

                <div class="code-container">
<pre class="code-box">
def insertion_sort(data):
    n = len(data)
    for i in range(1, n):
        key = data[i]
        j = i - 1
        
        while j >= 0 and data[j] > key:
            data[j + 1] = data[j]
            j -= 1
            
        data[j + 1] = key
        print(f"Hasil setelah langkah ke-{i}: {data}")

angka = [4, 2, 5, 1, 3]
print("Sebelum sorting:", angka)
insertion_sort(angka)
print("Setelah sorting:", angka)
</pre>
                </div>
            </div>
            
            <hr class="my-4">

            <h5 class="fw-bold">Penjelasan Per Blok</h5>

            <div class="mb-4">
                <h6 class="fw-semibold">1. Deklarasi Fungsi dan Panjang Data</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>def insertion_sort(data):</span>
<span>    n = len(data)</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Baris ini mendefinisikan sebuah fungsi bernama <code>insertion_sort</code> yang menerima satu parameter berupa <code>data</code>. Variabel <code>n</code> digunakan untuk menghitung dan menyimpan total panjang atau jumlah elemen dari list tersebut agar dapat digunakan sebagai batas dalam proses perulangan.
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">2. Perulangan Utama dan Penentuan Key</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>for i in range(1, n):</span>
<span>    key = data[i]</span>
<span>    j = i - 1</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Perulangan dimulai dari indeks <code>1</code> (elemen kedua), karena elemen di indeks <code>0</code> dianggap sudah berada di bagian yang terurut. Pada setiap iterasi, elemen ke-<code>i</code> disimpan ke dalam variabel <code>key</code>. Variabel <code>j</code> diatur menunjuk pada indeks tepat di sebelah kiri <code>key</code> untuk memulai proses perbandingan bergerak mundur.
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">3. Perulangan Dalam (Proses Pergeseran)</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>while j >= 0 and data[j] > key:</span>
<span>    data[j + 1] = data[j]</span>
<span>    j -= 1</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Perulangan <code>while</code> akan terus berjalan selama <code>j</code> belum melewati batas kiri array (>= 0) <strong>dan</strong> elemen di kiri (<code>data[j]</code>) masih lebih besar dari nilai <code>key</code>. Jika kondisi ini terpenuhi, maka elemen yang lebih besar tersebut akan <strong>digeser satu posisi ke kanan</strong> (<code>data[j + 1] = data[j]</code>). Setelah itu, indeks <code>j</code> dikurangi 1 untuk membandingkan dengan elemen sebelumnya lagi.
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">4. Penyisipan Key (Insert)</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>data[j + 1] = key</span>
<span>print(f"Hasil setelah langkah ke-{i}: {data}")</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Setelah proses pergeseran dihentikan (artinya kita sudah menemukan elemen yang lebih kecil dari <code>key</code> atau sudah mencapai ujung paling kiri), kita <strong>menyisipkan</strong> nilai <code>key</code> ke posisi kosong yang telah disiapkan (<code>data[j + 1] = key</code>). Kemudian, sistem mencetak kondisi array untuk memantau perubahan secara bertahap.
                </p>
            </div>

            {{-- <div class="refleksi-alert mt-4">
                <h5 class="fw-bold mb-3">
                    Refleksi Konseptual
                </h5>

                <p class="mb-3">
                    Sebelum melanjutkan, pastikan Anda memahami hal berikut:
                </p>

                <ul class="mb-0">
                    <li class="mb-3">
                        <strong>Mengapa perulangan utama dimulai dari indeks 1, bukan 0?</strong><br>
                        Karena prinsip dasar Insertion Sort adalah menganggap bahwa elemen pertama (indeks 0) sudah berada di kelompok yang terurut. Oleh karena itu, kita mulai mengambil elemen kedua (indeks 1) untuk disisipkan ke kelompok tersebut.
                    </li>

                    <li class="mb-3">
                        <strong>Apa peran penting dari variabel <code>key</code>?</strong><br>
                        Saat elemen yang lebih besar digeser ke kanan (<code>data[j + 1] = data[j]</code>), nilai asli di indeks tersebut akan tertimpa. Menyimpan nilai tersebut di dalam variabel <code>key</code> mencegah data hilang dan memungkinkan kita untuk menyisipkannya kembali saat posisi yang tepat telah ditemukan.
                    </li>
                </ul>
            </div> --}}

        </div>
    </div>


    <div class="card mb-4 materi-box mt-4" id="fillCodeActivity">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fas fa-keyboard"></i>
                <span class="materi-badge">Aktivitas 4.2: Melengkapi Kode Program</span>
            </div>
            
            <p class="card-text mb-4 text-danger fw-bold">
                <i class="fa-solid fa-lock me-1"></i> Sebelum lanjut, lengkapi bagian kode yang kosong di bawah ini dengan benar untuk membuka akses ke Quiz!
            </p>

            <div class="code-container" style="background: #1e1e1e; padding: 20px; border-radius: 8px; color: #d4d4d4; font-family: 'Courier New', monospace; font-size: 14px; line-height: 2;">
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">insertion_sort</span>(data):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;n = <span style="color: #dcdcaa;">len</span>(data)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> i <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(<input type="text" id="i_blank1" class="code-input" placeholder="..." style="width: 40px; text-align: center;">, n): <span style="color: #6a9955;"># Mulai dari elemen kedua</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key = data[i]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;j = i - <span style="color: #b5cea8;">1</span><br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">while</span> j >= <span style="color: #b5cea8;">0</span> <span style="color: #c586c0;">and</span> data[j] <input type="text" id="i_blank2" class="code-input" placeholder="..." style="width: 40px; text-align: center;"> key: <span style="color: #6a9955;"># Cek apakah elemen kiri lebih besar</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[j + <span style="color: #b5cea8;">1</span>] = data[j]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;j -= <span style="color: #b5cea8;">1</span><br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[j + <span style="color: #b5cea8;">1</span>] = <input type="text" id="i_blank3" class="code-input" placeholder="..." style="width: 60px; text-align: center;"> <span style="color: #6a9955;"># Sisipkan elemen ke posisi yang tepat</span><br>
            </div>

            <div id="fillCodeFeedback" class="alert {{ $isSelesai ? 'alert-success' : 'd-none' }} mt-3">
                @if($isSelesai)
                    <i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Anda sangat tepat. Tombol Lanjut Quiz telah dibuka. Silakan coba kode ini pada Live Editor di bawah!
                @endif
            </div>
            
            <div class="text-start mt-3">
                <button id="btnCheckCode" class="btn btn-primary" {{ $isSelesai ? 'disabled' : '' }}>
                    {{ $isSelesai ? 'Kode Sudah Benar' : 'Periksa Kode' }}
                </button>
            </div>


        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body materi-text">
            <p>Jalankan kode program Insertion Sort di bawah ini untuk mengamati bagaimana Python memproses data.</p>
          
            <div class="live-editor">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        {{-- <span id="status" style="font-size: 0.8rem; color: #aaa;">⏳ Loading Pyodide...</span> --}}
                        <button id="runBtn" class="btn-run" disabled>▶ Run Code</button>
                    </div>
                </header>
                <div class="split-container">
                    <div class="panel-left">
                        <div class="panel-label">Input Kode</div>
                        <textarea id="code"></textarea>
                    </div>

                    <div class="panel-right">
                        <div class="panel-label">Console Output</div>
                        <div id="output"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','simulasi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['insertion','quiz']) }}" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       id="btnNextInsertion" 
       @if(!$isSelesai) tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;" @endif>
       Lanjut Quiz
    </a>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCheckCode = document.getElementById('btnCheckCode');
    const feedbackCode = document.getElementById('fillCodeFeedback');
    const btnNext = document.getElementById('btnNextInsertion');
    const lockIcon = document.getElementById('lockIconInsertion');

    btnCheckCode.addEventListener('click', function() {
        // Ambil nilai input
        const b1 = document.getElementById('i_blank1').value.trim(); // Jawaban: 1
        const b2 = document.getElementById('i_blank2').value.trim(); // Jawaban: >
        const b3 = document.getElementById('i_blank3').value.trim(); // Jawaban: key

        let correctCount = 0;

        // Validasi Blank 1
        if (b1 === '1') {
            document.getElementById('i_blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('i_blank1').className = 'code-input wrong';
        }

        // Validasi Blank 2
        if (b2 === '>') {
            document.getElementById('i_blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('i_blank2').className = 'code-input wrong';
        }

        // Validasi Blank 3
        if (b3 === 'key') {
            document.getElementById('i_blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('i_blank3').className = 'code-input wrong';
        }

        // Output Feedback
        if (correctCount === 3) {
            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Insertion Sort Anda sudah tepat. Tombol Lanjut Quiz telah dibuka. Silakan coba kode tersebut pada Live Editor!';
            // feedbackCode.classList.remove('d-none');
            
            // Buka gembok tombol Selanjutnya
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';          
            lockIcon.className = 'fa-solid fa-unlock me-1';

                // Kunci input dan tombol setelah berhasil
                document.getElementById('blank1').readOnly = true;
                document.getElementById('blank2').readOnly = true;
                document.getElementById('blank3').readOnly = true;
                btnCheckCode.disabled = true;
                btnCheckCode.innerText = 'Kode Sudah Benar';

                // Tembak data ke database tanpa reload halaman (AJAX yang sukses)
                fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json" // Header vital yang hilang sebelumnya
                    },
                    body: JSON.stringify({
                        id_aktivitas: {{ $item->id }} // Mengirim ID aktivitas saat ini
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        feedbackCode.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Bubble Sort sangat tepat. Akses ke halaman selanjutnya telah dibuka.';
                        feedbackCode.className = 'alert alert-success mt-3';
                        feedbackCode.classList.remove('d-none');
                        
                        btnCheckCode.innerText = 'Kode Sudah Benar';
                        
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
                    feedbackCode.innerHTML = 'Gagal menyimpan progres, silakan periksa koneksi Anda.';
                    feedbackCode.className = 'alert alert-danger mt-3';
                    feedbackCode.classList.remove('d-none');
                    btnCheckCode.disabled = false;
                    btnCheckCode.innerText = 'Coba Lagi';
                });

        } else {
            feedbackCode.className = 'alert alert-danger mt-3';
            feedbackCode.innerHTML = '<strong>Kurang Tepat!</strong> Ada jawaban yang masih salah. Coba baca kembali materi di atas.';
            feedbackCode.classList.remove('d-none');
        }
    });
});
</script>
<script>
window.IMG_PATH = "{{ asset('images/aset/nama') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection