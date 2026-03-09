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
</style>

<!-- ===== Judul Materi dengan Box ===== -->
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

<!-- ===== Program ===== -->
<div class="materi-page">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program MergeSort</span>
            </div>

            <div class="text-center my-4">
                <img 
                    src="{{ asset('images/merge/merge.png') }}" 
                    alt="Code BubbleSort"
                    class="img-fluid"
                    style="max-width: 700px;"
                >
            </div>
            <p>Penjelasan:</p>
            <ul>
                <li>
                    Baris <code>def merge_sort(data)</code> : Menyatakan bahwa program mendefinisikan sebuah fungsi bernama <code>merge_sort</code> yang menerima satu parameter berupa list angka yang akan diurutkan.
                </li>
                <li>
                    Baris <code>if len(data) &gt; 1</code> : Digunakan untuk mengecek apakah data masih bisa dipecah. Jika panjang list lebih dari satu, maka proses pemecahan (divide) dapat dilakukan. Jika hanya satu elemen, list dianggap sudah terurut.
                </li>
                <li>
                    Baris <code>tengah = len(data) // 2</code> : Menentukan titik tengah dari list sebagai acuan untuk memisahkan data menjadi dua bagian.
                </li>
                <li>
                    Baris <code>bagian_kiri = data[:tengah]</code> dan <code>bagian_kanan = data[tengah:]</code> : Memecah list menjadi dua sublist, yaitu bagian kiri berisi elemen dari awal hingga sebelum titik tengah, dan bagian kanan berisi elemen dari titik tengah hingga akhir. Kedua bagian ini akan diurutkan secara terpisah.
                </li>
                <li>
                    Baris <code>i = j = k = 0</code> : Menginisialisasi tiga indeks, yaitu <code>i</code> untuk menelusuri bagian kiri, <code>j</code> untuk menelusuri bagian kanan, dan <code>k</code> untuk menuliskan kembali hasil penggabungan ke dalam list utama.
                </li>
                <li>
                    Baris <code>while i &lt; len(bagian_kiri) and j &lt; len(bagian_kanan)</code> : Melakukan proses penggabungan (merge) antara dua list yang telah terurut dengan cara membandingkan elemen terdepan dari masing-masing sublist.
                </li>
                <li>
                    Bagian logika <code>if bagian_kiri[i] &lt; bagian_kanan[j]</code> dan <code>else</code> : 
                    Jika elemen pada bagian kiri lebih kecil, maka elemen tersebut dimasukkan ke list utama terlebih dahulu. Jika elemen pada bagian kanan lebih kecil, maka elemen itulah yang dimasukkan lebih dulu. Indeks yang digunakan serta posisi penulisan akan bertambah satu langkah. Proses ini memastikan data tetap terurut saat digabungkan.
                </li>
                <li>
                    Baris <code>while i &lt; len(bagian_kiri)</code> : Jika masih terdapat elemen yang tersisa di bagian kiri, maka seluruh elemen tersebut langsung disalin ke dalam list utama.
                </li>
                <li>
                    Baris <code>while j &lt; len(bagian_kanan)</code> : Jika masih terdapat elemen yang tersisa di bagian kanan, maka elemen-elemen tersebut disalin ke dalam list utama.
                </li>
                <li>
                    Baris <code>print(f"Hasil sementara: {data}")</code> : Digunakan untuk menampilkan kondisi list setelah satu proses penggabungan selesai, sehingga proses kerja Merge Sort dapat diamati secara bertahap.
                </li>
                <li>
                    Pemanggilan fungsi dan keluaran : Pada bagian akhir program, list awal didefinisikan (<code>angka = [4, 2, 5, 1, 3]</code>), kemudian fungsi <code>merge_sort(angka)</code> dipanggil untuk menampilkan kondisi sebelum dan sesudah proses pengurutan.
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

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','simulasi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['merge','quiz']) }}" 
       class="btn btn-primary">
        Lanjut Quiz
    </a>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/aset/karung') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection