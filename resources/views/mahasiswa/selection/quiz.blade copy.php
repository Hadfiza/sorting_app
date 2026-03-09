@extends('layouts.hlmns')

@section('title','Latihan Pendahuluan Sorting')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

<h3 class="mb-4">Latihan Pendahuluan Sorting</h3>

<div class="card">
    <div class="card-body">

        <div id="soal-container">

            <!-- SOAL 1 -->
            <div class="soal">
                <p><strong>Soal 1</strong></p>
                <p>Sorting adalah proses untuk…</p>

                <label><input type="radio" name="q1" value="A"> Menyalin elemen dari satu struktur ke struktur lainnya</label><br>
                <label><input type="radio" name="q1" value="B"> Menyusun elemen data dalam urutan tertentu</label><br>
                <label><input type="radio" name="q1" value="C"> Menghapus elemen yang tidak diperlukan</label><br>
                <label><input type="radio" name="q1" value="D"> Menghapus elemen yang tidak diperlukan</label><br>

                <button class="btn btn-primary mt-2" onclick="cekJawaban(1)">
                    Cek Jawaban
                </button>
            </div>

            <!-- SOAL 2 -->
            <div class="soal d-none">
                <p><strong>Soal 2</strong></p>
                <p>Pengurutan dari nilai terbesar ke nilai terkecil disebut…</p>

                <label><input type="radio" name="q2" value="A"> Linear</label><br>
                <label><input type="radio" name="q2" value="B"> Ascending</label><br>
                <label><input type="radio" name="q2" value="C"> Descending</label><br>
                <label><input type="radio" name="q2" value="D"> Sequential</label><br>

                <button class="btn btn-primary mt-2" onclick="cekJawaban(2)">
                    Cek Jawaban
                </button>
            </div>

            <!-- SOAL 3 -->
            <div class="soal d-none">
                <p><strong>Soal 3</strong></p>
                <p>Dalam proses sorting, sort key adalah…</p>

                <label><input type="radio" name="q3" value="A"> Jumlah total elemen dalam data</label><br>
                <label><input type="radio" name="q3" value="B"> Atribut yang dijadikan dasar pengurutan</label><br>
                <label><input type="radio" name="q3" value="C"> Indeks pertama dalam array</label><br>
                <label><input type="radio" name="q3" value="D"> Nilai yang selalu disimpan di akhir pengurutan</label><br>

                <button class="btn btn-primary mt-2" onclick="cekJawaban(3)">
                    Cek Jawaban
                </button>
            </div>

            <!-- SOAL 4 -->
            <div class="soal d-none">
                <p><strong>Soal 4</strong></p>
                <p>Kompleksitas waktu O(n²) berarti…</p>

                <label><input type="radio" name="q4" value="A"> Waktu bertambah secara kuadrat terhadap jumlah data</label><br>
                <label><input type="radio" name="q4" value="B"> Waktu bertambah dua kali lipat ketika data dua kali lebih besar</label><br>
                <label><input type="radio" name="q4" value="C"> Waktu konstan meskipun ukuran data berubah</label><br>
                <label><input type="radio" name="q4" value="D"> Waktu bertambah berdasarkan faktor logaritma</label><br>

                <button class="btn btn-primary mt-2" onclick="cekJawaban(4)">
                    Cek Jawaban
                </button>
            </div>

            <!-- SOAL 5 -->
            <div class="soal d-none">
                <p><strong>Soal 5</strong></p>
                <p>Tujuan utama analisis kompleksitas adalah…</p>

                <label><input type="radio" name="q5" value="A"> Menentukan jumlah variabel yang digunakan</label><br>
                <label><input type="radio" name="q5" value="B"> Menentukan struktur data baru</label><br>
                <label><input type="radio" name="q5" value="C"> Membuat algoritma menjadi lebih panjang</label><br>
                <label><input type="radio" name="q5" value="D"> Menilai efisiensi algoritma saat mengolah data</label><br>

                <button class="btn btn-primary mt-2" onclick="cekJawaban(5)">
                    Cek Jawaban
                </button>
            </div>


        </div>

    </div>
</div>

<!-- PAGINATION (TAILWIND) -->
<div class="flex justify-center mt-4">
  <div class="inline-flex -space-x-px text-sm">

    <button onclick="prevSoal()"
      class="px-3 h-9 border rounded-l-lg bg-white hover:bg-gray-100">
      Previous
    </button>

    <button onclick="goSoal(0)"
      class="w-9 h-9 border hover:bg-gray-100">
      1
    </button>

    <button onclick="goSoal(1)"
      class="w-9 h-9 border hover:bg-gray-100">
      2
    </button>

    <button onclick="goSoal(2)"
      class="w-9 h-9 border hover:bg-gray-100">
      3
    </button>

    <button onclick="goSoal(3)"
      class="w-9 h-9 border hover:bg-gray-100">
      4
    </button>

    <button onclick="goSoal(4)"
      class="w-9 h-9 border hover:bg-gray-100">
      5
    </button>

    <button onclick="nextSoal()"
      class="px-3 h-9 border rounded-r-lg bg-white hover:bg-gray-100">
      Next
    </button>

  </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const kunciJawaban = {
        1: 'B',
        2: 'C',
        3: 'B',
        4: 'A',
        5: 'D'
    };

    let indexSoal = 0;
    const daftarSoal = document.querySelectorAll('.soal');

    function cekJawaban(no){
        const jawaban = document.querySelector(`input[name="q${no}"]:checked`);

        if(!jawaban){
            Swal.fire('Oops','Pilih jawaban dulu','warning');
            return;
        }

        if(jawaban.value === kunciJawaban[no]){
            Swal.fire('Benar 🎉','Jawaban kamu tepat','success');
        }else{
            Swal.fire('Salah ❌','Coba pelajari lagi','error');
        }
    }

    function tampilkanSoal(i){
        daftarSoal.forEach((soal, idx)=>{
            soal.classList.toggle('d-none', idx !== i);
        });
        indexSoal = i;
    }

    function nextSoal(){
        if(indexSoal < daftarSoal.length - 1){
            tampilkanSoal(indexSoal + 1);
        }
    }

    function prevSoal(){
        if(indexSoal > 0){
            tampilkanSoal(indexSoal - 1);
        }
    }

    function goSoal(i){
        tampilkanSoal(i);
    }

    // expose ke global (WAJIB supaya onclick HTML bisa akses)
    window.cekJawaban = cekJawaban;
    window.nextSoal = nextSoal;
    window.prevSoal = prevSoal;
    window.goSoal = goSoal;

    // init
    tampilkanSoal(0);
});
</script>
@endsection

