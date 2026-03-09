@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bubble.css') }}">
@endsection

@section('content')

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

            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','sorting']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['bubble','program']) }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>

</div>

<script>
window.IMG_PATH = "{{ asset('images/buku') }}/";
</script>
<script src="{{ asset('js/bubblesort.js') }}"></script>


@endsection