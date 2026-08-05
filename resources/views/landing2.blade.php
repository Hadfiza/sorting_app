<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SortLearn</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{margin:0;font-family:system-ui}

/* HEADER */
.navbar{
    padding:16px 0;
}

/* HERO */
.hero{
    min-height:90vh;
    display:flex;
    align-items:center;
}
.hero h1{
    font-weight:700;
}

/* SORTING */
.sort-container{
    display:flex;
    gap:10px;
}
.box{
    width:50px;
    height:50px;
    background:#0d6efd;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:6px;
    font-weight:bold;
    transition:.3s;
}
.box.active{background:#ffc107;color:black}
.box.swap{background:#dc3545}
</style>
</head>

<body>

<!-- ================= HEADER ================= -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">SortLearn</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/fitur">Fitur</a>

                <li class="nav-item">
                    <a class="nav-link" href="/materi">Materi</a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="/kodeku">Kodeku</a>

                <li class="nav-item">
                    <a class="nav-link" href="/masuk">Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kontak">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/bantuan">Bantuan</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="btn btn-primary ms-lg-3" href="/materi">
                        Mulai Belajar
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>


<!-- ================= HERO ================= -->
<section class="hero">
<div class="container mt-5 pt-5">
<div class="row align-items-center">

    <!-- TEKS -->
    <div class="col-md-6">
        <h1 class="mb-4">
            Belajar algoritma sorting secara visual dan interaktif.
        </h1>
        <a href="/materi" class="btn btn-primary btn-lg">
            Mulai Belajar
        </a>
    </div>

    <!-- ANIMASI SORTING -->
    <div class="col-md-6 text-center">
        <div id="array" class="sort-container justify-content-center"></div>
    </div>

</div>
</div>
</section>

<!-- ================= SCRIPT SORTING ================= -->
<script>
let arr=[5,3,8,4,2];
const c=document.getElementById("array");

function draw(a=-1,b=-1){
    c.innerHTML="";
    arr.forEach((v,i)=>{
        let d=document.createElement("div");
        d.className="box";
        d.innerText=v;
        if(i===a)d.classList.add("active");
        if(i===b)d.classList.add("swap");
        c.appendChild(d);
    });
}

function sleep(ms){return new Promise(r=>setTimeout(r,ms));}

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
