@extends('layouts.landing_layouts')

@section('title', 'Petunjuk Penggunaan - Sorting App')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { background-color: #f0f7ff !important; }
    
    .content-wrapper {
        padding-top: 110px; 
        padding-bottom: 40px;
    }

    .accordion-item {
        border: none;
        border-radius: 1rem !important; 
        margin-bottom: 0.8rem; 
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.05);
        overflow: hidden;
    }
    .accordion-button {
        border-radius: 1rem !important;
        background-color: #ffffff;
        color: #1e293b;
        padding: 1rem 1.25rem; 
        transition: all 0.3s ease;
    }
    .accordion-button:not(.collapsed) {
        background-color: #dbeafe;
        color: #1d4ed8;
        box-shadow: none;
    }
    .accordion-button:focus { box-shadow: none; }
    
    /* Padding pada container gambar diperkecil maksimal agar gambar bisa lebih besar */
    .img-container { 
        background-color: #f8fafc; 
        border: 1px solid #e2e8f0; 
        padding: 0.25rem; 
        border-radius: 0.5rem;
    }
    
    .step-number {
        width: 38px; height: 38px;
        background-color: #0d6efd; color: white;
        font-size: 1.1rem; font-weight: 900;
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }

    /* Merapatkan jarak angka pada list teks */
    ol.compact-list {
        padding-left: 1.2rem;
        margin-bottom: 0;
    }
</style>

<div class="container content-wrapper">
    
    <div class="p-4 mb-4 text-white rounded-4 shadow-sm d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #1d4ed8, #2563eb);">
        <div class="me-md-4">
            <h1 class="fs-2 fw-bold mb-2">Petunjuk Penggunaan</h1>
            <p class="fs-6 mb-0" style="color: #dbeafe; max-width: 700px;">
                Selamat datang di Media Pembelajaran Sorting! Klik pada langkah di bawah ini untuk melihat panduan lengkap.
            </p>
        </div>
        <div class="d-none d-md-block opacity-25" style="font-size: 5rem; line-height: 1;">
            <i class="fa-solid fa-circle-info"></i>
        </div>
    </div>

    <div class="accordion" id="accordionPetunjuk">

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed fs-5 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="step-number me-3">1</div> Akses Beranda
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionPetunjuk">
                <div class="accordion-body p-3">
                    <div class="row align-items-center g-3">
                        <div class="col-lg-4 col-xl-3">
                            <p><strong> Tentang Halaman Beranda :</strong></p>
                            <ol class="fs-6 compact-list" style="line-height: 1.6;">
                                <li class="mb-2"><b>Navigasi</b> digunakan untuk berpindah dan mengakses halaman seperti <b>Beranda, Materi, Kodeku, Petunjuk Penggunaan, Tentang,</b> dan <b>Masuk.</b></li>
                                <li class="mb-2">Mulai Belajar digunakan untuk memulai pembelajaran dengan <b>masuk ke akun terlebih dahulu</b> sebelum <b>mengakses materi.</b></li>
                            </ol>
                        </div>
                        <div class="col-lg-8 col-xl-9">
                            <div class="img-container">
                                <img src="{{ asset('images/petunjuk/beranda.png') }}" alt="Dashboard" class="img-fluid rounded-1 border w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fs-5 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="step-number me-3">2</div> Cara Masuk / Login
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionPetunjuk">
                <div class="accordion-body p-3">
                    <div class="row align-items-center g-4">{{-- <div class="row align-items-start g-4"> --}}
                        <div class="col-lg-4 col-xl-3 order-1 order-lg-2">
                            <p><strong>Langkah Masuk Akun:</strong></p>
                            <ol class=" fs-6 compact-list" style="line-height: 1.6;">
                                <li class="mb-2">
                                    Masukkan <b>email</b> dan <b>kata sandi</b>, lalu klik <b>“Masuk ke Dashboard”</b> untuk masuk ke sistem.
                                </li>
                                <li>
                                    Jika belum memiliki akun, klik <b>“Daftar Sekarang”</b> untuk melakukan pendaftaran.
                                </li>
                            </ol>
                        </div>
                        <div class="col-lg-8 col-xl-9 order-2 order-lg-1">
                            <div class="img-container">
                                <img src="{{ asset('images/petunjuk/login.png') }}" alt="Login" class="img-fluid rounded-1 border w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed fs-5 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <div class="step-number me-3">3</div> Mempelajari Materi
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionPetunjuk">
                <div class="accordion-body p-3">
                    <div class="row align-items-center g-3">
                        <div class="col-lg-8 col-xl-9 order-2 order-lg-1">
                            <div class="img-container">
                                <img src="{{ asset('images/petunjuk/materi.png') }}" alt="Materi" class="img-fluid rounded-1 border w-100">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-3 order-1 order-lg-2">
                            <p><strong>Tentang Halaman Materi:</strong></p>
                            <ol class="fs-6 compact-list" style="line-height: 1.6;">
                                <li class="mb-2">
                                    Klik <b>profil pengguna</b> di pojok kanan atas untuk melihat opsi <b>profil</b> atau <b>logout</b>.
                                </li>
                                <li class="mb-2">
                                    Gunakan <b>sidebar di sebelah kiri</b> untuk memilih materi. 
                                    Materi akan <b>terkunci</b> jika aktivitas sebelumnya belum diselesaikan.
                                </li>
                                <li>
                                    Gunakan tombol <b>“Sebelumnya”</b> dan <b>“Selanjutnya”</b> untuk berpindah antar sub materi.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed fs-5 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                    <div class="step-number me-3">4</div> Kuis & Syarat Kelulusan
                </button>
            </h2>

            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionPetunjuk">
                <div class="accordion-body p-3">

                    <h6 class="fw-bold mb-3">Tentang Kuis dan Kelulusan:</h6>

                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:28px;height:28px;">
                            !
                        </div>
                        <div>
                            <b>Kuis</b> digunakan untuk mengukur pemahaman pada setiap bab.
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:28px;height:28px;">
                            !
                        </div>
                        <div>
                            Syarat lanjut ke bab berikutnya adalah nilai tidak kurang dari <b>KKM</b>.
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:28px;height:28px;">
                            !
                        </div>
                        <div>
                            <b>Lulus</b> apabila nilai Evaluasi Akhir <b>memenuhi KKM</b>.
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:28px;height:28px;">
                            !
                        </div>
                        <div>
                            Jika kuis atau evaluasi <b>dikerjakan lebih dari satu kali</b>, nilai maksimal yang diperoleh adalah sesuai KKM.
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
            <i class="fa-solid fa-house me-2"></i> Kembali ke Beranda
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection