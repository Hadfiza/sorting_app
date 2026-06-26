@extends('layouts.hlmns')

@section('title','Kompleksitas Algoritma')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sorting.css') }}">
<style>
/* CSS Reset margin & padding untuk menghemat ruang vertikal */
.materi-text p {
    font-size: 0.95rem;
    line-height: 1.5;
}
.form-check {
    padding: 8px 10px 8px 30px;
    border-radius: 6px;
    background-color: #f8f9fa;
    transition: background 0.2s, border 0.2s;
    border: 1px solid transparent;
}
.form-check:hover {
    background-color: #e9ecef;
}
.form-check-input:checked + .form-check-label {
    font-weight: 600;
    color: #0d6efd;
}
.fade-in {
    animation: fadeInOpacity 0.3s ease-in-out;
}
@keyframes fadeInOpacity {
    0% { opacity: 0; transform: translateX(5px); }
    100% { opacity: 1; transform: translateX(0); }
}
/* Responsivitas tombol di HP */
@media (min-width: 768px) {
    .w-md-auto { width: auto !important; }
}
</style>
@endsection

@section('content')

<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fa-solid fa-stopwatch"></i>
            </div>
            <div>
                <h3 class="mb-0">Kompleksitas Algoritma Sorting</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-stopwatch"></i>
                <span class="materi-badge">Kompleksitas Algoritma</span>
            </div>
            <p class="card-text">
            Untuk membandingkan performa berbagai algoritma pengurutan, diperlukan pemahaman mengenai analisis kompleksitas, yang terdiri atas kompleksitas waktu (time complexity) dan kompleksitas ruang (space complexity). Kompleksitas waktu menggambarkan seberapa cepat algoritma menyelesaikan proses pengurutan berdasarkan jumlah data, sedangkan kompleksitas ruang menjelaskan jumlah memori tambahan yang dibutuhkan selama proses tersebut berlangsung.<br>
            Setiap algoritma memiliki kinerja berbeda pada tiga kondisi umum, yaitu best case, average case, dan worst case. Algoritma sederhana seperti Bubble Sort, Selection Sort, dan Insertion Sort memiliki kompleksitas rata-rata O(n²), sehingga kurang efisien ketika digunakan pada data berukuran besar. Sebaliknya, algoritma seperti Merge Sort, Quick Sort, dan Heap Sort menawarkan waktu eksekusi sekitar O(n log n), menjadikannya pilihan yang lebih efisien untuk jumlah data besar.
            </p>
            
            <div class="table-responsive">
                <table class="sorting-table">
                    <thead>
                        <tr>
                            <th>Algoritma</th>
                            <th>Best Case</th>
                            <th>Average Case</th>
                            <th>Worst Case</th>
                            <th>Space Complexity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bubble Sort</td>
                            <td>O(n)</td>
                            <td>O(n²)</td>
                            <td>O(n²)</td>
                            <td>O(1)</td>
                        </tr>
                        <tr>
                            <td>Selection Sort</td>
                            <td>O(n²)</td>
                            <td>O(n²)</td>
                            <td>O(n²)</td>
                            <td>O(1)</td>
                        </tr>
                        <tr>
                            <td>Insertion Sort</td>
                            <td>O(n)</td>
                            <td>O(n²)</td>
                            <td>O(n²)</td>
                            <td>O(1)</td>
                        </tr>
                        <tr>
                            <td>Merge Sort</td>
                            <td>O(n log n)</td>
                            <td>O(n log n)</td>
                            <td>O(n log n)</td>
                            <td>O(n)</td>
                        </tr>
                    </tbody>
                </table>
            </div>      

            <div class="mt-4">

                <div class="d-flex align-items-center p-3 rounded"
                    data-bs-toggle="collapse"
                    data-bs-target="#penjelasanKasus"
                    style="background-color:#eef4ff; cursor:pointer;">

                    <i class="fa-solid fa-book-open text-primary me-2"></i>

                    <span class="fw-semibold text-dark">
                        Penjelasan Best Case, Average Case, dan Worst Case
                    </span>

                    <i class="fa-solid fa-chevron-down ms-auto text-primary"></i>
                </div>

                <div class="collapse mt-3" id="penjelasanKasus">
                    <div class="card border-0 bg-light">
                        <div class="card-body">

                            <p>
                                Dalam analisis algoritma, performa suatu algoritma dapat berbeda
                                bergantung pada kondisi data yang diproses. Oleh karena itu,
                                kompleksitas waktu biasanya dianalisis berdasarkan tiga kondisi,
                                yaitu <strong>best case</strong>, <strong>average case</strong>,
                                dan <strong>worst case</strong>.
                            </p>

                            <h6><strong>Best Case</strong></h6>
                            <p>
                                Merupakan kondisi ketika data masukan sudah terurut atau hampir terurut sehingga
                                algoritma hanya memerlukan sedikit perbandingan dan pertukaran elemen.
                            </p>
                            <p>
                                <code>[1, 2, 3, 5, 4]</code> (data hampir terurut) sehingga hanya memerlukan
                                sedikit proses perbandingan dan satu kali pertukaran untuk menghasilkan urutan yang benar.
                            </p>

                            <h6><strong>Average Case</strong></h6>
                            <p>
                                Merupakan kondisi ketika data masukan berada dalam urutan acak. Pada kondisi ini,
                                algoritma perlu melakukan sejumlah perbandingan dan pertukaran elemen untuk
                                memperoleh urutan yang benar, sehingga waktu eksekusinya berada pada kondisi
                                rata-rata.
                            </p>
                            <p>
                                <code>[3, 1, 5, 2, 4]</code> (data acak) sehingga memerlukan beberapa kali
                                perbandingan dan pertukaran selama proses pengurutan.
                            </p>

                            <h6><strong>Worst Case</strong></h6>
                            <p>
                                Merupakan kondisi ketika data masukan berada pada urutan yang paling jauh dari
                                hasil pengurutan yang diharapkan, misalnya data terurut secara terbalik.
                                Pada kondisi ini, algoritma harus melakukan jumlah perbandingan dan pertukaran
                                elemen yang paling banyak sehingga menghasilkan waktu eksekusi terlama.
                            </p>
                            <p>
                                <code>[5, 4, 3, 2, 1]</code> (data terurut terbalik) sehingga membutuhkan
                                perbandingan dan pertukaran elemen yang lebih banyak dibandingkan kondisi lainnya.
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">

                <div class="d-flex align-items-center p-3 rounded"
                    data-bs-toggle="collapse"
                    data-bs-target="#penjelasanWaktu"
                    style="background-color:#eef4ff; cursor:pointer;">

                    <i class="fa-solid fa-chart-line text-primary me-3"></i>

                    <span class="fw-semibold text-dark">
                        Penjelasan Kompleksitas Waktu
                    </span>

                    <i class="fa-solid fa-chevron-down ms-auto text-primary"></i>
                </div>

                <div class="collapse mt-3" id="penjelasanWaktu">
                    <div class="card border-0 bg-light">
                        <div class="card-body">

                            <p>
                                Kompleksitas waktu menunjukkan perkiraan jumlah operasi yang dilakukan
                                algoritma ketika jumlah data bertambah. Misalnya, jika jumlah data adalah
                                <code>n</code>, maka nilai kompleksitas dapat digunakan untuk memperkirakan
                                pertumbuhan jumlah operasi.
                            </p>

                            <h6 class="fw-bold">O(n)</h6>
                            <p>
                                Kompleksitas <code>O(n)</code> berarti jumlah operasi bertambah sebanding
                                dengan jumlah data.
                            </p>
                            <p>
                                Contoh: jika terdapat <code>n = 5</code> data, maka perkiraan operasi adalah:
                                <br>
                                <code>n = 5</code>, sehingga sekitar <code>5</code> operasi.
                            </p>

                            <h6 class="fw-bold">O(n²)</h6>
                            <p>
                                Kompleksitas <code>O(n²)</code> berarti jumlah operasi bertambah secara
                                kuadrat terhadap jumlah data. Jika data bertambah, jumlah operasi meningkat
                                jauh lebih cepat.
                            </p>
                            <p>
                                Contoh: jika terdapat <code>n = 5</code> data, maka:
                                <br>
                                <code>n² = 5² = 25</code>
                                <br>
                                Artinya, algoritma dapat membutuhkan sekitar <code>25</code> operasi.
                            </p>

                            {{-- <h6 class="fw-bold">O(log n)</h6>
                            <p>
                                Kompleksitas <code>O(log n)</code> berarti jumlah operasi bertambah sangat
                                lambat meskipun jumlah data bertambah besar. Kompleksitas ini biasanya muncul
                                pada algoritma yang membagi ruang pencarian secara berulang.
                            </p>
                            <p>
                                Contoh: jika terdapat <code>n = 8</code> data, maka:
                                <br>
                                <code>log₂ 8 = 3</code>
                                <br>
                                Artinya, proses dapat diselesaikan dalam sekitar <code>3</code> tahap pembagian.
                            </p> --}}

                            <h6 class="fw-bold">O(n log n)</h6>
                            <p>
                            Kompleksitas <code>O(n log n)</code> menunjukkan bahwa jumlah operasi
                            bertambah seiring dengan bertambahnya jumlah data. Namun, pertambahan
                            jumlah operasinya tidak terlalu besar sehingga algoritma tetap efisien
                            untuk mengolah data berukuran besar.
                            </p>
                            <p class="mb-0">
                                Contoh: jika terdapat <code>n = 8</code> data, maka:
                                <br>
                                <code>n log₂ n = 8 × log₂ 8 = 8 × 3 = 24</code>
                                <br>
                                Artinya, algoritma membutuhkan sekitar <code>24</code> operasi.
                            </p>

                        </div>
                    </div>
                </div>
            </div>

<div class="mt-4">

    <div class="d-flex align-items-center p-3 rounded"
         data-bs-toggle="collapse"
         data-bs-target="#penjelasanRuang"
         style="background-color:#eef4ff; cursor:pointer;">

        <i class="fa-solid fa-memory text-primary me-3"></i>

        <span class="fw-semibold text-dark">
            Penjelasan Kompleksitas Ruang
        </span>

        <i class="fa-solid fa-chevron-down ms-auto text-primary"></i>
    </div>

    <div class="collapse mt-3" id="penjelasanRuang">
        <div class="card border-0 bg-light">
            <div class="card-body">

                <p>
                    Kompleksitas ruang menunjukkan jumlah memori tambahan yang
                    dibutuhkan algoritma selama proses pengurutan berlangsung.
                    Memori tambahan ini dapat berupa variabel sementara, array
                    bantuan, atau tempat penyimpanan lain yang digunakan saat
                    algoritma bekerja.
                </p>

                <h6 class="fw-bold">O(1)</h6>
                <p>
                    Kompleksitas <code>O(1)</code> berarti penggunaan memori
                    tambahan bersifat tetap. Artinya, meskipun jumlah data
                    bertambah, memori tambahan yang digunakan tidak ikut
                    bertambah secara signifikan.
                </p>
                <p>
                    Contoh: pada Bubble Sort, proses pertukaran data hanya
                    membutuhkan satu variabel sementara seperti <code>temp</code>.
                    Jika jumlah data bertambah dari 5 menjadi 100, variabel
                    tambahan yang digunakan tetap sama.
                </p>

                <h6 class="fw-bold">O(n)</h6>
                <p>
                    Kompleksitas <code>O(n)</code> berarti penggunaan memori
                    tambahan bertambah sebanding dengan jumlah data yang diproses.
                    Semakin banyak data, semakin besar pula ruang penyimpanan
                    tambahan yang dibutuhkan.
                </p>
                <p class="mb-0">
                    Contoh: pada Merge Sort, data dibagi menjadi bagian kiri dan
                    bagian kanan. Jika terdapat <code>n = 8</code> data, maka
                    algoritma membutuhkan ruang tambahan untuk menyimpan hasil
                    pembagian data tersebut selama proses penggabungan.
                </p>

            </div>
        </div>
    </div>

</div>

            {{-- <br>
            <ul>
                <p><b>Penjelasan Kompleksitas Waktu : </b></p>
                <li><strong>O(n) </strong> : waktu bertambah sebanding dengan jumlah data.</li>
                <li><strong>O(n²) </strong> : waktu bertambah kuadrat, tidak efisien untuk data besar.</li>
                <li><strong>O(log n) </strong> : waktu bertambah sangat sedikit meskipun jumlah data bertambah besar, sehingga sangat efisien.</li>
                <li><strong>O(n log n) </strong> : waktu bertambah lebih cepat daripada O(n), tetapi jauh lebih lambat dibandingkan O(n²), sehingga tetap efisien untuk data berukuran besar.</li>
                <br>
                <p><b>Penjelasan Kompleksitas Ruang :</b></p>
                <li><strong>O(1) </strong> : penggunaan memori tambahan tetap dan tidak bertambah meskipun jumlah data bertambah.</li>
                <li><strong>O(n) </strong> : penggunaan memori tambahan bertambah sebanding dengan jumlah data yang diproses.</li>
            </ul> --}}
        </div>
    </div>

    <div class="card mb-1 materi-box mt-2 shadow-sm" id="quizActivity">
            <div class="card-body materi-text p-1 p-md-3"> <div class="materi-header mb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-tasks text-primary "></i>
                        <span class="materi-badge fs-6">Aktivitas 1.2: Uji Pemahaman</span>
                    </div>
                    <span class="badge bg-secondary rounded-pill" id="quizProgress">Soal 1 dari 5</span>
            </div>

            <div class="mb-2">
                <button class="btn btn-sm btn-outline-primary"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#instruksiPilgan">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Instruksi Pengerjaan
                </button>
            </div>

            <div class="collapse" id="instruksiPilgan">
                <div class="alert alert-light border small py-2 px-3">
                    • Terdapat 5 soal pilihan ganda.<br>
                    • Pilih satu jawaban yang paling tepat pada setiap soal.<br>
                    • Semua soal harus dijawab dengan benar untuk membuka materi selanjutnya.
                </div>
            </div>

            <hr>

            {{-- <p class="card-text mb-3 text-danger fw-bold border-bottom pb-2 small">
                <i class="fa-solid fa-lock me-1"></i> Jawablah pertanyaan berikut dengan benar untuk membuka akses ke materi selanjutnya!
            </p> --}}

            <div class="quiz-container">
                
                <div class="quiz-slide fade-in" id="slide-0">
                    <p><strong>Soal :</strong></p>
                    <p class="fw-semibold mb-2 text-dark">
                        1.	Algoritma sorting yang memiliki kompleksitas waktu worst case paling efisien, yaitu sebesar O(n log n), adalah ...
                    </p>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q1" id="q1a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q1a">a. Bubble Sort</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q1" id="q1b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q1b">b. Selection Sort</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q1" id="q1c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q1c">c. Insertion Sort</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q1" id="q1d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q1d">d. Merge Sort</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q1" id="q1e" value="E">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q1e">d. Quick Sort</label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-1">
                    <p class="fw-semibold mb-2 text-dark">
                        2.	Kompleksitas waktu O(n²) pada algoritma Insertion Sort menunjukkan bahwa ...
                    </p>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q2" id="q2a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q2a">a. waktu eksekusi algoritma selalu konstan meskipun ukuran data bertambah</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q2" id="q2b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q2b">b. Waktu bertambah sebanding dengan jumlah data</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q2" id="q2c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q2c">c. Waktu eksekusi bertambah secara kuadratik</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q2" id="q2d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q2d">d. Waktu eksekusi selalu tetap untuk semua ukuran data</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q2" id="q2e" value="E">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q2e">e. waktu eksekusi tidak dipengaruhi oleh kondisi data masukan</label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-2">
                    <p class="fw-semibold mb-2 text-dark">
                        3. Perbedaan yang tepat antara <em>Time Complexity</em> dan <em>Space Complexity</em> adalah ...
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q3" id="q3a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q3a">
                            a. <em>Time complexity</em> mengukur jumlah baris kode, sedangkan <em>space complexity</em> mengukur jumlah variabel.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q3" id="q3b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q3b">
                            b. <em>Time complexity</em> mengukur efisiensi waktu eksekusi seiring bertambahnya data, sedangkan <em>space complexity</em> mengukur penggunaan memori tambahan.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q3" id="q3c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q3c">
                            c. <em>Time complexity</em> selalu bernilai O(n), sedangkan <em>space complexity</em> selalu bernilai O(1).
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q3" id="q3d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q3d">
                            d. <em>Space complexity</em> lebih penting daripada <em>time complexity</em> dalam pengolahan data besar (<em>Big Data</em>).
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q3" id="q3e" value="E">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q3e">
                            e. <em>Space complexity</em> hanya digunakan pada algoritma rekursif.
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-3">
                    <p class="fw-semibold mb-2 text-dark">
                        4. Suatu algoritma pengurutan dikatakan memiliki efisiensi terbaik pada kondisi <em>Best Case</em> O(n) apabila ...
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q4" id="q4a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q4a">
                            a. Data masukan telah terurut dengan benar sebelum proses pengurutan dilakukan.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q4" id="q4b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q4b">
                            b. Data masukan berada dalam urutan menurun (descending).
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q4" id="q4c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q4c">
                            c. Seluruh data memiliki nilai yang sama.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q4" id="q4d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q4d">
                            d. Algoritma menggunakan memori tambahan dalam jumlah besar.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q4" id="q4e" value="E">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q4e">
                            e. Jumlah elemen data sangat sedikit.
                        </label>
                    </div>
                </div>

                <div class="quiz-slide d-none fade-in" id="slide-4">
                    <p class="fw-semibold mb-2 text-dark">
                        5. Algoritma dengan kompleksitas O(n log n) dianggap lebih baik dibandingkan algoritma dengan kompleksitas O(n²) untuk data berukuran besar karena ...
                    </p>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q5" id="q5a" value="A">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q5a">
                        a. Algoritma O(n log n) selalu menghasilkan urutan yang lebih akurat dibandingkan O(n²).
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q5" id="q5b" value="B">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q5b">
                            b. Kompleksitas O(n²) hanya digunakan pada algoritma pengurutan sederhana.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q5" id="q5c" value="C">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q5c">
                            c. Algoritma O(n log n) tidak memerlukan proses perbandingan data.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q5" id="q5d" value="D">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q5d">
                            d. Jumlah operasi pada O(n²) selalu sama berapa pun ukuran datanya.
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="q5" id="q5e" value="E">
                        <label class="form-check-label w-100" style="cursor:pointer;" for="q5e">
                            e. Jumlah operasi pada O(n log n) bertambah lebih lambat dibandingkan O(n²) ketika ukuran data meningkat.
                        </label>
                    </div>

            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                <button type="button" id="btnPrevQuiz" class="btn btn-sm btn-secondary px-3 d-none">
                    <i class="fa-solid fa-chevron-left"></i> Kembali
                </button>
                
                <div class="flex-grow-1 text-center px-2">
                    <button id="btnCheckQuiz" class="btn btn-sm btn-primary px-3 fw-bold d-none shadow-sm w-100 w-md-auto">
                        <i class="fa-solid fa-check-double me-1"></i> Periksa
                    </button>
                    <button id="btnResetQuiz" class="btn btn-sm btn-warning px-3 fw-bold d-none shadow-sm text-dark w-100 w-md-auto">
                        <i class="fa-solid fa-rotate-right me-1"></i> Ulangi Kuis
                    </button>
                </div>

                <button type="button" id="btnNextQuiz" class="btn btn-sm btn-primary px-3">
                    Lanjut <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
            <div id="quizFeedback"
                class="alert {{ $isSelesai ? 'alert-success' : 'd-none' }} mt-3 shadow-sm text-center py-2 mb-0 small">
                
                @if($isSelesai)
                    <i class="fa-solid fa-circle-check me-1"></i>
                    <strong>Uji pemahaman telah diselesaikan.</strong>
                    Materi berikutnya sudah terbuka. Kamu tetap dapat mencoba ulang latihan.
                @endif

            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-3 pt-2 border-top">
    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','sorting']) }}" class="btn btn-outline-secondary">
        Sebelumnya
    </a>
    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','quiz']) }}"
    id="btnNextMateri"
    class="btn btn-success {{ $isSelesai ? '' : 'disabled' }}"
    {!! $isSelesai ? '' : 'tabindex="-1" aria-disabled="true" style="pointer-events:none;opacity:.5"' !!}>

        <i class="fa-solid {{ $isSelesai ? 'fa-unlock' : 'fa-lock' }} me-1"
        id="lockIcon"></i>

        Selanjutnya
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Navigasi UI
    const slides = document.querySelectorAll('.quiz-slide');
    const btnPrev = document.getElementById('btnPrevQuiz');
    const btnNext = document.getElementById('btnNextQuiz');
    const progressText = document.getElementById('quizProgress');
    
    // Logika Kuis
    const btnCheck = document.getElementById('btnCheckQuiz');
    const btnReset = document.getElementById('btnResetQuiz');
    const feedback = document.getElementById('quizFeedback');
    const btnNextMateri = document.getElementById('btnNextMateri');
    const lockIcon = document.getElementById('lockIcon');
    const totalQuestions = slides.length;
    let currentSlide = 0;

    // Status apakah kuis sudah pernah diselesaikan
    const isSelesai = @json($isSelesai);

    // Kunci jawaban kuis
    const kunciJawaban = {
        q1: 'D',
        q2: 'C',
        q3: 'B',
        q4: 'A',
        q5: 'E'
    };

    // Fungsi Render Slide
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('d-none', i !== index);
        });
        
        progressText.innerText = `Soal ${index + 1} dari ${totalQuestions}`;
        
        // Atur state tombol Kembali
        if(index === 0) {
            btnPrev.classList.add('d-none');
            btnPrev.style.visibility = 'hidden'; // Menjaga tata letak flexbox
        } else {
            btnPrev.classList.remove('d-none');
            btnPrev.style.visibility = 'visible';
        }

        // Atur state tombol Lanjut
        if(index === totalQuestions - 1) {
            btnNext.classList.add('d-none');
        } else {
            btnNext.classList.remove('d-none');
        }
    }

    // Fungsi menampilkan jawaban benar saat kuis sudah selesai
    function tampilkanJawabanBenar() {
        Object.keys(kunciJawaban).forEach(function(namaSoal) {
            const radioBenar = document.querySelector(
                `input[name="${namaSoal}"][value="${kunciJawaban[namaSoal]}"]`
            );

            if (radioBenar) {
                radioBenar.checked = true;
            }
        });

        // Nonaktifkan semua pilihan jawaban agar tidak bisa diubah lagi
        document.querySelectorAll('#quizActivity input[type="radio"]').forEach(radio => {
            radio.disabled = false;
        });

        // Sembunyikan tombol periksa dan reset
        btnCheck.classList.add('d-none');
        btnReset.classList.remove('d-none');
        btnReset.innerHTML = '<i class="fa-solid fa-rotate-right me-1"></i> Reset Latihan';

        // Tampilkan penjelasan
        tampilkanFeedbackPembahasan();

        // Buka gembok materi
        btnNextMateri.classList.remove('disabled');
        btnNextMateri.removeAttribute('tabindex');
        btnNextMateri.removeAttribute('aria-disabled');
        btnNextMateri.style.pointerEvents = 'auto';
        btnNextMateri.style.opacity = '1';

        if (lockIcon) {
            lockIcon.className = 'fa-solid fa-unlock me-1';
        }
    }

    function tampilkanFeedbackPembahasan() {
        feedback.className = 'alert alert-primary mt-3 shadow-sm py-3 mb-0 fade-in';
        feedback.innerHTML = `
            <h6 class="fw-bold mb-3">
                <i class="fa-solid fa-circle-check me-1"></i>
                Kesimpulan Uji Pemahaman
            </h6>

            <p class="mb-3">
                <strong>Jawaban sudah benar semua.</strong> Berikut pembahasan singkat dari setiap soal:
            </p>

            <ul class="mb-3">
                <li>
                    <strong>Soal 1:</strong> Merge Sort memiliki kompleksitas waktu 
                    <code>O(n log n)</code> pada kondisi worst case, sehingga lebih efisien
                    dibandingkan Bubble Sort, Selection Sort, dan Insertion Sort yang memiliki
                    kompleksitas <code>O(n²)</code>.
                </li>
                <li>
                    <strong>Soal 2:</strong> Kompleksitas <code>O(n²)</code> menunjukkan bahwa
                    waktu eksekusi bertambah secara kuadratik ketika jumlah data semakin besar.
                </li>
                <li>
                    <strong>Soal 3:</strong> <em>Time complexity</em> berkaitan dengan waktu eksekusi,
                    sedangkan <em>space complexity</em> berkaitan dengan penggunaan memori tambahan.
                </li>
                <li>
                    <strong>Soal 4:</strong> Kondisi <em>best case</em> terjadi ketika data sudah
                    terurut atau hampir terurut, sehingga operasi yang dibutuhkan lebih sedikit.
                </li>
                <li>
                    <strong>Soal 5:</strong> Kompleksitas <code>O(n log n)</code> lebih baik untuk
                    data besar karena pertumbuhan jumlah operasinya lebih lambat dibandingkan
                    <code>O(n²)</code>.
                </li>
            </ul>

            <p class="mb-0">
                Dengan demikian, pemahaman terhadap kompleksitas waktu dan ruang penting untuk
                memilih algoritma sorting yang sesuai dengan ukuran dan kondisi data.
            </p>
        `;
        feedback.classList.remove('d-none');
    }

    // Event Tombol Lanjut & Kembali
    btnNext.addEventListener('click', () => {
        if(currentSlide < totalQuestions - 1) {
            currentSlide++;
            showSlide(currentSlide);
        }
    });

    btnPrev.addEventListener('click', () => {
        if(currentSlide > 0) {
            currentSlide--;
            showSlide(currentSlide);
        }
    });

    // Pengecekan apakah semua soal sudah dijawab
    function checkAllAnswered() {
        // if (isSelesai) return;
        const q1Val = document.querySelector('input[name="q1"]:checked');
        const q2Val = document.querySelector('input[name="q2"]:checked');
        const q3Val = document.querySelector('input[name="q3"]:checked');
        const q4Val = document.querySelector('input[name="q4"]:checked');
        const q5Val = document.querySelector('input[name="q5"]:checked');

        // Jika semua terjawab, dan tombol reset sedang tidak aktif (artinya belum di-cek/belum gagal)
        if (q1Val && q2Val && q3Val && q4Val && q5Val && btnReset.classList.contains('d-none')) {
            btnCheck.classList.remove('d-none');
        }
    }

    document.querySelectorAll('#quizActivity input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', checkAllAnswered);
    });

    // Periksa Jawaban
    btnCheck.addEventListener('click', function() {
        // if (isSelesai) return;
        const q1Val = document.querySelector('input[name="q1"]:checked');
        const q2Val = document.querySelector('input[name="q2"]:checked');
        const q3Val = document.querySelector('input[name="q3"]:checked');
        const q4Val = document.querySelector('input[name="q4"]:checked');
        const q5Val = document.querySelector('input[name="q5"]:checked');

        let correctCount = 0;
        if (q1Val.value === kunciJawaban.q1) correctCount++;
        if (q2Val.value === kunciJawaban.q2) correctCount++;
        if (q3Val.value === kunciJawaban.q3) correctCount++;
        if (q4Val.value === kunciJawaban.q4) correctCount++;
        if (q5Val.value === kunciJawaban.q5) correctCount++;

        if (correctCount === totalQuestions) {
            // feedback.className = 'alert alert-success mt-3 shadow-sm text-center py-2 mb-0 small fade-in';
            // feedback.innerHTML = `<i class="fa-solid fa-unlock-keyhole me-1"></i> <strong>Luar Biasa!</strong> (${correctCount}/${totalQuestions}) Benar.`;
            // feedback.classList.remove('d-none');
            tampilkanFeedbackPembahasan();
            
            btnCheck.classList.add('d-none'); // Sembunyikan tombol cek karena sudah benar
            btnReset.innerHTML = '<i class="fa-solid fa-rotate-right me-1"></i> Reset Latihan';

            // Buka gembok materi
            btnNextMateri.classList.remove('disabled');
            btnNextMateri.removeAttribute('tabindex');
            btnNextMateri.removeAttribute('aria-disabled');
            btnNextMateri.style.pointerEvents = 'auto';
            btnNextMateri.style.opacity = '1';

            if (lockIcon) {
                lockIcon.className = 'fa-solid fa-unlock me-1';
            }

            // Simpan progres ke database
            if (!isSelesai) {
                fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({ id_aktivitas: {{ $item->id }} })
                }).catch(err => console.error(err));
            }

        } else {
            // JIKA SALAH
            feedback.className = 'alert alert-danger mt-3 shadow-sm text-center py-2 mb-0 small fade-in';
            feedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation me-1"></i> Anda menjawab ${correctCount} dari ${totalQuestions} soal dengan benar. Silakan ulangi!`;
            feedback.classList.remove('d-none');
            
            // Ganti tombol Periksa dengan tombol Reset
            btnCheck.classList.add('d-none');
            btnReset.classList.remove('d-none');
        }
    });

    // Tombol Reset Jawaban
    btnReset.addEventListener('click', function() {
        // Hilangkan centang dan aktifkan kembali semua radio button
        document.querySelectorAll('#quizActivity input[type="radio"]').forEach(r => {
            r.checked = false;
            r.disabled = false;
        });

        // Hapus alert/feedback
        feedback.classList.add('d-none');
        feedback.innerHTML = '';
        
        // Sembunyikan tombol reset, tombol periksa, dan feedback
        btnReset.classList.add('d-none');
        btnCheck.classList.add('d-none');
        
        // Kembali ke soal nomor 1
        currentSlide = 0;
        showSlide(currentSlide);

        // Materi berikutnya tetap terbuka
        btnNextMateri.classList.remove('disabled');
        btnNextMateri.removeAttribute('tabindex');
        btnNextMateri.removeAttribute('aria-disabled');
        btnNextMateri.style.pointerEvents = 'auto';
        btnNextMateri.style.opacity = '1';

        if (lockIcon) {
            lockIcon.className = 'fa-solid fa-unlock me-1';
        }
    });

    // Inisialisasi tampilan awal
    showSlide(0);

    // Jika kuis sudah selesai, tampilkan jawaban benar dan kunci pilihan
    if (isSelesai) {
        tampilkanJawabanBenar();
    }
});
</script>

@endsection