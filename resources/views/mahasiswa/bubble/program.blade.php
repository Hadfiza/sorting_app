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

@section('content')


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

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','simulasi']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','quiz']) }}" 
       class="btn btn-primary">
        Lanjut Quiz
    </a>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>
<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>
{{-- <script src="{{ asset('js/bubblesort.js') }}"></script> --}}


@endsection