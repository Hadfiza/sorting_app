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
                <p>Bubble Sort bekerja dengan cara…</p>

                <div class="quiz-options">
                    <label class="option-box">
                        <input type="radio" name="q1" value="A">
                        <span>Elemen kecil turun ke bawah</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q1" value="B">
                        <span>Elemen besar menggelembung ke posisi akhir</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q1" value="C">
                        <span>Menghapus elemen yang tidak diperlukan</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q1" value="D">
                        <span>Menggabungkan elemen data</span>
                    </label>
                </div>
            </div>

            <!-- SOAL 2 -->
            <div class="soal d-none">
                <p><strong>Soal 2</strong></p>
                <p>Pengurutan dari nilai terbesar ke nilai terkecil disebut…</p>

                <div class="quiz-options">
                    <label class="option-box">
                        <input type="radio" name="q2" value="A">
                        <span>Linear</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q2" value="B">
                        <span>Ascending</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q2" value="C">
                        <span>Descending</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q2" value="D">
                        <span>Sequential</span>
                    </label>
                </div>
            </div>

            <!-- SOAL 3 -->
            <div class="soal d-none">
                <p><strong>Soal 3</strong></p>
                <p>Dalam proses sorting, sort key adalah…</p>

                <div class="quiz-options">
                    <label class="option-box">
                        <input type="radio" name="q3" value="A">
                        <span>Jumlah total elemen dalam data</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q3" value="B">
                        <span>Atribut yang dijadikan dasar pengurutan</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q3" value="C">
                        <span>Indeks pertama dalam array</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q3" value="D">
                        <span>Nilai yang selalu disimpan di akhir pengurutan</span>
                    </label>
                </div>
            </div>

            <!-- SOAL 4 -->
            <div class="soal d-none">
                <p><strong>Soal 4</strong></p>
                <p>Kompleksitas waktu O(n²) berarti…</p>

                <div class="quiz-options">
                    <label class="option-box">
                        <input type="radio" name="q4" value="A">
                        <span>Waktu bertambah secara kuadrat terhadap jumlah data</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q4" value="B">
                        <span>Waktu bertambah dua kali lipat ketika data dua kali lebih besar</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q4" value="C">
                        <span>Waktu konstan meskipun ukuran data berubah</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q4" value="D">
                        <span>Waktu bertambah berdasarkan faktor logaritma</span>
                    </label>
                </div>
            </div>

            <!-- SOAL 5 -->
            <div class="soal d-none">
                <p><strong>Soal 5</strong></p>
                <p>Tujuan utama analisis kompleksitas adalah…</p>

                <div class="quiz-options">
                    <label class="option-box">
                        <input type="radio" name="q5" value="A">
                        <span>Menentukan jumlah variabel yang digunakan</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q5" value="B">
                        <span>Menentukan struktur data baru</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q5" value="C">
                        <span>Membuat algoritma menjadi lebih panjang</span>
                    </label>
                    <label class="option-box">
                        <input type="radio" name="q5" value="D">
                        <span>Menilai efisiensi algoritma saat mengolah data</span>
                    </label>
                </div>
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
// document.addEventListener('DOMContentLoaded', function () {

//     const kunciJawaban = {
//         q1: 'B',
//         q2: 'C',
//         q3: 'B',
//         q4: 'A',
//         q5: 'D'
//     };

//     let indexSoal = 0;
//     const daftarSoal = document.querySelectorAll('.soal');

//     function tampilkanSoal(i){
//         daftarSoal.forEach((soal, idx)=>{
//             soal.classList.toggle('d-none', idx !== i);
//         });
//         indexSoal = i;
//     }

//     function nextSoal(){
//         if(indexSoal < daftarSoal.length - 1){
//             tampilkanSoal(indexSoal + 1);
//         } else {
//             hitungNilai();
//         }
//     }

//     function prevSoal(){
//         if(indexSoal > 0){
//             tampilkanSoal(indexSoal - 1);
//         }
//     }

//     function hitungNilai(){
//         let benar = 0;

//         for(const key in kunciJawaban){
//             const jawaban = document.querySelector(`input[name="${key}"]:checked`);
//             if(jawaban && jawaban.value === kunciJawaban[key]){
//                 benar++;
//             }
//         }

//         Swal.fire({
//             title: 'Hasil Kuis',
//             html: `
//               <p>Jawaban benar: <b>${benar} dari ${Object.keys(kunciJawaban).length}</b></p>
//               <p>Skor: <b>${benar * 20}</b></p>
//             `,
//             icon: 'info',
//             showCancelButton: true,
//             confirmButtonText: 'Ulangi',
//             cancelButtonText: 'Selesai'
//         }).then((result)=>{
//             if(result.isConfirmed){
//                 resetKuis();
//             }
//         });
//     }

//     function resetKuis(){
//         document.querySelectorAll('input[type="radio"]').forEach(r=>r.checked=false);
//         tampilkanSoal(0);
//     }

//     // expose
//     window.nextSoal = nextSoal;
//     window.prevSoal = prevSoal;

//     tampilkanSoal(0);
// });
</script>

@endsection

