@extends('layouts.landing_layouts')

@section('title', 'Beranda - SortingLearn')

@section('content')
<section class="hero">
    <div class="container pt-5">
        <div class="row align-items-center gx-5 ">

            <div class="col-md-6">
                <h1 class="fw-bold mb-2">
                    Welcome to SortLearn.
                </h1>
                <h5>Media ini dirancang untuk membantu pengguna dalam memahami algoritma sorting pada python. Materi yang disajikan mencakup pengenalan konsep sorting, algortima bublesort, algoritma selectionsort, algoritma insertionsort, dan algoritma mergesort. Media ini sesuai bagi siapa pun yang ingin memperkuat pemahaman algoritma sorting serta mengembangkan keterampilan pemrograman Python melalui pendekatan yang sistematis dan mudah dipahami.</h5>

                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    Mulai Belajar
                </a>
            </div>

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