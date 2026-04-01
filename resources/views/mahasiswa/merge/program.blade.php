@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/merge.css') }}">
@endsection

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

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

/* Tambahan CSS Khusus untuk Tab Pills agar lebih estetik */
.nav-pills .nav-link {
    color: #495057;
    background-color: transparent;
    transition: all 0.3s ease;
}
.nav-pills .nav-link:hover {
    background-color: #e9ecef;
}
.nav-pills .nav-link.active {
    background-color: #0d6efd;
    color: white;
    box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
}
</style>

<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma MergeSort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program MergeSort</span>
            </div>


            <ul class="nav nav-pills nav-fill gap-2 p-1 bg-light rounded-pill border shadow-sm" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill fw-bold" id="pills-list-tab" data-bs-toggle="pill" data-bs-target="#pills-list" type="button" role="tab" aria-controls="pills-list" aria-selected="true">
                        <i class="bi bi-1-circle me-1"></i> 1. Contoh List Angka
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill fw-bold" id="pills-dict-tab" data-bs-toggle="pill" data-bs-target="#pills-dict" type="button" role="tab" aria-controls="pills-dict" aria-selected="false">
                        <i class="bi bi-2-circle me-1"></i> 2. Contoh List of Dictionary
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="card-body materi-text pt-2">
                
            <div class="tab-content" id="pills-tabContent">
                
                <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">

                <div class="my-4 text-start">
                    <div class="alert alert-warning mb-3">
                        <strong>Instruksi:</strong> Amati kode berikut dengan saksama,
                        kemudian ketik ulang pada fitur <em>Live Coding</em> di bawah tanpa melakukan copy–paste.
                    </div>

                    <div class="code-container">
<pre class="code-box">
def merge_sort(data):
    if len(data) > 1:
        tengah = len(data) // 2
        bagian_kiri = data[:tengah]
        bagian_kanan = data[tengah:]

        # Rekursi
        merge_sort(bagian_kiri)
        merge_sort(bagian_kanan)

        i = j = k = 0

        # Proses Penggabungan (Merge)
        while i < len(bagian_kiri) and j < len(bagian_kanan):
            if bagian_kiri[i] < bagian_kanan[j]:
                data[k] = bagian_kiri[i]
                i += 1
            else:
                data[k] = bagian_kanan[j]
                j += 1
            k += 1

        # Memasukkan sisa elemen kiri
        while i < len(bagian_kiri):
            data[k] = bagian_kiri[i]
            i += 1
            k += 1

        # Memasukkan sisa elemen kanan
        while j < len(bagian_kanan):
            data[k] = bagian_kanan[j]
            j += 1
            k += 1
        
        print(f"Hasil sementara: {data}")

angka = [38, 27, 43, 3, 9, 82, 10]
print("Sebelum sorting:", angka)
merge_sort(angka)
print("Setelah sorting:", angka)
</pre>
                </div>
            </div>
            
            <hr class="my-4">

            <h5 class="fw-bold">Penjelasan Per Blok</h5>

            <div class="mb-4">
                <h6 class="fw-semibold">1. Basis Rekursi (Kondisi Berhenti)</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>def merge_sort(data):</span>
<span>    if len(data) > 1:</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Baris ini mengecek apakah panjang <code>data</code> lebih dari satu elemen. Dalam konsep rekursi, ini disebut <em>base case</em>. Jika <code>data</code> hanya berisi 1 elemen (atau kosong), maka dianggap sudah terurut dan algoritma tidak akan melakukan pemecahan lagi.
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">2. Fase Divide (Membelah Data)</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>tengah = len(data) // 2</span>
<span>bagian_kiri = data[:tengah]</span>
<span>bagian_kanan = data[tengah:]</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Jika elemen lebih dari satu, sistem akan mencari titik tengah dari array menggunakan pembagian bulat (<code>// 2</code>). Kemudian, array asli dibelah menjadi dua sub-array: <code>bagian_kiri</code> (dari indeks 0 hingga sebelum titik tengah) dan <code>bagian_kanan</code> (dari titik tengah hingga akhir).
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">3. Pemanggilan Rekursif</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>merge_sort(bagian_kiri)</span>
<span>merge_sort(bagian_kanan)</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Fungsi <code>merge_sort</code> kemudian memanggil dirinya sendiri secara terus-menerus untuk masing-masing bagian (kiri dan kanan). Proses pembelahan ini akan terus terjadi hingga array terpecah menjadi kepingan terkecil (1 elemen).
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">4. Fase Conquer & Merge (Menggabungkan)</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>i = j = k = 0</span>
<span>while i < len(bagian_kiri) and j < len(bagian_kanan):</span>
<span>    if bagian_kiri[i] < bagian_kanan[j]:</span>
<span>        data[k] = bagian_kiri[i]</span>
<span>        i += 1</span>
<span>    else:</span>
<span>        data[k] = bagian_kanan[j]</span>
<span>        j += 1</span>
<span>    k += 1</span>
</code></pre>
                </div>
                <p class="mt-2">
                    Setelah terpecah, kepingan data tersebut digabungkan kembali sambil diurutkan. Variabel <code>i</code> digunakan untuk melacak indeks <code>bagian_kiri</code>, <code>j</code> untuk <code>bagian_kanan</code>, dan <code>k</code> untuk menulis ke dalam array asli (<code>data</code>). Jika elemen di bagian kiri lebih kecil, masukkan ke array hasil dan geser maju nilai <code>i</code>. Sebaliknya, masukkan elemen bagian kanan.
                </p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">5. Memasukkan Sisa Elemen</h6>
                <div class="code-container mt-2">
<pre class="code-box"><code>
<span>while i < len(bagian_kiri): ... </span>
<span>while j < len(bagian_kanan): ... </span>
</code></pre>
                </div>
                <p class="mt-2">
                    Terkadang salah satu bagian (kiri atau kanan) sudah habis dimasukkan ke dalam array hasil penggabungan, sementara bagian lainnya masih memiliki sisa. Kedua blok perulangan <code>while</code> di bagian akhir ini berfungsi untuk "menyapu bersih" dan memasukkan seluruh sisa elemen (jika ada) ke dalam array utama.
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
                        <strong>Mengapa Merge Sort disebut algoritma rekursif?</strong><br>
                        Karena fungsi <code>merge_sort</code> memanggil dirinya sendiri di dalam badannya sendiri untuk menyelesaikan sub-masalah (potongan array) yang lebih kecil.
                    </li>
                    <li class="mb-3">
                        <strong>Apa peran pembagian bulat <code>// 2</code>?</strong><br>
                        Pembagian bulat menghasilkan bilangan bulat utuh tanpa koma (desimal), yang mana sangat diperlukan karena indeks array tidak boleh menggunakan bilangan pecahan.
                    </li>
                </ul>

            </div></div>

            <div class="tab-pane fade" id="pills-dict" role="tabpanel" aria-labelledby="pills-dict-tab">
                    
                    <div class="my-4 text-start">
                        <div class="alert alert-info mb-3">
                            <strong>Perhatian:</strong> Di dunia nyata, data seringkali berbentuk kumpulan kamus (Dictionary). Perhatikan bagaimana algoritma dimodifikasi agar bisa mengurutkan data berdasarkan kunci (key) tertentu.
                    </div>

                    <div class="code-container">
<pre class="code-box">
def merge_sort_dict(arr, key="value"):
    if len(arr) > 1:
        mid = len(arr) // 2
        left_half = arr[:mid]
        right_half = arr[mid:]

        # Rekursif sorting
        merge_sort_dict(left_half, key)
        merge_sort_dict(right_half, key)

        i = j = k = 0

        # Merge proses
        while i < len(left_half) and j < len(right_half):
            if left_half[i][key] < right_half[j][key]:
                arr[k] = left_half[i]
                i += 1
            else:
                arr[k] = right_half[j]
                j += 1
            k += 1

        # Sisa elemen dari left half
        while i < len(left_half):
            arr[k] = left_half[i]
            i += 1
            k += 1

        # Sisa elemen di kanan
        while j < len(right_half):
            arr[k] = right_half[j]
            j += 1
            k += 1

# Contoh data
data = [
    {"value": 6},
    {"value": 5},
    {"value": 12},
    {"value": 10},
    {"value": 9},
    {"value": 1}
]

print("Sebelum diurutkan:", data)
merge_sort_dict(data)
print("Setelah diurutkan:", data)
</pre>
                    </div>

                    <h5 class="fw-bold mt-4">Penjelasan: Pemrosesan List of Dictionary pada Merge Sort</h5>
                    <p>Pada algoritma Merge Sort ini, kita tetap menerapkan prinsip dasar <em>Divide and Conquer</em> (membagi dan menaklukkan), namun kali ini diterapkan pada struktur data <strong>List of Dictionary</strong>. Berikut adalah poin-poin penting perbedaannya:</p>

                    <ul>
                        <li class="mb-2">
                            <strong>Penggunaan Parameter Opsional (<em>Default Parameter</em>):</strong><br>
                            Perhatikan baris deklarasi <code>def merge_sort_dict(arr, key="value"):</code>. Fungsi ini dirancang agar lebih dinamis. Secara bawaan (<em>default</em>), program akan mengurutkan data berdasarkan kunci (<em>key</em>) bernama <code>"value"</code>. Namun, Anda dapat dengan mudah menyesuaikannya saat pemanggilan fungsi jika data Anda memiliki atribut lain, misalnya <code>merge_sort_dict(data, "harga")</code>.
                        </li>
                        
                        <li class="mb-2">
                            <strong>Perbandingan Spesifik pada Proses Penggabungan (<em>Merge</em>):</strong><br>
                            Tahap paling krusial terjadi saat program menggabungkan kembali (<em>merge</em>) bagian kiri dan kanan yang telah dipecah. Pada baris <code>if left_half[i][key] &lt; right_half[j][key]:</code>, kita secara eksplisit menginstruksikan program untuk membandingkan nilai atribut tertentu yang ada di dalam <em>dictionary</em>, bukan membandingkan <em>dictionary</em> itu sendiri secara utuh.
                        </li>

                        <li>
                            <strong>Penempatan Kembali Kesatuan Data:</strong><br>
                            Meskipun pembandingan dilakukan hanya pada nilai atribut spesifik, saat program menyusun ulang data (contohnya pada baris <code>arr[k] = left_half[i]</code>), program memindahkan <strong>seluruh isi <em>dictionary</em></strong> ke posisi yang baru. Hal ini sangat penting agar seluruh kelengkapan informasi di dalam kamus data tersebut tidak terpisah atau saling tertukar.
                        </li>
                    </ul>

                    </div>
                    </div>

        </div></div></div>
    </div>

    <div class="card mb-4 materi-box mt-4" id="fillCodeActivity">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fas fa-keyboard"></i>
                <span class="materi-badge">Aktivitas 3.1: Melengkapi Kode Program</span>
            </div>
            
            <p class="card-text mb-4 text-danger fw-bold">
                <i class="fa-solid fa-lock me-1"></i> Sebelum lanjut, lengkapi bagian kode rekursi Merge Sort di bawah ini dengan benar untuk membuka akses ke Quiz!
            </p>

            <div class="code-container" style="background: #1e1e1e; padding: 20px; border-radius: 8px; color: #d4d4d4; font-family: 'Courier New', monospace; font-size: 14px; line-height: 2;">
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">merge_sort</span>(data):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> <span style="color: #dcdcaa;">len</span>(data) > <span style="color: #b5cea8;">1</span>:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tengah = <span style="color: #dcdcaa;">len</span>(data) <input type="text" id="m_blank1" class="code-input" placeholder="..." style="width: 40px; text-align: center;"> <span style="color: #b5cea8;">2</span> <span style="color: #6a9955;"># Pembagian bulat untuk mencari tengah</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bagian_kiri = data[:tengah]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bagian_kanan = data[tengah:]<br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;merge_sort(bagian_kiri)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;merge_sort(bagian_kanan)<br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i = j = k = <span style="color: #b5cea8;">0</span><br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">while</span> i < <span style="color: #dcdcaa;">len</span>(bagian_kiri) <span style="color: #c586c0;">and</span> j < <span style="color: #dcdcaa;">len</span>(bagian_kanan):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> bagian_kiri[i] <input type="text" id="m_blank2" class="code-input" placeholder="..." style="width: 40px; text-align: center;"> bagian_kanan[j]: <span style="color: #6a9955;"># Bandingkan elemen (Ascending)</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[k] = <input type="text" id="m_blank3" class="code-input" placeholder="..." style="width: 120px;"> <span style="color: #6a9955;"># Masukkan dari bagian kiri</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i += <span style="color: #b5cea8;">1</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">else</span>:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[k] = bagian_kanan[j]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;j += <span style="color: #b5cea8;">1</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;k += <span style="color: #b5cea8;">1</span><br>
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
            <p>Cobalah jalankan kode Bubble Sort di bawah ini untuk melihat bagaimana Python memproses datanya.</p>
          
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

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','simulasi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','quiz']) }}" 
       class="btn btn-success disabled" id="btnNextMerge" tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;">
        <i class="fa-solid fa-lock me-1" id="lockIconMerge"></i> Lanjut Quiz
    </a>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCheckCode = document.getElementById('btnCheckCode');
    const feedbackCode = document.getElementById('fillCodeFeedback');
    const btnNext = document.getElementById('btnNextMerge');
    const lockIcon = document.getElementById('lockIconMerge');

    btnCheckCode.addEventListener('click', function() {
        // Ambil nilai input
        const b1 = document.getElementById('m_blank1').value.trim(); // Jawaban: //
        const b2 = document.getElementById('m_blank2').value.trim(); // Jawaban: <
        const b3 = document.getElementById('m_blank3').value.trim(); // Jawaban: bagian_kiri[i]

        let correctCount = 0;

        // Validasi Blank 1 (Pembagian Bulat)
        if (b1 === '//') {
            document.getElementById('m_blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('m_blank1').className = 'code-input wrong';
        }

        // Validasi Blank 2 (Operator Perbandingan)
        if (b2 === '<') {
            document.getElementById('m_blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('m_blank2').className = 'code-input wrong';
        }

        // Validasi Blank 3 (Variabel Kiri)
        if (b3 === 'bagian_kiri[i]') {
            document.getElementById('m_blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('m_blank3').className = 'code-input wrong';
        }

        // Output Feedback
        if (correctCount === 3) {
            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika rekursif dan penggabungan Anda tepat. Tombol Lanjut Quiz telah dibuka. Silakan jalankan kode utuhnya pada Live Editor!';
            feedbackCode.classList.remove('d-none');
            
            // Buka gembok tombol Selanjutnya
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';          
            lockIcon.className = 'fa-solid fa-unlock me-1';
        } else {
            feedbackCode.className = 'alert alert-danger mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> <strong>Kurang Tepat!</strong> Terdapat kesalahan pada kotak merah. Perhatikan kembali operator matematika Python dan nama variabelnya.';
            feedbackCode.classList.remove('d-none');
        }
    });
});
</script>
<script>
window.IMG_PATH = "{{ asset('images/aset/karung') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection