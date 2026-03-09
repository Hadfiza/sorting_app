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

<!-- ===== Kompleksitas algoritma sorting ===== -->
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
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">

    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','sorting']) }}" 
       class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','quiz']) }}" 
       class="btn btn-primary">
        Selanjutnya
    </a>

</div>

@endsection