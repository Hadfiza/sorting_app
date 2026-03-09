@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/insertion.css') }}">
@endsection

@section('content')

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
</style>

<!-- ===== Judul Materi dengan Box ===== -->
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

<!-- ===== Program ===== -->
<div class="materi-page">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program InsertionSort</span>
            </div>

            <div class="text-center my-4">
                <img 
                    src="{{ asset('images/insertion/insertion.png') }}" 
                    alt="Code BubbleSort"
                    class="img-fluid"
                    style="max-width: 700px;"
                >
            </div>
            <p>Penjelasan:</p>
            <ul>
                <li>
                    Baris <code>def insertion_sort(data)</code> : Menyatakan bahwa program mendefinisikan sebuah fungsi bernama <code>insertion_sort</code> yang menerima satu parameter berupa list angka yang akan diurutkan.
                </li>
                <li>
                    Baris <code>n = len(data)</code> : Digunakan untuk menghitung panjang data dan menyimpan jumlah elemen pada list ke dalam variabel <code>n</code>, sehingga dapat digunakan dalam proses perulangan.
                </li>
                <li>
                    Baris <code>for i in range(1, n)</code> : Merupakan perulangan utama yang mengatur proses pengurutan dimulai dari elemen kedua. Pada setiap iterasi, elemen ke-<code>i</code> akan disisipkan ke posisi yang benar pada bagian list sebelah kiri yang sudah terurut.
                </li>
                <li>
                    Baris <code>key = data[i]</code> : Digunakan untuk menyimpan elemen yang sedang diproses dan akan dibandingkan serta disisipkan ke posisi yang sesuai. Elemen ini disebut sebagai <em>key</em>.
                </li>
                <li>
                    Baris <code>j = i - 1</code> : Menyimpan indeks elemen sebelumnya (sebelah kiri <code>key</code>) yang akan digunakan untuk membandingkan dan menentukan posisi penyisipan.
                </li>
                <li>
                    Baris <code>while j &gt;= 0 and data[j] &gt; key</code>, <code>data[j + 1] = data[j]</code>, dan <code>j -= 1</code> : Merupakan proses pergeseran elemen. Selama elemen di sebelah kiri lebih besar dari <code>key</code>, elemen tersebut akan digeser satu posisi ke kanan hingga ditemukan posisi yang tepat.
                </li>
                <li>
                    Baris <code>data[j + 1] = key</code> : Digunakan untuk menyisipkan <code>key</code> ke posisi yang benar setelah semua elemen yang lebih besar digeser. Pada tahap ini, bagian kiri list kembali dalam keadaan terurut.
                </li>
                <li>
                    Baris <code>print(f"Hasil setelah langkah ke-{i}: {data}")</code> : Menampilkan kondisi list setelah setiap langkah penyisipan selesai, sehingga mahasiswa dapat mengamati proses pengurutan secara bertahap.
                </li>
                <li>
                    Pemanggilan fungsi & keluaran : Pada bagian akhir program, list awal didefinisikan (<code>angka = [4, 2, 5, 1, 3]</code>), kemudian fungsi <code>insertion_sort(angka)</code> dipanggil untuk menampilkan kondisi data sebelum dan sesudah proses pengurutan.
                </li>
            </ul>

        </div>
    </div>



    <div class="card mb-4">
        <div class="card-body materi-text">
            <p>Cobalah jalankan kode Bubble Sort di bawah ini untuk melihat bagaimana Python memproses datanya.</p>
          
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
       class="btn btn-primary">
        Lanjut Quiz
    </a>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/aset/nama') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>
{{-- <script src="{{ asset('js/insertionsort.js') }}"></script> --}}

@endsection