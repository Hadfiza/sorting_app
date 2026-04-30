@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bubble.css') }}">
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


<style>
Container Ilustrasi agar rapi di tengah
/* Container Utama */
#simulation-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-top: 20px;
}

/* KARTU SIMULASI (Mirip Gambar Referensi) */
.sim-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    overflow: hidden;
    margin-bottom: 20px;
}

/* Bagian Penjelasan Text (Atas) */
.sim-header {
    padding: 20px 25px;
    background: #fafafa;
    border-bottom: 1px solid #eee;
    font-size: 1rem;
    line-height: 1.6;
    color: #444;
}

/* Bagian Visualisasi (Tengah) */
.sim-body {
    padding: 30px;
    text-align: center;
}

.iter-title {
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

/* Container Rak Buku/Kotak */
.book-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
}

.book-box {
    width: 60px;
    height: 60px; /* Atau auto jika pakai gambar buku */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1.2rem;
    transition: all 0.3s;
    background: #e3f2fd; /* Default Biru Muda */
    border: 2px solid #90caf9;
}

/* Jika Anda pakai gambar buku, sesuaikan class ini */
.book-img-wrap {
    padding: 5px;
    border-radius: 8px;
    transition: transform 0.3s;
}
.book-img-wrap.comparing {
    transform: scale(1.15);
    background: #fff3cd; /* Kuning highlight */
    border: 2px solid #ffc107;
    box-shadow: 0 0 10px rgba(255, 193, 7, 0.4);
}

/* BUTTONS GROUP */
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 15px;
}


/* Warna Tombol */
/* TOMBOL DASAR */
.btn-sim {
    padding: 10px 25px;
    border-radius: 6px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    color: white;
}

/* Tukar = Merah */
.btn-tukar {
    background-color: #e74c3c;
}
.btn-tukar:hover {
    background-color: #c0392b;
}

/* Tidak Ditukar = Biru */
.btn-stay {
    background-color: #3498db;
}
.btn-stay:hover {
    background-color: #2c80b4;
}


.btn-reset { background-color: #dc3545; color: #fff; }
.btn-reset:hover { background-color: #c82333; }

/* Status Text Bawah */
.status-text {
    font-size: 0.95rem;
    color: #555;
    margin-top: 10px;
}


    
    .editor-header { padding: 10px 20px; background: #2d2d2d; border-bottom: 1px solid #444; display: flex; justify-content: space-between; align-items: center; color: white; }
    .editor-header h1 { margin: 0; font-size: 1rem; }
    .split-container { display: flex; flex: 1; overflow: hidden; border-top: 1px solid #444; }

    .panel-right { flex: 4; display: flex; flex-direction: column; background: #101010; }
    .panel-label { background: #333; color: #ccc; padding: 5px 15px; font-size: 0.75rem; text-transform: uppercase; }
    .CodeMirror { flex: 1; min-height: 100%; font-size: 14px; text-align: left; }
    #output { padding: 15px; color: #00ff00; font-family: 'Courier New', monospace; white-space: pre-wrap; overflow-y: auto; flex-grow: 1; font-size: 13px; text-align: left; }
    .btn-run { padding: 5px 15px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; }

    .panel-left { 
    flex: 6; 
    border-right: 1px solid #444; 
    display: flex; 
    flex-direction: column; 
    height: 100%; /* Pastikan tingginya penuh */
}

#code {
    display: none;
}

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

.btn-active {
    background: #3498db;
    color: white;
    cursor: pointer;
    opacity: 1;
}

.btn-disabled {
    background: #bdc3c7;
    color: #ffffff;
    cursor: not-allowed;
    opacity: 0.6;
}

.code-container {
    background: #1e1e2f;
    border-radius: 16px;
    padding: 20px;
    overflow-x: auto;
}

.code-box {
    margin: 0;
    font-family: 'Courier New', monospace;
    font-size: 15px;
    line-height: 1.4;
    color: #f8f8f2;
    user-select: none;
}

.refleksi-alert {
    background: #eef3ff;          /* biru lembut */
    border: 1px solid #d6e2ff;
    padding: 20px 25px;
    border-radius: 12px;
}

.refleksi-alert h5 {
    color: #1f3c88;
}

.refleksi-alert ul {
    padding-left: 18px;
}

.refleksi-alert li {
    line-height: 1.6;
}



</style>

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

<div class="materi-page ">
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
</div>

<div class="materi-page d-none">
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
</div>

<div class="materi-page d-none"> 
    <div class="card mb-4">
        <div class="card-body materi-text">
            
            <div class="materi-header">
                <i class="fa-solid fa-cube"></i>
                <span class="materi-badge">Simulasi BubbleSort</span>
            </div>
            
            <div class="simulation-wrapper">
                <div class="sub-title"><strong>Studi Kasus:</strong> Di sebuah perpustakaan sekolah, buku-buku pelajaran disusun berdasarkan nomor edisi agar siswa dapat menemukan referensi yang dibutuhkan dengan cepat dan tepat. Namun, pada suatu rak, urutan nomor edisi buku masih belum tersusun dengan benar, sehingga pencarian buku menjadi kurang efisien. Oleh karena itu, diperlukan sebuah metode pengurutan yang sederhana dan sistematis untuk menyusun kembali buku-buku tersebut dari edisi terkecil hingga terbesar. Untuk memahami bagaimana proses pengurutan tersebut dilakukan, perhatikan simulasi interaktif yang disajikan di bawah ini agar setiap tahapan dapat diamati dan dipahami dengan lebih jelas.</div>
                
                <div id="simulation-container"></div>
                
                <div id="finish-message" style="display:none; margin-top:30px;" class="text-center">
                    <div class="alert alert-success">
                        <h4><i class="fa fa-check-circle"></i> Selesai!</h4>
                        <p>Data sudah terurut sempurna.</p>
                        <button class="btn btn-outline-success" onclick="resetSimulation()">Ulangi Simulasi</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="materi-page d-none">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program BubbleSort</span>
            </div>

            <div class="my-4 text-start">
                <div class="alert alert-warning mb-3">
                    <strong>Instruksi:</strong> Amati kode berikut dengan saksama,
                    kemudian ketik ulang pada fitur <em>Live Coding</em> di bawah tanpa melakukan copy–paste.
                </div>

<div class="code-container">
<pre class="code-box">
def bubblesort(list):
    for i in range(len(list)-1, 0, -1):
        for j in range(0, i, 1):
            if list[j] > list[j+1]:
                temp = list[j+1]
                list[j+1] = list[j]
                list[j] = temp
        print(f"Hasil setelah iterasi ke-{len(list)-i}: {list}")

angka = [4, 2, 5, 1, 3]
print("Sebelum sorting:", angka)
bubblesort(angka)
print("Setelah sorting:", angka)
</pre>
</div>

                

            </div>
            
            <p>Penjelasan:</p>
             <ul>
                <li>
                    Baris <code>def bubblesort(list)</code> : Menyatakan bahwa program mendefinisikan sebuah fungsi bernama <code>bubblesort</code> yang menerima satu parameter berupa list angka yang akan diurutkan.
                </li>
                <li>
                    Baris <code>for i in range(len(list)-1, 0, -1)</code> : Digunakan untuk mengatur jumlah iterasi pemeriksaan terhadap list. Setiap satu kali iterasi akan memindahkan satu elemen terbesar ke posisi yang benar pada bagian kanan list.
                </li>
                <li>
                    Baris <code>for j in range(0, i, 1)</code> : Digunakan untuk membandingkan elemen-elemen yang bersebelahan, yaitu <code>list[j]</code> dan <code>list[j+1]</code>. Proses perbandingan dilakukan dari indeks awal hingga sebelum batas <code>i</code>.
                </li>
                <li>
                    Baris logika pertukaran (<em>swap</em>) : Melakukan pertukaran elemen apabila elemen kiri lebih besar dibanding elemen kanan. Dengan cara ini, nilai yang lebih besar akan bergerak ke arah kanan list secara bertahap, seperti gelembung yang naik ke permukaan.
                </li>
                <li>
                    Baris <code>print(f"Hasil setelah iterasi ke-{len(list)-i}: {list}")</code> : Digunakan untuk menampilkan kondisi list setelah satu iterasi selesai dijalankan, sehingga proses pengurutan dapat diamati secara bertahap.
                </li>
                <li>
                    <strong>Pemanggilan fungsi & keluaran</strong> : Pada bagian akhir program, list awal didefinisikan (<code>angka = [4, 2, 5, 1, 3]</code>), kemudian fungsi <code>bubblesort(angka)</code> dipanggil untuk menjalankan proses pengurutan dan menampilkan hasil sebelum serta sesudah sorting.
                </li>
            </ul>

            <hr class="my-4">

<h5 class="fw-bold">Penjelasan Per Blok</h5>

<!-- BLOK 1 -->
<div class="mb-4">
    <h6 class="fw-semibold">1. Deklarasi Fungsi</h6>

    <div class="code-container mt-2">
<pre class="code-box"><code>
<span>def bubblesort(list):</span>
</code></pre>
    </div>

    <p class="mt-2">
        Baris ini mendefinisikan sebuah fungsi bernama <code>bubblesort</code> yang menerima satu parameter berupa struktur data list. Dalam konteks pemrograman Python, fungsi digunakan untuk mengelompokkan sekumpulan instruksi agar dapat digunakan kembali dan mempermudah pengelolaan logika program.<br>
        Pada algoritma ini, parameter list merepresentasikan kumpulan data numerik yang akan diurutkan. Proses pengurutan dilakukan secara in-place, artinya perubahan terjadi langsung pada struktur data asli tanpa membuat salinan baru.
    </p>
</div>


<!-- BLOK 2 -->
<div class="mb-4">
    <h6 class="fw-semibold">2. Perulangan Luar (Outer Loop)</h6>

    <div class="code-container mt-2">
<pre class="code-box"><code>
<span>for i in range(len(list)-1, 0, -1):</span>
</code></pre>
    </div>

    <p class="mt-2">
        Perulangan luar berfungsi untuk mengatur jumlah iterasi proses pengurutan. Struktur <code>range(len(list)-1, 0, -1)</code> menunjukkan bahwa iterasi dimulai dari indeks terakhir dan bergerak mundur hingga indeks pertama.
        <br>
        Secara algoritmik, setiap satu kali iterasi perulangan luar akan memastikan bahwa satu elemen terbesar telah berpindah ke posisi akhir yang benar. Dengan demikian, jumlah elemen yang perlu diperiksa pada iterasi berikutnya akan berkurang.
    </p>
</div>


<!-- BLOK 3 -->
<div class="mb-4">
    <h6 class="fw-semibold">3. Perulangan Dalam (Inner Loop)</h6>

    <div class="code-container mt-2">
<pre class="code-box"><code>
<span>for j in range(0, i, 1):</span>
</code></pre>
    </div>

    <p class="mt-2">
        Perulangan dalam bertugas melakukan proses inti pengurutan, yaitu membandingkan elemen yang bersebelahan dalam list.
        <br>
        Batas atas perulangan ditentukan oleh variabel <code>i</code>, bukan oleh panjang penuh list. Hal ini menunjukkan bahwa sebagian elemen di bagian akhir sudah berada pada posisi yang benar dan tidak perlu diperiksa kembali. 
    </p>
</div>


<!-- BLOK 4 -->
<div class="mb-4">
    <h6 class="fw-semibold">4. Proses Pertukaran (Swap)</h6>

    <div class="code-container mt-2">
<pre class="code-box"><code>
<span>if list[j] &gt; list[j+1]:</span>
<span>    temp = list[j+1]</span>
<span>    list[j+1] = list[j]</span>
<span>    list[j] = temp</span>
</code></pre>
    </div>

    <p class="mt-2">
        Blok ini merupakan inti dari algoritma Bubble Sort. Kondisi <code>if list[j] > list[j+1]</code> digunakan untuk menentukan apakah dua elemen yang bersebelahan berada dalam urutan yang salah.
        <br>
        Jika kondisi terpenuhi, maka dilakukan proses pertukaran menggunakan variabel sementara <code>(temp)</code>. Variabel ini diperlukan untuk mencegah kehilangan nilai saat proses pemindahan dilakukan.
        <br>
        Secara logis, mekanisme ini menyebabkan elemen dengan nilai lebih besar bergerak ke arah kanan secara bertahap, menyerupai gelembung yang naik ke permukaan air.
    </p>
</div>

            <div class="refleksi-alert mt-4">
    <h5 class="fw-bold mb-3">
        Refleksi Konseptual
    </h5>

    <p class="mb-3">
        Sebelum melanjutkan ke fitur <em>Live Coding</em>, pastikan Anda memahami hal berikut:
    </p>

    <ul class="mb-0">
        <li class="mb-3">
            <strong>Mengapa menggunakan nested loop?</strong><br>
            Nested loop diperlukan karena setiap elemen dalam list
            harus dibandingkan dengan elemen lainnya secara bertahap.
            Tanpa perulangan bersarang, proses pembandingan menyeluruh tidak dapat dilakukan.
        </li>

        <li class="mb-3">
            <strong>Mengapa batas perulangan dalam hanya sampai <code>i</code>?</strong><br>
            Karena elemen setelah indeks <code>i</code> sudah berada pada posisi
            yang benar. Area perbandingan akan berkurang secara dinamis pada setiap iterasi.
        </li>

        <li>
            <strong>Mengapa kompleksitas waktu Bubble Sort adalah O(n²)?</strong><br>
            Pada kondisi terburuk, setiap elemen dibandingkan dengan hampir
            seluruh elemen lainnya melalui mekanisme nested loop,
            sehingga kompleksitas waktu bersifat kuadratik.
        </li>
    </ul>
</div>

            
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
    <a href="{{ route('mahasiswa.bubble.materi-bubble') }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.bubble.simulasi-bubble') }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>


@endsection