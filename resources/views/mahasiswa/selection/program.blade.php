@extends('layouts.hlmns')

@section('title','SelectionSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/selection.css') }}">
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

<style>
/* =========================
   CODEMIRROR & LIVE EDITOR
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

.live-editor .split-container {
    display: flex;
    flex: 1;
    overflow: hidden;
}

.live-editor .panel-left {
    flex: 6;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #444;
}

.live-editor .panel-right {
    flex: 4;
    display: flex;
    flex-direction: column;
    background: #101010;
}

.live-editor .panel-label {
    background: #333;
    color: #ccc;
    padding: 5px 15px;
    font-size: 0.75rem;
    text-transform: uppercase;
}

.live-editor .CodeMirror {
    flex: 1;
    font-size: 14px;
}

.live-editor #output {
    flex: 1;
    padding: 15px;
    color: #00ff00;
    font-family: 'Courier New', monospace;
    white-space: pre-wrap;
    overflow-y: auto;
    font-size: 13px;
}

.live-editor .btn-run {
    padding: 5px 15px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
}

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
</style>

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

<div class="materi-page ">
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program SelectionSort</span>
            </div>

            <div class="my-4 text-start">
                <div class="alert alert-warning mb-3">
                    <strong>Instruksi:</strong> Amati kode berikut dengan saksama,
                    kemudian ketik ulang pada fitur <em>Live Coding</em> di bawah tanpa melakukan copy–paste.
                </div>

                <div class="code-container">
<pre class="code-box">
def selection_sort(data):
    n = len(data)
    for i in range(n-1):
        min_index = i
        for j in range(i+1, n):
            if data[j] < data[min_index]:
                min_index = j
        
        data[i], data[min_index] = data[min_index], data[i]
        print(f"Hasil setelah siklus ke-{i+1}: {data}")

angka = [64, 25, 12, 22, 11]
print("Sebelum sorting:", angka)
selection_sort(angka)
print("Setelah sorting:", angka)
</pre>
                </div>
            </div>
            
            <hr class="my-4">

            <h5 class="fw-bold">Penjelasan Per Blok</h5>

            <div class="mb-4">
                <h6 class="fw-semibold">1. Deklarasi Fungsi dan Menghitung Panjang Data</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>def selection_sort(data):</span>
<span>    n = len(data)</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Baris ini mendefinisikan fungsi bernama <code>selection_sort</code> yang menerima satu parameter berupa <code>data</code> (list angka yang akan diurutkan). Variabel <code>n</code> digunakan untuk menghitung dan menyimpan total panjang atau jumlah elemen dari data tersebut agar mempermudah penentuan batas iterasi.
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">2. Perulangan Utama (Outer Loop) dan Asumsi Minimum</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>for i in range(n-1):</span>
<span>    min_index = i</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Perulangan luar berjalan sebanyak <code>n-1</code> kali. Kita tidak perlu memeriksa elemen paling akhir karena secara otomatis elemen tersebut akan menjadi yang terbesar (atau tersisa) di akhir proses. Pada awal setiap iterasi, elemen di indeks <code>i</code> diasumsikan sementara sebagai elemen dengan nilai paling kecil (<code>min_index</code>).
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">3. Perulangan Dalam (Inner Loop) untuk Pencarian Minimum</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>for j in range(i+1, n):</span>
<span>    if data[j] < data[min_index]:</span>
<span>        min_index = j</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Perulangan dalam bertugas menelusuri seluruh sisa data di sebelah kanan, mulai dari indeks <code>i+1</code> hingga selesai. Jika program menemukan elemen <code>data[j]</code> yang nilainya ternyata lebih kecil dari nilai minimum saat ini (<code>data[min_index]</code>), maka posisi <code>min_index</code> akan diperbarui ke indeks <code>j</code> tersebut.
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">4. Proses Pertukaran (Swap)</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>data[i], data[min_index] = data[min_index], data[i]</span>
<span>print(f"Hasil setelah siklus ke-{i+1}: {data}")</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Setelah perulangan dalam selesai memeriksa seluruh sisa elemen, <code>min_index</code> kini pasti menyimpan indeks dari elemen terkecil yang sebenarnya. Elemen terkecil tersebut kemudian ditukar posisinya dengan elemen di indeks <code>i</code>. Dengan cara ini (hanya 1 kali swap per siklus), satu elemen terkecil akan selalu dikunci di bagian kiri list.
                </p>
            </div>
            <div class="refleksi-alert mt-4">
                <h5 class="fw-bold mb-3">
                    Refleksi Konseptual
                </h5>

                <p class="mb-3">
                    Sebelum melanjutkan ke bagian aktivitas, pastikan Anda memahami hal berikut:
                </p>

                <ul class="mb-0">
                    <li class="mb-3">
                        <strong>Mengapa <code>min_index</code> di-reset menjadi <code>i</code> setiap iterasi luar?</strong><br>
                        Karena elemen di posisi 0 hingga <code>i-1</code> sudah dipastikan terurut. Oleh karena itu, kita hanya perlu mencari nilai minimum pada "sisa" data yang belum terurut, yang dimulai dari posisi <code>i</code>.
                    </li>

                    <li class="mb-3">
                        <strong>Kapan pertukaran (swap) dilakukan pada Selection Sort?</strong><br>
                        Berbeda dengan Bubble Sort yang melakukan swap terus-menerus, Selection Sort <strong>hanya melakukan satu kali swap</strong> di akhir setiap iterasi luar (setelah nilai minimum benar-benar ditemukan di seluruh sisa data).
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="card mb-4 materi-box mt-4" id="fillCodeActivity">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fas fa-keyboard"></i>
                <span class="materi-badge">Aktivitas 3.1: Melengkapi Kode Program</span>
            </div>
            
            <p class="card-text mb-4 text-danger fw-bold">
                <i class="fa-solid fa-lock me-1"></i> Sebelum lanjut, lengkapi bagian kode yang kosong di bawah ini dengan benar untuk membuka akses ke Quiz!
            </p>

            <div class="code-container" style="background: #1e1e1e; padding: 20px; border-radius: 8px; color: #d4d4d4; font-family: 'Courier New', monospace; font-size: 14px; line-height: 2;">
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">selection_sort</span>(data):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;n = <span style="color: #dcdcaa;">len</span>(data)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> i <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(n - <span style="color: #b5cea8;">1</span>):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;min_idx = <input type="text" id="s_blank1" class="code-input" placeholder="..." style="width: 40px; text-align: center;"> <span style="color: #6a9955;"># Asumsikan elemen pertama di sisa data adalah minimum</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> j <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(i + <span style="color: #b5cea8;">1</span>, n):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> data[j] <input type="text" id="s_blank2" class="code-input" placeholder="..." style="width: 40px; text-align: center;"> data[min_idx]: <span style="color: #6a9955;"># Cek elemen untuk Ascending</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;min_idx = j<br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #6a9955;"># Proses Pertukaran</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;temp = data[i]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[i] = data[min_idx]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[min_idx] = <input type="text" id="s_blank3" class="code-input" placeholder="..." style="width: 80px;"> <span style="color: #6a9955;"># Selesaikan logika swap</span><br>
            </div>

            <div id="fillCodeFeedback" class="alert d-none mt-3"></div>
            <div class="text-start mt-3">
                <button id="btnCheckCode" class="btn btn-primary">
                    <i class="fa-solid fa-check-double me-1"></i> Periksa Kode
                </button>
            </div>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-body materi-text">
            <p>Cobalah jalankan kode Selection Sort di bawah ini untuk melihat bagaimana Python memproses datanya.</p>
          
            <div class="live-editor">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
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

    <a href="{{ route('mahasiswa.aktivitas.show',['selection','simulasi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['selection','quiz']) }}" 
       class="btn btn-success disabled" id="btnNextSelection" tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;">
        <i class="fa-solid fa-lock me-1" id="lockIconSelection"></i> Lanjut Quiz
    </a>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCheckCode = document.getElementById('btnCheckCode');
    const feedbackCode = document.getElementById('fillCodeFeedback');
    const btnNext = document.getElementById('btnNextSelection');
    const lockIcon = document.getElementById('lockIconSelection');

    btnCheckCode.addEventListener('click', function() {
        const b1 = document.getElementById('s_blank1').value.trim(); // Jawaban: i
        const b2 = document.getElementById('s_blank2').value.trim(); // Jawaban: <
        const b3 = document.getElementById('s_blank3').value.trim(); // Jawaban: temp

        let correctCount = 0;

        if (b1 === 'i') {
            document.getElementById('s_blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('s_blank1').className = 'code-input wrong';
        }

        if (b2 === '<') {
            document.getElementById('s_blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('s_blank2').className = 'code-input wrong';
        }

        if (b3 === 'temp') {
            document.getElementById('s_blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('s_blank3').className = 'code-input wrong';
        }

        if (correctCount === 3) {
            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Selection Sort Anda sudah tepat. Tombol Lanjut Quiz telah dibuka. Silakan coba kode tersebut pada Live Editor!';
            feedbackCode.classList.remove('d-none');
            
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';          
            lockIcon.className = 'fa-solid fa-unlock me-1';
        } else {
            feedbackCode.className = 'alert alert-danger mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> <strong>Kurang Tepat!</strong> Ada bagian kode yang salah (kotak merah). Ingat, kita perlu mencari nilai terkecil (Ascending).';
            feedbackCode.classList.remove('d-none');
        }
    });
});
</script>

<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection