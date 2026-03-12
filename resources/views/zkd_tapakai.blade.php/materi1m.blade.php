@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/merge.css') }}">
@endsection


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

@section('content')

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

<!-- ===== Tujuan Pembelajaran ===== -->
<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tujuan Pembelajaran</h5> 
            <p>Setelah menyelesaikan materi pada bab ini, mahasiswa diharapkan mampu:</p>
            <ul>
                <li>menjelaskan prinsip Divide, Conquer, and Combine pada proses pengurutan data berbasis rekursif.</li>
                <li>mensimulasikan tahap pembagian (split) dan penggabungan (merge) data secara sistematis.  </li>
                <li>merancang algoritma Merge Sort kedalam bahasa pemrograman. </li>
            </ul>
        </div>
    </div>


<!-- ===== SORTING ===== -->
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">

            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">MergeSort</span>
            </div>
            <p class="card-text text-justify">
                Merge Sort adalah algoritma pengurutan berbasis strategi Divide and Conquer (membagi dan menaklukkan) yang dirancang untuk meningkatkan efisiensi algoritma pengurutan sederhana seperti Bubble Sort, Selection Sort, dan Insertion Sort. Algoritma ini bekerja dengan cara memecah daftar data menjadi dua bagian yang lebih kecil, kemudian mengurutkan masing-masing bagian secara rekursif, dan akhirnya menggabungkannya kembali (merge) menjadi satu daftar baru yang terurut.</br></br>

                Pada tahap awal, jika sebuah daftar kosong atau hanya memiliki satu elemen, daftar tersebut dianggap sudah berada dalam keadaan terurut. Namun, jika jumlah elemennya lebih dari satu, daftar akan dipecah menjadi dua sublist. Kedua sublist tersebut kemudian diurutkan kembali menggunakan prosedur yang sama secara rekursif. Setelah kedua sublist berada dalam kondisi terurut, dilakukan proses penggabungan, yaitu menggabungkan dua daftar terurut tersebut menjadi satu urutan baru yang terurut sepenuhnya. <br> <br>

                Secara umum, proses Merge Sort terdiri dari tiga langkah utama:
                <ol>
                    <li>Divide (Membagi): daftar dibagi menjadi dua sublist berukuran lebih kecil.</li>
                    <li>Conquer (Menaklukkan): masing-masing sublist diurutkan menggunakan metode yang sama secara rekursif.</li>
                    <li>Combine (Menggabungkan): dua sublist yang sudah terurut digabungkan menjadi satu daftar baru yang terurut.</li>
                </ol>
            
                Disebut Merge Sort karena operasi utamanya adalah proses penggabungan dua sublist terurut menjadi satu urutan yang juga terurut. Dengan pendekatan divide and conquer ini, Merge Sort termasuk algoritma pengurutan yang stabil, rekursif, dan sangat efisien, dengan kompleksitas waktu rata-rata dan terburuk O(n log n). Namun, algoritma ini memerlukan memori tambahan untuk menyimpan hasil penggabungan, sehingga lebih boros ruang dibandingkan algoritma in-place seperti Quick Sort.
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
                Algoritma Merge Sort bekerja dengan membagi daftar data menjadi dua bagian yang lebih kecil, mengurutkan masing-masing bagian tersebut, lalu menggabungkannya kembali menjadi satu daftar yang terurut. Proses ini menggunakan pendekatan rekursif, di mana fungsi memanggil dirinya sendiri untuk menangani sublist yang lebih kecil. <br><br> Tahapan prosesnya adalah sebagai berikut:
            </p>
            <ul class="card-text">
                <li>Membagi (Divide): daftar data dibagi menjadi dua bagian dengan ukuran hampir sama.</li>
                <li>Mengurutkan (Sort): setiap bagian diurutkan kembali menggunakan Merge Sort secara rekursif hingga hanya tersisa satu elemen di tiap sublist.</li>
                <li>Menggabungkan (Merge): dua sublist yang sudah terurut digabungkan menjadi satu daftar baru dengan membandingkan elemen-elemen terkecil dari masing-masing sublist, lalu menyusunnya ke dalam urutan yang benar.</li>
            </ul>
            <p class="card-text text-justify">
                Langkah-langkah di atas akan terus berulang sampai seluruh data tergabung kembali menjadi satu daftar lengkap yang sudah terurut sempurna. Dengan cara ini, Merge Sort dapat mengurutkan data secara efisien karena proses pengurutan dilakukan selama proses penggabungan (merging), bukan setelahnya.
            </p>
        </div>
    </div>
</div>

<!-- ===== Ilustrasi ===== -->
<div class="materi-page d-none">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code-branch"></i>
                <span class="materi-badge">Simulasi Merge Sort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi kasus : </strong>Di sebuah gudang logistik, terdapat 5 karung beras dengan berat yang berbeda-beda, yaitu 8 kg, 3 kg, 9 kg, 4 kg, dan 6 kg. Karung-karung tersebut masih tersusun secara acak sehingga menyulitkan proses penyimpanan dan distribusi. Agar proses pengelolaan menjadi lebih efisien, karung beras perlu diurutkan dari berat terkecil hingga terbesar menggunakan algoritma Merge Sort.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Selesai!</h4>
                        <p>Seluruh data telah digabungkan dan terurut.</p>
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
    <a href="{{ route('mahasiswa.merge.materi-merge') }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.merge.program-merge') }}" 
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
window.IMG_PATH = "{{ asset('images/aset/karung') }}/";
</script>
<script src="{{ asset('js/mergesort.js') }}"></script>


@endsection
