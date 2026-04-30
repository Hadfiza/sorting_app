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

                <!-- SOAL 1 -->
                <div class="mb-4" id="q1-container">
                    <p class="fw-semibold mb-2">
                        1. Algoritma sorting manakah di bawah ini yang memiliki kompleksitas waktu <em>worst case</em> paling efisien, yaitu sebesar O(n log n)?
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" value="A">
                        <label class="form-check-label">a. Bubble Sort</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" value="B">
                        <label class="form-check-label">b. Selection Sort</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" value="C">
                        <label class="form-check-label">c. Insertion Sort</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" value="D">
                        <label class="form-check-label">d. Merge Sort</label>
                    </div>
                </div>

                <!-- SOAL 2 -->
                <div class="mb-4 d-none" id="q2-container">
                    <p class="fw-semibold mb-2">
                        2. Apa arti dari kompleksitas waktu O(n²) yang dimiliki oleh Insertion Sort pada <em>worst case</em>?
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="A">
                        <label class="form-check-label">
                            a. Waktu bertambah secara konstan meskipun data bertambah
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="B">
                        <label class="form-check-label">
                            b. Waktu bertambah sebanding dengan jumlah data
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="C">
                        <label class="form-check-label">
                            c. Waktu eksekusi bertambah secara kuadratik, kurang efisien untuk data besar
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="D">
                        <label class="form-check-label">
                            d. Waktu eksekusi selalu tetap untuk semua ukuran data
                        </label>
                    </div>
                </div>

                <!-- SOAL 3 -->
                <div class="mb-4 d-none" id="q3-container">
                    <p class="fw-semibold mb-2">
                        3. Manakah pernyataan yang paling tepat mengenai perbedaan antara <em>Time Complexity</em> dan <em>Space Complexity</em>?
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="A">
                        <label class="form-check-label">
                            a. Time complexity mengukur jumlah baris kode, sedangkan space complexity mengukur jumlah variabel.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="B">
                        <label class="form-check-label">
                            b. Time complexity mengukur efisiensi waktu eksekusi seiring bertambahnya data, sedangkan space complexity mengukur penggunaan memori tambahan.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="C">
                        <label class="form-check-label">
                            c. Time complexity selalu bernilai O(n), sedangkan space complexity selalu bernilai O(1).
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="D">
                        <label class="form-check-label">
                            d. Space complexity lebih penting daripada time complexity dalam pengolahan data besar (Big Data).
                        </label>
                    </div>
                </div>

                <!-- SOAL 4 -->
                <div class="mb-4 d-none" id="q4-container">
                    <p class="fw-semibold mb-2">
                        4. Sebuah algoritma pengurutan dikatakan memiliki efisiensi terbaik pada kondisi <em>Best Case</em> O(n) jika:
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="A">
                        <label class="form-check-label">
                            a. Data masukan sudah terurut secara benar sebelum proses dimulai.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="B">
                        <label class="form-check-label">
                            b. Data masukan terurut secara terbalik (descending).
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="C">
                        <label class="form-check-label">
                            c. Data masukan memiliki nilai yang semuanya sama.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="D">
                        <label class="form-check-label">
                            d. Algoritma menggunakan memori tambahan yang sangat besar.
                        </label>
                    </div>
                </div>

                <!-- SOAL 5 -->
                <div class="mb-4 d-none" id="q5-container">
                    <p class="fw-semibold mb-2">
                        5. Mengapa algoritma dengan kompleksitas O(n log n) dianggap lebih baik untuk data berukuran besar dibandingkan O(n²)?
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="A">
                        <label class="form-check-label">
                            a. Karena O(n log n) membutuhkan lebih banyak memori daripada O(n²).
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="B">
                        <label class="form-check-label">
                            b. Karena jumlah operasi pada O(n log n) tumbuh jauh lebih lambat dibandingkan pertumbuhan kuadratik pada O(n²).
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="C">
                        <label class="form-check-label">
                            c. Karena O(n log n) hanya bisa digunakan pada algoritma Iterative, bukan Recursive.
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="D">
                        <label class="form-check-label">
                            d. Karena O(n²) hanya berlaku untuk algoritma Merge Sort.
                        </label>
                    </div>
                </div>

            </div>

            <div id="quizFeedback" class="alert d-none mt-3"></div>
            <div class="text-start mt-3">
                <button id="btnCheckQuiz" class="btn btn-primary d-none">
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

    // =========================
    // STEP SOAL (MUNCUL BERTAHAP)
    // =========================
    const q1 = document.querySelectorAll('input[name="q1"]');
    const q2 = document.querySelectorAll('input[name="q2"]');
    const q3 = document.querySelectorAll('input[name="q3"]');
    const q4 = document.querySelectorAll('input[name="q4"]');
    const q5 = document.querySelectorAll('input[name="q5"]');

    q1.forEach(i => i.addEventListener('change', () => {
        document.getElementById('q2-container').classList.remove('d-none');
    }));

    q2.forEach(i => i.addEventListener('change', () => {
        document.getElementById('q3-container').classList.remove('d-none');
    }));

    q3.forEach(i => i.addEventListener('change', () => {
        document.getElementById('q4-container').classList.remove('d-none');
    }));

    q4.forEach(i => i.addEventListener('change', () => {
        document.getElementById('q5-container').classList.remove('d-none');
    }));

    // =========================
    // TOMBOL MUNCUL SETELAH SEMUA TERJAWAB
    // =========================
    function checkAllAnswered() {
        const q1Val = document.querySelector('input[name="q1"]:checked');
        const q2Val = document.querySelector('input[name="q2"]:checked');
        const q3Val = document.querySelector('input[name="q3"]:checked');
        const q4Val = document.querySelector('input[name="q4"]:checked');
        const q5Val = document.querySelector('input[name="q5"]:checked');

        if (q1Val && q2Val && q3Val && q4Val && q5Val) {
            btnCheck.classList.remove('d-none');
        }
    }

    // pasang ke semua radio
    document.querySelectorAll('input[type="radio"]').forEach(i => {
        i.addEventListener('change', checkAllAnswered);
    });

    // =========================
    // HITUNG TOTAL SOAL
    // =========================
    const totalQuestions = document.querySelectorAll('.quiz-container > div').length;

    // =========================
    // CEK JAWABAN
    // =========================
    btnCheck.addEventListener('click', function() {

        const q1Val = document.querySelector('input[name="q1"]:checked');
        const q2Val = document.querySelector('input[name="q2"]:checked');
        const q3Val = document.querySelector('input[name="q3"]:checked');
        const q4Val = document.querySelector('input[name="q4"]:checked');
        const q5Val = document.querySelector('input[name="q5"]:checked');

        if (!q1Val || !q2Val || !q3Val || !q4Val || !q5Val) {
            feedback.className = 'alert alert-warning mt-3';
            feedback.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Harap jawab semua soal!';
            feedback.classList.remove('d-none');
            return;
        }

        let correctCount = 0;

        if (q1Val.value === 'D') correctCount++;
        if (q2Val.value === 'C') correctCount++;
        if (q3Val.value === 'B') correctCount++;
        if (q4Val.value === 'A') correctCount++;
        if (q5Val.value === 'B') correctCount++;

        if (correctCount === totalQuestions) {

            feedback.className = 'alert alert-success mt-3';
            feedback.innerHTML = `<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Semua benar (${correctCount}/${totalQuestions})`;
            feedback.classList.remove('d-none');

            // unlock tombol next
            btnNext.classList.remove('disabled');
            btnNext.removeAttribute('tabindex');
            btnNext.removeAttribute('aria-disabled');
            btnNext.style.pointerEvents = 'auto';
            btnNext.style.opacity = '1';
            lockIcon.className = 'fa-solid fa-unlock me-1';

            // simpan progress
            fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    id_aktivitas: {{ $item->id }}
                })
            })
            .then(res => res.json())
            .then(data => console.log("Progress:", data))
            .catch(err => console.error(err));

        } else {
            feedback.className = 'alert alert-danger mt-3';
            feedback.innerHTML = `<i class="fa-solid fa-circle-xmark"></i> ${correctCount}/${totalQuestions} benar`;
            feedback.classList.remove('d-none');
        }

    });

});
</script>

@endsection