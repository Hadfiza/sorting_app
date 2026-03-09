@extends('layouts.hlmns')

@section('title','BubbleSort')

@section('content')

<!-- ===== Judul Materi dengan Box ===== -->
<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma BubbleSort</h3>
                <p class="text-muted mb-0 mt-1">Pengurutan data dengan metode pertukaran sederhana</p>
            </div>
        </div>
    </div>
</div>

<!-- ===== Kompleksitas algoritma sorting ===== -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Tujuan Pembelajaran</h5> 
        <ul>
            <li>Menjelaskan pengertian dan konsep dasar sorting.</li>
            <li>Mengidentifikasi jenis-jenis urutan data (ascending dan descending).</li>
            <li>Menunjukkan pentingnya efisiensi dan ketepatan dalam proses pengurutan data.</li>
        </ul>
    </div>
</div>

<!-- ===== BUBBLESORT ===== -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">BubbleSort</h5>
        <p class="card-text text-justify">
            Bubble Sort adalah algoritma pengurutan berbasis perbandingan yang bekerja dengan cara membandingkan elemen-elemen yang bersebelahan dalam suatu daftar, kemudian menukarnya jika urutannya salah. Proses ini diulang terus menerus hingga seluruh elemen tersusun dengan benar. Nama "Bubble Sort" diambil dari fakta bahwa elemen yang lebih besar "menggelembung" ke posisi akhir daftar, sementara elemen yang lebih kecil bergerak ke awal.</br></br>

            Jika terdapat n data, maka proses perbandingan dilakukan sebanyak n–1 kali dalam satu iterasi. Proses ini terus berlanjut hingga tidak ada lagi pertukaran data yang terjadi, yang berarti data sudah terurut dengan sempurna. Setiap satu kali pemeriksaan seluruh data disebut satu iterasi (siklus).
        </p>
    </div>
</div>

<!-- ===== Prinsip Kerja ===== -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">BubbleSort</h5>
        <p class="card-text text-justify">
            Pada setiap langkah, dua elemen yang bersebelahan akan dibandingkan:
        </p>
        <ul class="card-text">
            <li>Jika elemen kiri lebih besar dari elemen kanan → tukar posisi.</li>
            <li>Jika elemen sudah berurutan → tidak terjadi pertukaran.</li>
        </ul>
        <p class="card-text text-justify">
            Langkah ini diulang dari awal sampai akhir kumpulan data. Setelah satu kali iterasi selesai, elemen terbesar akan berada di posisi paling akhir. Iterasi berikutnya dilakukan terhadap sisa data lainnya sampai semuanya terurut.
        </p>
    </div>
</div>







<script>
let sudahDitukar = false;

function swapAndShowSorted(){

    // CEGAH KLIK ULANG
    if(sudahDitukar) return;
    sudahDitukar = true;

    // 1. SWAP dua buku (atas)
    const a = document.getElementById('bukuA');
    const b = document.getElementById('bukuB');

    const tempSrc = a.src;
    const tempEdisi = a.dataset.edisi;

    a.src = b.src;
    a.dataset.edisi = b.dataset.edisi;

    b.src = tempSrc;
    b.dataset.edisi = tempEdisi;

    // 2. AMBIL SEMUA BUKU (ATAS)
    const container = document.getElementById('unsorted-books');
    const books = Array.from(container.children);

    // 3. SORT UNTUK HASIL TERURUT
    books.sort((x, y) => {
        return (x.dataset.edisi || 0) - (y.dataset.edisi || 0);
    });

    // 4. TAMPILKAN HASIL TERURUT (BAWAH)
    const result = document.getElementById('sorted-books');
    result.innerHTML = '';

    books.forEach(book => {
        const clone = book.cloneNode(true);
        clone.classList.remove('swap-target');
        result.appendChild(clone);
    });

    // 5. NONAKTIFKAN TOMBOL
    const btn = document.getElementById('btnSwap');
    btn.disabled = true;
    btn.innerText = 'Proses Selesai';
}
</script>




@endsection