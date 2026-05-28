@extends('layouts.hlmns')

@section('title','Kode Program Bubble Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bubble.css') }}">
@endsection

<style>


</style>

@section('content')

@php
    // Mengecek apakah materi ini sudah pernah diselesaikan
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">


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

        <div class="card-header bg-transparent pt-4 pb-2 border-0">
            <div class="materi-header mb-4">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program BubbleSort</span>
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
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill fw-bold" id="pills-oflist-tab" data-bs-toggle="pill" data-bs-target="#pills-oflist" type="button" role="tab" aria-controls="pills-oflist" aria-selected="false">
                        <i class="bi bi-3-circle me-1"></i> 3. Contoh List of List
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

                    {{-- <p>Penjelasan:</p>
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
                    </ul> --}}

                    <hr class="my-4">

                    <h5 class="fw-bold">Penjelasan Per Blok</h5>

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

                    {{-- <div class="refleksi-alert mt-4">
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
                    </div> --}}
                
                </div> <div class="tab-pane fade" id="pills-dict" role="tabpanel" aria-labelledby="pills-dict-tab">
                    
                    <div class="my-4 text-start">
                        <div class="alert alert-info mb-3">
                            <strong>Perhatian:</strong> Di dunia nyata, data seringkali berbentuk kumpulan kamus (Dictionary). Perhatikan bagaimana algoritma dimodifikasi agar bisa mengurutkan data berdasarkan kunci (key) tertentu.
                        </div>

                            <div class="code-container">
<pre class="code-box">
def bubble_sort_dict(data, key):
    n = len(data)
    for i in range(n-1, 0, -1):
        for j in range(0, i, 1):
            # Membandingkan value dari 'key' spesifik (misal: 'nilai')
            if data[j][key] > data[j+1][key]:
                temp = data[j+1]
                data[j+1] = data[j]
                data[j] = temp

# Data Mahasiswa berbentuk List of Dictionary
mahasiswa = [
    {"nama": "Andi", "nilai": 75},
    {"nama": "Budi", "nilai": 90},
    {"nama": "Citra", "nilai": 65},
    {"nama": "Dewi", "nilai": 85}
]

print("Sebelum Sorting:")
for mhs in mahasiswa:
    print(mhs)

print("\n--- Proses Bubble Sort Berdasarkan Nilai ---")
# Memanggil fungsi dengan parameter tambahan 'nilai'
bubble_sort_dict(mahasiswa, "nilai")

print("\nSetelah Sorting (Ascending):")
for mhs in mahasiswa:
    print(mhs)
</pre>
                            </div>
                    </div>

                    <h5 class="fw-bold mt-4">Apa yang berubah dari contoh pertama?</h5>
                    <p>Secara logika, algoritma Bubble Sort-nya <strong>sama persis</strong> (menggunakan dua perulangan for). Perbedaannya hanya terletak pada:</p>
                    <ul>
                        <li><strong>Penambahan Parameter <code>key</code>:</strong> Fungsi sekarang menerima argumen <code>key</code> untuk mengetahui atribut apa yang ingin diurutkan (misalnya: "nilai" atau "nama").</li>
                        <li><strong>Cara Membandingkan (If Statement):</strong> Daripada menulis <code>if data[j] > data[j+1]</code>, kita harus mengakses dictionary-nya menggunakan kunci, yaitu <code>if data[j][key] > data[j+1][key]</code>.</li>
                        <li><strong>Yang Ditukar (Swap):</strong> Meskipun yang dibandingkan adalah nilainya, yang ditukar tetaplah <strong>seluruh kotak dictionary-nya</strong> (bukan hanya nilainya), sehingga nama dan nilai mahasiswa tidak akan tertukar dengan mahasiswa lain.</li>
                    </ul>

                </div><div class="tab-pane fade" id="pills-oflist" role="tabpanel" aria-labelledby="pills-oflist-tab">
                    
                    <div class="my-4 text-start">
                        <div class="alert alert-success mb-3">
                            <strong>Materi Baru:</strong> Ini adalah isi materi untuk tab ketiga Anda.
                        </div>

                        <p>Anda bisa menambahkan penjelasan, list, atau gambar di sini persis seperti tab lainnya.</p>

                        <div class="code-container">
<pre class="code-box">
def bubblesortLoL(data):
    n = len(data)
    for i in range(n):
        for j in range(n - 1):
            if data[j][1] > data[j + 1][1]:
                data[j], data[j + 1] = data[j + 1], data[j]
                print(data)

data = [
    ["Ali", 85],
    ["Budi", 75],
    ["Cici", 90]
]

print("Sebelum di sortir:", data)
bubblesortLoL(data)
print("Setelah di sortir:", data)
</pre>
                        </div>

                    <h5 class="fw-bold mt-4">Penjelasan: Apa yang berbeda di metode List of List?</h5>
                    <p>Pada dasarnya logika perulangannya tetap sama, namun ada teknik khusus saat menangani <strong>List di dalam List</strong> (List 2 Dimensi):</p>

                    <ul>
                        <li class="mb-2">
                            <strong>Mengakses Kolom Spesifik (Indeks):</strong><br>
                            Perhatikan baris <code>if data[j][1] > data[j + 1][1]:</code>. <br>
                            Struktur data kita adalah <code>["Nama", Nilai]</code>. Indeks ke-<code>[0]</code> adalah Nama, dan indeks ke-<code>[1]</code> adalah Nilai. Karena kita ingin mengurutkan berdasarkan nilainya, maka kita wajib menambahkan <code>[1]</code> saat melakukan perbandingan.
                        </li>
                        
                        <li class="mb-2">
                            <strong>Pertukaran Satu Paket (Swap):</strong><br>
                            Meskipun yang kita bandingkan hanyalah nilainya (indeks ke-1), saat kondisi terpenuhi kita menukar <strong>seluruh isi list-nya</strong> secara utuh menggunakan baris <code>data[j], data[j + 1] = data[j + 1], data[j]</code>. Ini memastikan nama mahasiswa tidak tertukar dengan nilai mahasiswa lain.
                        </li>

                        <li>
                            <strong>Cara Swap Khas Python:</strong><br>
                            Jika pada contoh sebelumnya kita menggunakan variabel <code>temp</code> (sementara) untuk menukar posisi, pada contoh ini kita menggunakan gaya penulisan <em>Pythonic Swap</em> (<code>a, b = b, a</code>). Cara ini jauh lebih ringkas dan otomatis ditangani di belakang layar oleh Python tanpa perlu variabel tambahan.
                        </li>
                    </ul>

                    <div class="alert alert-success mt-3">
                        <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                        <strong>Tips Eksperimen:</strong> Cobalah ubah angka <code>[1]</code> menjadi <code>[0]</code> pada bagian perbandingan <code>if</code> di Live Editor. Anda akan melihat programnya berubah menjadi mengurutkan data sesuai Abjad Nama (karena indeks ke-0 adalah Nama)!
                    </div>
                    </div>

                </div> </div> </div>
    </div>
        

    <div class="card mb-4 materi-box mt-4" id="fillCodeActivity">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fas fa-keyboard"></i>
                <span class="materi-badge">Aktivitas 2.2: Melengkapi Kode Program</span>
            </div>
            
            <p class="card-text mb-4 text-danger fw-bold">
                Sebelum lanjut, lengkapi bagian kode yang kosong di bawah ini dengan benar untuk membuka akses ke Quiz!
            </p>

            <div class="code-container" style="background: #1e1e1e; padding: 20px; border-radius: 8px; color: #d4d4d4; font-family: 'Courier New', monospace; font-size: 14px; line-height: 2;">
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">bubblesort</span>(list):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> i <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(<input type="text" id="blank1" class="code-input" placeholder="..." style="width: 130px;">, <span style="color: #b5cea8;">0</span>, <span style="color: #b5cea8;">-1</span>): <span style="color: #6a9955;"># Tentukan panjang iterasi berdasarkan list</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> j <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(<span style="color: #b5cea8;">0</span>, i, <span style="color: #b5cea8;">1</span>):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">if</span> list[j] <input type="text" id="blank2" class="code-input" placeholder="..." style="width: 40px; text-align: center;"> list[j+1]: <span style="color: #6a9955;"># Kondisi pertukaran (Ascending)</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;temp = list[j+1]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;list[j+1] = list[j]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;list[j] = <input type="text" id="blank3" class="code-input" placeholder="..." style="width: 80px;"> <span style="color: #6a9955;"># Selesaikan logika swap</span><br>
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
            <p>Jalankan kode program Merge Sort di bawah ini untuk mengamati bagaimana Python memproses data.</p>
          
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

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','simulasi']) }}" 
       class="btn btn-outline-secondary">
       Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','quiz']) }}" 
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       id="btnNextBubble" 
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
    const btnNext = document.getElementById('btnNextBubble');
    // const lockIcon = document.getElementById('lockIconBubble'); // Variabel ini tidak ada elemennya di HTML, saya comment agar tidak error JS

    btnCheckCode.addEventListener('click', function() {
        // Ambil nilai dan hilangkan spasi untuk mencegah error akibat spasi berlebih
        const b1 = document.getElementById('blank1').value.replace(/\s+/g, ''); // Jawaban: len(list)-1
        const b2 = document.getElementById('blank2').value.trim(); // Jawaban: >
        const b3 = document.getElementById('blank3').value.trim(); // Jawaban: temp

        let correctCount = 0;

        // Validasi Blank 1
        if (b1 === 'len(list)-1') {
            document.getElementById('blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('blank1').className = 'code-input wrong';
        }

        // Validasi Blank 2
        if (b2 === '>') {
            document.getElementById('blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('blank2').className = 'code-input wrong';
        }

        // Validasi Blank 3
        if (b3 === 'temp') {
            document.getElementById('blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('blank3').className = 'code-input wrong';
        }

        // Output Feedback
        if (correctCount === 3) {
            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Anda sangat tepat. Tombol Lanjut Quiz telah dibuka. Silakan coba kode ini pada Live Editor di bawah!';
            // feedbackCode.classList.remove('d-none');
            
            // Buka gembok tombol Selanjutnya
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';          
            // lockIcon.className = 'fa-solid fa-unlock me-1'; // Variabel ini tidak ada elemennya di HTML, saya comment agar tidak error JS

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
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection