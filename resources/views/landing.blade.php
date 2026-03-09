<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SortingLearn</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>

<body>

<!-- ===== HEADER ===== -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        
        <a class="navbar-brand fw-bold d-flex align-items-center fs-3" href="/">
            <img src="{{ asset('images/LOGO.png') }}" alt="Logo" height="50" class="me-2">
            SortLearn
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/fitur">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Materi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kodeku') }}">Kodeku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kontak">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/bantuan">Bantuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="hero">
<div class="container pt-5">
<div class="row align-items-center gx-5 ">

    <!-- TEKS -->
    <div class="col-md-6">
        <h1 class="fw-bold mb-2">
            Welcome to SortLearn.
        </h1>
        <h5 >Media ini dirancang untuk membantu pengguna dalam memahami algoritma sorting pada python. Materi yang disajikan mencakup pengenalan konsep sorting, algortima bublesort, algoritma selectionsort, algoritma insertionsort, dan algoritma mergesort. Media ini sesuai bagi siapa pun yang ingin memperkuat pemahaman algoritma sorting serta mengembangkan keterampilan pemrograman Python melalui pendekatan yang sistematis dan mudah dipahami.</h5>

        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
            Mulai Belajar
        </a>
    </div>

    <!-- LAPTOP + ANIMASI -->
    <div class="col-md-6 text-center">
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

<!-- ===== SCRIPT SORTING ===== -->
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


</body>
</html>
