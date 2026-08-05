@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/selection.css') }}">
@endsection

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


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
                <h3 class="mb-0">Algoritma SelectionSort</h3>
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
                <li>mensimulasikan proses pencarian nilai pada algoritma selection sort. </li>
                <li>menganalisis hasil proses pengurutan data menggunakan algoritma Selection Sort. </li>
                <li>menyusun algoritma Selection Sort ke dalam bahasa pemrograman python. </li>
            </ul>
        </div>
    </div>

<!-- ===== Selection ===== -->
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">

            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">SelectionSort</span>
            </div>
            <p class="card-text text-justify">
                Selection Sort adalah algoritma pengurutan yang bekerja dengan cara memilih nilai tertentu dari bagian data yang belum terurut, kemudian menempatkannya pada posisi yang sesuai. Cara kerja algoritma ini mirip dengan kebiasaan manusia saat mengurutkan daftar buku atau nilai: kita mencari nilai terkecil terlebih dahulu, lalu meletakkannya di posisi paling awal. Setelah itu, kita kembali mencari nilai terkecil berikutnya dari sisa data, dan menempatkannya di posisi kedua, dan begitu seterusnya hingga seluruh data berada pada urutan yang benar. <br><br>
                Algoritma ini dinamakan Selection Sort karena setiap iterasi melakukan proses seleksi nilai minimum (untuk ascending) atau seleksi nilai maksimum (untuk descending). Tidak seperti Bubble Sort yang melakukan banyak pertukaran selama iterasi, Selection Sort hanya melakukan satu kali pertukaran pada setiap siklus, yaitu ketika nilai terkecil ditemukan dan diletakkan pada posisinya. Karena itulah jumlah pertukaran dalam Selection Sort relatif sedikit, yakni hanya sebanyak n − 1 swap untuk n data. Meskipun lebih hemat pertukaran dibanding Bubble Sort, Selection Sort tetap melakukan proses pencarian minimum pada setiap iterasi, sehingga memerlukan waktu komputasi yang cukup besar. Kompleksitas waktu algoritma ini adalah O(n²) karena harus membandingkan nilai-nilai pada setiap posisi secara berulang.

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
</div>


<!-- ===== Ilustrasi ===== -->
<div class="materi-page d-none">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-play-circle"></i>
                <span class="materi-badge">Simulasi SelectionSort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi kasus : </strong>Di sebuah gudang penyimpanan, terdapat beberapa kaleng makanan dengan tanggal kedaluwarsa (EXP) yang berbeda-beda. Kaleng-kaleng tersebut masih tersusun secara acak sehingga berisiko menyebabkan kaleng dengan tanggal kedaluwarsa lebih dekat terlewat saat distribusi. Oleh karena itu, diperlukan proses pengurutan kaleng makanan berdasarkan tanggal EXP paling awal hingga paling akhir. Untuk menyelesaikan permasalahan ini, digunakan algoritma Selection Sort, yang bekerja dengan cara memilih data dengan nilai terkecil pada setiap iterasi lalu menempatkannya di posisi yang sesuai.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Selesai!</h4>
                        <p>Data sudah terurut sempurna menggunakan Selection Sort.</p>
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
                <span class="materi-badge">Program SelectionSort</span>
            </div>

            <div class="text-center my-4">
                <img 
                    src="{{ asset('images/selection/selection.png') }}" 
                    alt="Code BubbleSort"
                    class="img-fluid"
                    style="max-width: 700px;"
                >
            </div>
            <p>Penjelasan:</p>
            <ul>
                <li>
                    Baris <code>def selection_sort(data)</code> : Menyatakan bahwa program mendefinisikan sebuah fungsi bernama <code>selection_sort</code> yang menerima satu parameter berupa list data yang akan diurutkan.
                </li>
                <li>
                    Baris <code>n = len(data)</code> : Digunakan untuk menghitung panjang data dengan mengambil jumlah elemen dalam list, sehingga dapat menentukan berapa kali proses seleksi dilakukan.
                </li>
                <li>
                    Baris <code>for i in range(n-1)</code> : Merupakan perulangan utama yang menjalankan proses seleksi sebanyak <code>n-1</code> kali, karena elemen terakhir secara otomatis akan berada pada posisi yang benar.
                </li>
                <li>
                    Baris <code>min_index = i</code> : Digunakan untuk menentukan indeks awal elemen minimum dengan menganggap elemen pertama pada bagian list yang belum terurut sebagai nilai terkecil sementara.
                </li>
                <li>
                    Baris <code>for j in range(i+1, n)</code> : Digunakan untuk menelusuri sisa elemen pada list yang belum terurut guna mencari elemen dengan nilai paling kecil. Proses perbandingan dilakukan dari indeks setelah <code>i</code> hingga akhir list.
                </li>
                <li>
                    Baris <code>if data[j] &lt; data[min_index]: min_index = j</code> : Digunakan untuk memperbarui posisi elemen minimum apabila ditemukan nilai yang lebih kecil dari nilai minimum sebelumnya. Dengan demikian, algoritma selalu mengetahui posisi nilai terkecil pada setiap siklus.
                </li>
                <li>
                    Baris <code>data[i], data[min_index] = data[min_index], data[i]</code> : Digunakan untuk melakukan pertukaran antara elemen terkecil yang ditemukan dengan elemen pada posisi <code>i</code>. Proses ini memindahkan elemen terkecil ke bagian kiri list secara bertahap dan merupakan inti dari algoritma Selection Sort.
                </li>
                <li>
                    Baris <code>print(f"Hasil setelah siklus ke-{i+1}: {data}")</code> : Digunakan untuk menampilkan kondisi list setelah satu siklus pencarian elemen minimum selesai, sehingga proses pengurutan dapat diamati secara bertahap.
                </li>
                <li>
                    <strong>Pemanggilan fungsi & keluaran</strong> : Pada bagian akhir program, list awal didefinisikan (<code>angka = [4, 2, 5, 1, 3]</code>), kemudian fungsi <code>selection_sort(angka)</code> dipanggil untuk menjalankan proses pengurutan dan menampilkan hasil sebelum serta sesudah sorting.
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

<div class="d-flex justify-content-center gap-3 mt-4">

    <button id="btnPrev"
            class="btn btn-outline-secondary"
            onclick="prevMateri()">
        ← Sebelumnya
    </button>

    <button id="btnNext"
            class="btn btn-primary"
            onclick="nextMateri()">
        Selanjutnya →
    </button>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/aset/kaleng') }}/";
</script>
<script src="{{ asset('js/selectionsort.js') }}"></script>

@endsection
