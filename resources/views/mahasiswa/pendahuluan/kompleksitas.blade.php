@extends('layouts.hlmns')

@section('title','Kompleksitas Algoritma')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sorting.css') }}">
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
            <br>
            <ul>
                <li><strong>O(n) </strong> : waktu bertambah sebanding dengan jumlah data.</li>
                <li><strong>O(n log n) </strong> : lebih efisien daripada O(n²), umum pada algoritma divide and conquer. </li>
                <li><strong>O(n²) </strong> : waktu bertambah kuadrat, tidak efisien untuk data besar.  </li>
                <li><strong>O(log n) </strong> : umum pada operasi berbasis pohon dan rekursi. </li>
            </ul>
        </div>
    </div>

    <div class="card mb-4 materi-box mt-4" id="quizActivity">
        <div class="card-body materi-text">

            <div class="materi-header mb-3">
                <i class="fas fa-tasks"></i>
                <span class="materi-badge">Aktivitas 1.2: Uji Pemahaman</span>
            </div>

            <p class="card-text mb-4 text-danger fw-bold">
                <i class="fa-solid fa-lock me-1"></i> Jawablah pertanyaan berikut dengan benar untuk membuka akses ke materi selanjutnya!
            </p>

            <div class="quiz-container">
                <div class="mb-4">
                    <p class="fw-semibold mb-2">1. Algoritma sorting manakah di bawah ini yang memiliki kompleksitas waktu <em>Worst Case</em> yang paling efisien, yaitu sebesar <strong>O(n log n)</strong>?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" id="q1a" value="Bubble Sort">
                        <label class="form-check-label" for="q1a">Bubble Sort</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" id="q1b" value="Selection Sort">
                        <label class="form-check-label" for="q1b">Selection Sort</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" id="q1c" value="Merge Sort">
                        <label class="form-check-label" for="q1c">Merge Sort</label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="fw-semibold mb-2">2. Apa arti dari kompleksitas waktu <strong>O(n²)</strong> yang dimiliki oleh Insertion Sort pada <em>Worst Case</em>?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" id="q2a" value="Waktu bertambah sebanding dengan jumlah data">
                        <label class="form-check-label" for="q2a">Waktu bertambah sebanding dengan jumlah data</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" id="q2b" value="Waktu eksekusi bertambah secara kuadratik, kurang efisien untuk data besar">
                        <label class="form-check-label" for="q2b">Waktu eksekusi bertambah secara kuadratik, kurang efisien untuk data besar</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" id="q2c" value="Sangat efisien untuk mengurutkan jutaan data">
                        <label class="form-check-label" for="q2c">Sangat efisien untuk mengurutkan jutaan data</label>
                    </div>
                </div>
            </div>

            <div id="quizFeedback" class="alert d-none mt-3"></div>
            <div class="text-start mt-3">
                <button id="btnCheckQuiz" class="btn btn-primary">
                    <i class="fa-solid fa-check-double me-1"></i> Periksa Jawaban
                </button>
            </div>

        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','sorting']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','quiz']) }}" 
       class="btn btn-success disabled" id="btnNextMateri" tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;">
        <i class="fa-solid fa-lock me-1" id="lockIcon"></i> Selanjutnya
    </a>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCheck = document.getElementById('btnCheckQuiz');
    const feedback = document.getElementById('quizFeedback');
    const btnNext = document.getElementById('btnNextMateri');
    const lockIcon = document.getElementById('lockIcon');

    btnCheck.addEventListener('click', function() {
        // Ambil jawaban yang dipilih mahasiswa
        const q1 = document.querySelector('input[name="q1"]:checked');
        const q2 = document.querySelector('input[name="q2"]:checked');

        // Validasi jika ada yang belum dijawab
        if (!q1 || !q2) {
            feedback.className = 'alert alert-warning mt-3';
            feedback.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Harap pilih jawaban untuk semua soal terlebih dahulu!';
            feedback.classList.remove('d-none');
            return;
        }

        // Cek Kebenaran (Kunci Jawaban: Q1 = Merge Sort, Q2 = Waktu eksekusi bertambah...)
        let correctCount = 0;
        if (q1.value === 'Merge Sort') correctCount++;
        if (q2.value === 'Waktu eksekusi bertambah secara kuadratik, kurang efisien untuk data besar') correctCount++;

        // Tampilkan hasil
        if (correctCount === 2) {
            // JIKA BENAR SEMUA
            feedback.className = 'alert alert-success mt-3';
            feedback.innerHTML = '<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Semua jawaban Anda benar. Tombol Selanjutnya telah dibuka.';
            feedback.classList.remove('d-none');
            
            // Buka gembok tombol Selanjutnya
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto'; // Aktifkan klik
            btnNext.style.opacity = '1';          // Normalkan warna
            lockIcon.className = 'fa-solid fa-unlock me-1'; // Ganti icon gembok terbuka

        } else {
            // JIKA ADA YANG SALAH
            feedback.className = 'alert alert-danger mt-3';
            feedback.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> <strong>Kurang Tepat!</strong> Ada jawaban yang masih salah. Silakan perhatikan kembali tabel dan penjelasan di atas.';
            feedback.classList.remove('d-none');
        }
    });
});
</script>

@endsection