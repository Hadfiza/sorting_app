@extends('layouts.landing_layouts')

@section('title', 'Beranda - SortLearn')


</style>

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<section class="hero">
    <div class="container pt-5">
        <div class="row align-items-center gx-5 ">

            <div class="col-md-6 order-2 order-md-1">
                <h1 class="fw-bold mb-2">
                    Welcome to SortLearn.
                </h1>
                <p class="hero-desc">
                Media ini dirancang untuk membantu pengguna memahami algoritma sorting pada Python.
                Materi mencakup konsep dasar, Bubble Sort, Selection Sort, Insertion Sort, dan Merge Sort.

                Media ini cocok bagi siapa pun yang ingin memperkuat pemahaman algoritma serta meningkatkan
                keterampilan pemrograman melalui pendekatan yang sistematis dan mudah dipahami.
                </p>

                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    Mulai Belajar
                </a>
            </div>

            <div class="col-md-6 text-center order-1 order-md-2">
                <div class="laptop-wrapper">
                    <img src="{{ asset('images/laptop.png') }}" class="laptop-img">

                    <div class="laptop-screen">
                        <div id="array" class="sort-container"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="fiturs py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Fitur Unggulan</h2>
            {{-- <p class="text-muted">Belajar algoritma sorting jadi lebih interaktif dan mudah</p> --}}
        </div>

        <div class="row g-4">

            <!-- CARD 1 -->
            <div class="col-md-4">
                <a href="{{ route('kodeku') }}" class="fitur-link">
                    <div class="fitur-card text-center">
                        <div class="fitur-icon"><i class="bi bi-filetype-py"></i></div>
                        <h5>Kodeku <br> Editor Python </h5>
                        <p>Eksplorasi dan uji kode secara real-time untuk melihat langsung proses sorting bekerja.</p>
                    </div>
                </a>
            </div>

            <!-- CARD 2 -->
            <div class="col-md-4">
                <a href="{{ route('login') }}" class="fitur-link">
                    <div class="fitur-card text-center">
                        <div class="fitur-icon">
                            <i class="bi bi-journal"></i>
                        </div>
                        <h5>Materi</h5>
                        <p>Panduan belajar lengkap dari konsep dasar hingga algoritma lanjutan.</p>
                    </div>
                </a>
            </div>

            <!-- CARD 3 -->
            <div class="col-md-4">
                <div class="fitur-card text-center">
                    <div class="fitur-icon"><i class="bi bi-bar-chart"></i></div>
                    <h5>Ilustrasi & Simulasi Interaktif</h5>
                    <p>Visualisasi interaktif membantu memahami setiap langkah proses sorting dengan lebih jelas.</p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
let arr = [2, 3, 4, 5, 8];
const c = document.getElementById("array");

function draw(a=-1,b=-1){
    c.innerHTML="";
    arr.forEach((v,i)=>{
        let d=document.createElement("div");
        d.className="box";
        d.innerText=v;
        if(i===a) d.classList.add("active");
        if(i===b) d.classList.add("swap");
        c.appendChild(d);
    });
}

function sleep(ms){
    return new Promise(r=>setTimeout(r,ms));
}

async function bubble(){
    while(true){
        for(let i=0;i<arr.length-1;i++){
            draw(i,i+1);
            await sleep(500);
            if(arr[i]>arr[i+1]){
                [arr[i],arr[i+1]]=[arr[i+1],arr[i]];
                draw(i,i+1);
                await sleep(500);
            }
        }
    }
}

draw();
bubble();
</script>
@endsection