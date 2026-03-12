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
/* CSS EDITOR PYTHON (Disesuaikan agar muat di dalam Card) */
    .app-wrapper {
        width: 100%;
        height: 500px;
        background: #1e1e1e;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }
    .editor-header { padding: 10px 20px; background: #2d2d2d; border-bottom: 1px solid #444; display: flex; justify-content: space-between; align-items: center; color: white; }
    .editor-header h1 { margin: 0; font-size: 1rem; }
    .split-container { display: flex; flex: 1; overflow: hidden; border-top: 1px solid #444; }

    .panel-right { flex: 4; display: flex; flex-direction: column; background: #101010; }
    .panel-label { background: #333; color: #ccc; padding: 5px 15px; font-size: 0.75rem; text-transform: uppercase; }
    .CodeMirror { flex-grow: 1; height: 100%; font-size: 14px; text-align: left; }
    #output { padding: 15px; color: #00ff00; font-family: 'Courier New', monospace; white-space: pre-wrap; overflow-y: auto; flex-grow: 1; font-size: 13px; text-align: left; }
    .btn-run { padding: 5px 15px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; }

    .panel-left { 
    flex: 6; 
    border-right: 1px solid #444; 
    display: flex; 
    flex-direction: column; 
    height: 100%; /* Pastikan tingginya penuh */
}



/* ===============================
   FILE CONTAINER
   =============================== */

.file-container {
    position: relative;
    height: 180px;
    margin-bottom: 25px;
}


/* ===============================
   FILE WRAP
   =============================== */

.file-wrap {
    position: absolute;
    width: 100px;
    transition: all 0.4s ease;
    text-align: center;
    z-index: 1; /* 🔥 jangan besar */
}

.file-wrap img {
    width: 100px;
    pointer-events: none; /* supaya gambar tidak menghalangi klik */
}

.file-label {
    display: block;
    margin-top: 8px;
    font-weight: 600;
    font-size: 0.9rem;
}


/* ===============================
   STATE VISUAL
   =============================== */

.file-wrap.is-sorted img {
    filter: drop-shadow(0 0 8px #2ecc71);
}

.file-wrap.comparing img {
    filter: drop-shadow(0 0 8px #f39c12);
}

.file-wrap.is-key img {
    filter: drop-shadow(0 0 10px #3498db);
}


/* ===============================
   BUTTON AREA
   =============================== */

.action-buttons {
    position: relative;
    z-index: 20; /* 🔥 lebih tinggi dari file-wrap */
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 15px;
}


/* ===============================
   BUTTON STYLE
   =============================== */

.btn-sim {
    padding: 10px 22px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
    background: #3498db;
    color: #fff;
}

.btn-sim:hover {
    transform: translateY(-2px);
}

.btn-yes {
    background: #27ae60;
}

.btn-no {
    background: #e74c3c;
}

.btn-swap {
    background: #f39c12;
}

.btn-disabled {
    opacity: 0.6;
    cursor: default;
}


/* ===============================
   FINISH MESSAGE
   =============================== */

#finish-message {
    margin-top: 20px;
    font-weight: bold;
    text-align: center;
} */



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

<!-- ===== Tujuan Pembelajaran ===== -->
<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tujuan Pembelajaran</h5> 
            <p>Setelah menyelesaikan materi pada bab ini, mahasiswa diharapkan mampu:</p>
            <ul>
                <li>mensimulasikan cara kerja Insertion Sort .  </li>
                <li>Menganalisis hasil proses pengurutan data menggunakan algoritma insertion Sort. </li>
                <li>membangun fungsi program Insertion Sort kedalam bahasa pemrograman. </li>
            </ul>
        </div>
    </div>


<!-- ===== SORTING ===== -->
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">

            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">InsertionSort</span>
            </div>
            <p class="card-text text-justify">
                Insertion Sort adalah algoritma pengurutan sederhana yang bekerja dengan cara menyisipkan elemen ke posisi yang tepat dalam kumpulan data yang sebagian telah terurut. Cara kerjanya mirip seperti seseorang menyusun kartu di tangan: setiap kartu baru dibandingkan dengan kartu-kartu sebelumnya, lalu ditempatkan pada posisi yang sesuai agar urutan tetap benar. Dalam prosesnya, Insertion Sort selalu menjaga agar bagian awal list berada dalam keadaan terurut, kemudian setiap item berikutnya disisipkan satu per satu ke posisi yang tepat di antara elemen-elemen yang sudah terurut tersebut.</br></br>

                Disebut Insertion karena proses utamanya adalah penyisipan elemen pada tempat yang benar. Meskipun memiliki kompleksitas waktu O(n²), algoritma ini bekerja dengan pendekatan yang berbeda dari Bubble Sort dan Selection Sort, yaitu dengan memastikan sebagian list sudah terurut pada setiap langkah. Pendekatan ini membuat Insertion Sort lebih efisien untuk data yang hampir terurut, karena hanya membutuhkan sedikit pergeseran elemen untuk mencapai urutan yang benar.
            </p>
        </div>
    </div>
</div>

<!-- ===== Prinsip Kerja ===== -->
<div class="materi-page d-none">
    <div class="card mb-4 materi-box" >
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
</div>


<!-- ===== Ilustrasi ===== -->
<div class="materi-page d-none">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play"></i>
                <span class="materi-badge">Simulasi Insertion Sort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi kasus : </strong>Dalam sebuah sistem pengelolaan arsip digital, terdapat beberapa data yang diberi label nama bulan, yaitu April, Juni, September, Mei, dan Oktober. Data tersebut belum tersusun secara alfabet, sehingga menyulitkan proses pencarian. Untuk mengatasi masalah ini, digunakan algoritma Insertion Sort, yang mengurutkan data dengan cara mengambil satu elemen sebagai key lalu menyisipkannya ke posisi yang tepat di bagian data yang sudah terurut.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Pengurutan Selesai!</h4>
                        <button class="btn btn-outline-success" onclick="resetSimulation()">Ulangi Simulasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== Program ===== -->
<div class="materi-page d-none">
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
          
            <div class="app-wrapper">
                <header class="editor-header">
                    <h1>Python Editor</h1>
                    <div>
                        {{-- <span id="status" style="font-size: 0.8rem; color: #aaa;">⏳ Loading Pyodide...</span> --}}
                        <button id="runBtn" class="btn-run" disabled>Run Code</button>
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
    <a href="{{ route('mahasiswa.insertion.materi-insertion') }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.insertion.simulasi-insertion') }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>
</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const materiPages = document.querySelectorAll('.materi-page');
    if (materiPages.length === 0) return; // ⛔ hanya jalan di halaman materi

    const submenuPages = document.querySelectorAll('.submenu-page');

    let materiIndex = 0;

    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');

    function updateSidebarActive(index) {
        submenuPages.forEach(link => {
            link.classList.toggle(
                'active-sub',
                Number(link.dataset.index) === index
            );
        });
    }

    function tampilMateri(i) {
        materiPages.forEach((page, idx) => {
            page.classList.toggle('d-none', idx !== i);
        });

        materiIndex = i;
        updateSidebarActive(i);   // 🔥 INI KUNCINYA
        updateButtonState();

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function updateButtonState() {
        if (btnPrev) btnPrev.disabled = materiIndex === 0;
        if (btnNext) btnNext.disabled = materiIndex === materiPages.length - 1;
    }

    window.goMateri = function(i){
        tampilMateri(i);
    }

    window.nextMateri = function(){
        if (materiIndex < materiPages.length - 1) {
            tampilMateri(materiIndex + 1);
        }
    }

    window.prevMateri = function(){
        if (materiIndex > 0) {
            tampilMateri(materiIndex - 1);
        }
    }

    // init
    tampilMateri(0);
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/aset/nama') }}/";
</script>
<script src="{{ asset('js/insertionsort.js') }}"></script>

@endsection
