@extends('layouts.hlmns')

@section('title','Kode Program Imsertion Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/insertion.css') }}">
@endsection

@section('content')

@php
    // Mengecek apakah materi ini sudah pernah diselesaikan
    $isSelesai = isset($progresSelesai) && in_array($item->id, $progresSelesai);
@endphp


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
/* === KODE TAMBAHAN DARI AI SELESAI === */
</style>

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

<div class="materi-page">
        <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-code"></i>
                <span class="materi-badge">Program InsertionSort</span>
            </div>

            <div class="my-4 text-start">
                <div class="alert alert-warning mb-3">
                    <strong>Instruksi:</strong> Amati kode berikut dengan saksama,
                    kemudian ketik ulang pada fitur <em>Live Coding</em> di bawah tanpa melakukan copy–paste.
                </div>

                <div class="code-container">
<pre class="code-box">
 1  def insertion_sort(data):
 2      n = len(data)
 3      for i in range(1, n):
 4          key = data[i]
 5          j = i - 1
 6
 7          while j >= 0 and data[j] > key:
 8              data[j + 1] = data[j]
 9              j -= 1
10
11          data[j + 1] = key
12          print(f"Hasil setelah langkah ke-{i}: {data}")
13
14  angka = [4, 2, 5, 1, 3]
15  print("Sebelum sorting:", angka)
16  insertion_sort(angka)
17  print("Setelah sorting:", angka)
</pre>
                </div>
            </div>
            
<h5 class="fw-bold mt-4">Penjelasan Kode</h5>

<div class="accordion" id="accordionPenjelasanInsertion">

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan1">
                1) Deklarasi Fungsi
            </button>
        </h2>
        <div id="insertionPenjelasan1" class="accordion-collapse collapse show"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 1, fungsi insertion_sort() didefinisikan dengan parameter data. Parameter ini berisi kumpulan data yang akan diurutkan menggunakan algoritma Insertion Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan2">
                2) Menentukan Panjang Data
            </button>
        </h2>
        <div id="insertionPenjelasan2" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 2, fungsi len(data) digunakan untuk menghitung jumlah elemen dalam list dan menyimpannya ke dalam variabel n. Nilai ini digunakan sebagai batas perulangan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan3">
                3) Perulangan Utama dan Menentukan Data yang Akan Disisipkan
            </button>
        </h2>
        <div id="insertionPenjelasan3" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 3–5, perulangan digunakan untuk mengambil elemen mulai dari indeks ke-1 hingga elemen terakhir. Nilai pada indeks i disimpan ke dalam variabel key, sedangkan variabel j diisi dengan nilai i - 1 untuk menunjukkan posisi elemen di sebelah kiri key yang akan digunakan dalam proses perbandingan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan4">
                4) Proses Perbandingan dan Pergeseran Data
            </button>
        </h2>
        <div id="insertionPenjelasan4" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 7–9, dilakukan proses perbandingan menggunakan perulangan while. Selama nilai j masih berada dalam batas list dan elemen pada indeks j lebih besar daripada key, elemen tersebut akan digeser satu posisi ke kanan. Setelah proses pergeseran dilakukan, nilai j dikurangi satu untuk melanjutkan pemeriksaan pada elemen sebelumnya.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan5">
                5) Menempatkan Elemen pada Posisi yang Tepat
            </button>
        </h2>
        <div id="insertionPenjelasan5" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 11, nilai key ditempatkan pada indeks j + 1. Posisi tersebut merupakan lokasi yang tepat setelah seluruh elemen yang lebih besar berhasil digeser ke kanan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan6">
                6) Menampilkan Hasil Setiap Langkah
            </button>
        </h2>
        <div id="insertionPenjelasan6" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 12, data ditampilkan setelah satu proses penyisipan selesai dilakukan sehingga perubahan urutan data dapat diamati pada setiap langkah algoritma.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan7">
                7) Menyiapkan Data yang Akan Diurutkan
            </button>
        </h2>
        <div id="insertionPenjelasan7" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 14, didefinisikan sebuah list bernama angka yang berisi data [4, 2, 5, 1, 3]. Data ini digunakan sebagai contoh dalam proses pengurutan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan8">
                8) Menampilkan Data Sebelum Pengurutan
            </button>
        </h2>
        <div id="insertionPenjelasan8" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 15, data ditampilkan sebelum proses pengurutan dilakukan sehingga urutan awal elemen dapat diketahui.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan9">
                9) Memanggil Fungsi Insertion Sort
            </button>
        </h2>
        <div id="insertionPenjelasan9" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 16, fungsi insertion_sort(angka) dipanggil untuk menjalankan proses pengurutan menggunakan algoritma Insertion Sort.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#insertionPenjelasan10">
                10) Menampilkan Hasil Pengurutan
            </button>
        </h2>
        <div id="insertionPenjelasan10" class="accordion-collapse collapse"
            data-bs-parent="#accordionPenjelasanInsertion">
            <div class="accordion-body">
                Pada baris 17, data ditampilkan kembali setelah proses pengurutan selesai sehingga hasil akhir pengurutan dapat dilihat.
            </div>
        </div>
    </div>

</div>

        </div>
    </div>


    <div class="card mb-4 materi-box mt-4" id="fillCodeActivity">
        <div class="card-body materi-text">
            <div class="materi-header mb-3">
                <i class="fas fa-keyboard"></i>
                <span class="materi-badge">Aktivitas 4.2: Melengkapi Kode Program</span>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-outline-primary btn-sm"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#instruksiKode"
                        aria-expanded="false">
                    <i class="fas fa-info-circle me-1"></i>
                    Instruksi Pengerjaan
                </button>

                <div class="collapse mt-2" id="instruksiKode">
                    <div class="alert alert-primary mb-0">
                        <ol class="mb-0 ps-3">
                            <li>Lengkapi seluruh bagian kode yang masih kosong.</li>
                            <li>Perhatikan kembali materi Bubble Sort pada bagian atas halaman.</li>
                            <li>Klik tombol <strong>Periksa Kode</strong> untuk memeriksa jawaban.</li>
                            <li>Jika ingin mengulang, klik tombol <strong>Reset</strong>.</li>
                            <li>Semua bagian harus benar untuk membuka akses selanjutnya.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="code-container" style="background: #1e1e1e; padding: 20px; border-radius: 8px; color: #d4d4d4; font-family: 'Courier New', monospace; font-size: 14px; line-height: 2;">
                <span style="color: #569cd6;">def</span> <span style="color: #dcdcaa;">insertion_sort</span>(data):<br>
                &nbsp;&nbsp;&nbsp;&nbsp;n = <span style="color: #dcdcaa;">len</span>(data)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">for</span> i <span style="color: #c586c0;">in</span> <span style="color: #dcdcaa;">range</span>(<input type="text"
                id="i_blank1"
                class="code-input {{ $isSelesai ? 'correct' : '' }}"
                placeholder="..."
                value="{{ $isSelesai ? '1' : '' }}"
                {{ $isSelesai ? 'readonly' : '' }}
                style="width: 40px; text-align: center;">, n): <span style="color: #6a9955;"># Mulai dari elemen kedua</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key = data[i]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;j = i - <span style="color: #b5cea8;">1</span><br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #c586c0;">while</span> j >= <span style="color: #b5cea8;">0</span> <span style="color: #c586c0;">and</span> data[j] <input type="text" id="i_blank2" class="code-input" placeholder="..." style="width: 40px; text-align: center; " value="{{ $isSelesai ? '>' : '' }}"{{ $isSelesai ? 'readonly' : '' }} class="code-input {{ $isSelesai ? 'correct' : '' }}"> key: <span style="color: #6a9955;"># Cek apakah elemen kiri lebih besar</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[j + <span style="color: #b5cea8;">1</span>] = data[j]<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;j -= <span style="color: #b5cea8;">1</span><br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data[j + <span style="color: #b5cea8;">1</span>] = <input type="text" id="i_blank3" class="code-input" placeholder="..." style="width: 60px; text-align: center;" value="{{ $isSelesai ? 'key' : '' }}"{{ $isSelesai ? 'readonly' : '' }} class="code-input {{ $isSelesai ? 'correct' : '' }}"> <span style="color: #6a9955;"># Sisipkan elemen ke posisi yang tepat</span><br>
            </div>

            <div id="fillCodeFeedback" class="alert {{ $isSelesai ? 'alert-success' : 'd-none' }} mt-3">
                @if($isSelesai)
                    <i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Anda sangat tepat. Aktivitas selanjutnya telah dibuka. Silakan coba kode ini pada Live Editor di bawah!
                @endif
            </div>
            
            <div class="text-center mt-3">
                <button id="btnCheckCode"
                        class="btn btn-primary"
                        {{ $isSelesai ? 'disabled' : '' }}>
                    {{ $isSelesai ? 'Kode Sudah Benar' : 'Periksa Kode' }}
                </button>

                <button id="btnResetCode"
                        class="btn btn-outline-secondary ms-2"
                        {{ $isSelesai ? 'disabled' : '' }}>
                    Reset
                </button>
            </div>

        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body materi-text">
            <p>Jalankan kode program Insertion Sort di bawah ini untuk mengamati bagaimana Python memproses data.</p>
          
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
       class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}" 
       id="btnNextInsertion" 
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
    const btnNext = document.getElementById('btnNextInsertion');
    // const lockIcon = document.getElementById('lockIconInsertion');

    btnCheckCode.addEventListener('click', function() {
        // Ambil nilai input
        const b1 = document.getElementById('i_blank1').value.trim(); // Jawaban: 1
        const b2 = document.getElementById('i_blank2').value.trim(); // Jawaban: >
        const b3 = document.getElementById('i_blank3').value.trim(); // Jawaban: key

        let correctCount = 0;

        // Validasi Blank 1
        if (b1 === '1') {
            document.getElementById('i_blank1').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('i_blank1').className = 'code-input wrong';
        }

        // Validasi Blank 2
        if (b2 === '>') {
            document.getElementById('i_blank2').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('i_blank2').className = 'code-input wrong';
        }

        // Validasi Blank 3
        if (b3 === 'key') {
            document.getElementById('i_blank3').className = 'code-input correct';
            correctCount++;
        } else {
            document.getElementById('i_blank3').className = 'code-input wrong';
        }

        // Output Feedback
        if (correctCount === 3) {
            feedbackCode.className = 'alert alert-success mt-3';
            feedbackCode.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Logika Insertion Sort Anda sudah tepat. Aktivitas selanjutnya telah dibuka. Silakan coba kode tersebut pada Live Editor!';
            // feedbackCode.classList.remove('d-none');
            
            // Buka gembok tombol Selanjutnya
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';          
            // lockIcon.className = 'fa-solid fa-unlock me-1';

                document.getElementById('i_blank1').value = '1';
                document.getElementById('i_blank2').value = '>';
                document.getElementById('i_blank3').value = 'key';

                // Kunci input dan tombol setelah berhasil
                document.getElementById('i_blank1').readOnly = true;
                document.getElementById('i_blank2').readOnly = true;
                document.getElementById('i_blank3').readOnly = true;
                btnCheckCode.disabled = true;
                btnCheckCode.innerText = 'Kode Sudah Benar';

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
                        feedbackCode.innerHTML = '<strong>Luar Biasa!</strong> Pemahaman Anda tentang Insertion Sort sangat tepat. Akses ke halaman selanjutnya telah dibuka.';
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
const btnResetCode = document.getElementById('btnResetCode');

btnResetCode.addEventListener('click', function () {

    ['i_blank1','i_blank2','i_blank3'].forEach(id => {
        const input = document.getElementById(id);

        input.value = '';
        input.className = 'code-input';
    });

    const feedbackCode = document.getElementById('fillCodeFeedback');
    feedbackCode.className = 'alert d-none';
    feedbackCode.innerHTML = '';
});
</script>
<script>
window.IMG_PATH = "{{ asset('images/aset/nama') }}/";
</script>
<script src="{{ asset('js/editor.js') }}"></script>

@endsection