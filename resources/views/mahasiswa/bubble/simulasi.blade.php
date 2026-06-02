@extends('layouts.hlmns')

@section('title','Simulasi Bubble Sort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bubble.css') }}">
@endsection

@section('content')

@php
    // Cek apakah aktivitas simulasi ini sudah berstatus 'selesai' di database
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

                <div id="alertKompleksitas" class="alert alert-info mt-3 {{ $isSelesai ? '' : 'd-none' }}">
                    <b>Penjelasan Kompleksitas:</b>
                    <ol class="mb-0 mt-2">
                        <li>Pada simulasi ini, data awal <b>[4, 2, 5, 1, 3]</b> belum terurut sehingga Bubble Sort harus melakukan beberapa proses perbandingan dan pertukaran data hingga seluruh elemen berada pada urutan yang benar. Oleh karena itu, proses pengurutan pada simulasi ini termasuk kondisi <b>average case</b> dengan kompleksitas waktu <b>O(n²)</b>.</li>
                        <li>Jika data sudah terurut sejak awal, misalnya <b>[1, 2, 3, 4, 5]</b>, Bubble Sort hanya perlu melakukan pengecekan tanpa melakukan pertukaran data. Kondisi ini disebut <b>best case</b> dengan kompleksitas waktu <b>O(n)</b>.</li>
                        <li>Jika data berada dalam urutan terbalik, misalnya <b>[5, 4, 3, 2, 1]</b>, Bubble Sort harus melakukan pertukaran pada hampir setiap perbandingan hingga data menjadi terurut. Kondisi ini disebut <b>worst case</b> dengan kompleksitas waktu <b>O(n²)</b>.</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>

@if($isSelesai)
    <div class="alert alert-success mt-3 mb-0">
        <i class="bi bi-check-circle-fill me-2"></i> 
        <strong>Selesai!</strong> Anda sudah pernah menyelesaikan simulasi ini. Tombol navigasi di bawah sudah terbuka.
    </div>
@endif

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','sorting']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','program']) }}" 
       id="btnNextBubbleSim"
       class="btn btn-primary {{ $isSelesai ? '' : 'disabled' }}" 
       {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;"' !!}>
        Selanjutnya
    </a>

</div>

<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>

@if(!$isSelesai)
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Tangkap elemen kotak pesan selesai dan tombol selanjutnya
    const finishMessage = document.getElementById('finish-message');
    const btnNext = document.getElementById('btnNextBubbleSim');
    const alertKompleksitas = document.getElementById('alertKompleksitas');

    // Buat pemantau (Observer) untuk melihat perubahan pada atribut "style"
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === "style") {
                // Cek apakah pesan selesai sudah tidak disembunyikan (display != none)
                const displayStyle = window.getComputedStyle(finishMessage).display;
                if (displayStyle !== 'none') {
                    // document.getElementById('alertKompleksitas').style.display = 'block';
                    alertKompleksitas.classList.remove('d-none');
                    simpanProgresSimulasi(); // Simpan progres
                    observer.disconnect();   // Matikan pemantau agar tidak dipanggil berkali-kali
                }
            }
        });
    });

    // Mulai memantau div finish-message
    if(finishMessage) {
        observer.observe(finishMessage, { attributes: true });
    }

    // Fungsi AJAX untuk menembak ke database
    function simpanProgresSimulasi() {
        fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                id_aktivitas: {{ $item->id }} // Mengirimkan ID materi simulasi saat ini
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // BUKA GEMBOK TOMBOL SELANJUTNYA
                btnNext.classList.remove('disabled');
                btnNext.removeAttribute('tabindex');
                btnNext.removeAttribute('aria-disabled');
                btnNext.style.pointerEvents = 'auto';
                btnNext.style.opacity = '1';
                
                // Tambahkan efek visual halus
                btnNext.classList.add('shadow-lg');
            }
        })
        .catch(error => console.error("Gagal menyimpan progres:", error));
    }
});
</script>
@endif


@endsection