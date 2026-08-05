@extends('layouts.hlmns')

@section('title','Pendahuluan Sorting')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sorting.css') }}">
@endsection

@section('content')

<!-- ===== Judul Materi dengan Box ===== -->
<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-sort-amount-down"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma Sorting</h3>
            </div>
        </div>
    </div>
</div>

<!-- ===== Tujuan Pembelajaran ===== -->
<div class="materi-page">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tujuan Pembelajaran</h5> 
            <p>Setelah menyelesaikan materi pada bab ini, mahasiswa diharapkan mampu:</p>
            <ul>
                <li>menjelaskan konsep dasar dan kegunaan pengurutan data dalam pencarian data.</li>
                <li>membedakan karakteristik pengurutan secara ascending dan descending. </li>
                <li>Menunjukkan pentingnya efisiensi dan ketepatan dalam proses pengurutan data. </li>
            </ul>
        </div>
    </div>


<!-- ===== SORTING ===== -->
    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">

            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book"></i>
                <span class="materi-badge">Sorting</span>
            </div>
            <p class="card-text text-justify">
                Sorting atau pengurutan merupakan proses fundamental dalam ilmu komputer yang bertujuan untuk menyusun elemen-elemen data ke dalam urutan tertentu. Proses ini penting karena membantu data menjadi lebih terstruktur sehingga lebih mudah dianalisis, dicari, dan diproses oleh komputer. Dalam berbagai sistem komputasi, sorting sering digunakan sebagai langkah awal sebelum dilakukan proses lanjutan seperti pencarian dan analisis data.</br>

                Sorting atau pengurutan merupakan proses fundamental dalam ilmu komputer yang bertujuan untuk menyusun elemen-elemen data ke dalam urutan tertentu. Proses ini penting karena membantu data menjadi lebih terstruktur sehingga lebih mudah dianalisis, dicari, dan diproses oleh komputer. Dalam berbagai sistem komputasi, sorting sering digunakan sebagai langkah awal sebelum dilakukan proses lanjutan seperti pencarian dan analisis data.</br>
                </br>

                Sorting memiliki peran penting dalam berbagai aplikasi komputasi, seperti pengelolaan basis data, sistem pencarian informasi, serta pengolahan dan analisis data. Data yang terurut memungkinkan proses pencarian berjalan lebih cepat dan efisien. Sebaliknya, data yang tidak terurut dapat menyebabkan pencarian menjadi lambat dan menurunkan performa program. Bahkan, beberapa algoritma pencarian tertentu, seperti Binary Search, tidak dapat digunakan tanpa data yang telah diurutkan terlebih dahulu. <br>

                Dalam proses sorting, komputer melakukan serangkaian perbandingan antar elemen untuk menentukan urutan yang benar, serta pertukaran posisi elemen hingga data tersusun sesuai dengan kriteria yang diinginkan. Efisiensi suatu algoritma sorting sangat dipengaruhi oleh jumlah operasi yang dilakukan selama proses ini. Oleh karena itu, berbagai algoritma sorting telah dikembangkan dengan karakteristik dan tingkat efisiensi yang berbeda, mulai dari algoritma sederhana untuk data berukuran kecil hingga algoritma yang lebih kompleks untuk data berukuran besar.
            </p>
        </div>
    </div>

    <!-- ================= AKTIVITAS 1.1 : DRAG & DROP ================= -->
    <div class="card mb-4 materi-box mt-5" id="dragActivity">
        <div class="card-body materi-text">

            <div class="materi-header mb-3">
                <i class="fas fa-hand-pointer"></i>
                <span class="materi-badge">Aktivitas 1.1</span>
            </div>

            <p class="card-text mb-4">
                <strong>Instruksi:</strong> Tarik setiap skenario di bawah ini ke kotak kategori pengurutan yang tepat
                (<em>Ascending</em> atau <em>Descending</em>).
            </p>

            <div class="row g-4">

                <!-- ===== KOLOM ITEM ===== -->
                <div class="col-md-5">
                    <h6 class="fw-semibold mb-3">Skenario</h6>

                    <div class="drag-list" id="dragSource">

                        <div class="drag-item image-only" draggable="true" data-answer="ascending">
                            <img src="/images/sort/1.png" alt="Skenario 1">
                        </div>

                        <div class="drag-item image-only" draggable="true" data-answer="descending">
                            <img src="/images/sort/2.png" alt="Skenario 2">
                        </div>

                        <div class="drag-item image-only" draggable="true" data-answer="descending">
                            <img src="/images/sort/3.png" alt="Skenario 3">
                        </div>

                    </div>
                </div>

                <div class="col-md-7 sorting-zones">
                    <div class="drop-zone" data-zone="ascending">
                        <div class="zone-header">Ascending</div>
                        <div class="zone-content drop-target"></div>
                    </div>

                    <div class="drop-zone" data-zone="descending">
                        <div class="zone-header">Descending</div>
                        <div class="zone-content drop-target"></div>
                    </div>
                </div>




            </div>

            <!-- FEEDBACK -->
            <div id="dragFeedback" class="mt-4 text-center d-none"></div>
            <div class="text-center mt-3">
                <button id="checkAnswerBtn" class="btn btn-primary" disabled>
                    Periksa Jawaban
                </button>

                <button id="resetDragBtn" class="btn btn-outline-secondary">
                    Reset
                </button>
            </div>




        </div>
    </div>

</div>



<!-- ===== CONTOH SEDERHANA ===== -->
<div class="materi-page d-none">
    <div class="card mb-4 materi-box" >
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-play-circle"></i>
                <span class="materi-badge">Contoh Sederhana</span>
            </div>
            <p class="card-text">
                Dalam kehidupan sehari-hari, konsep sorting dapat dianalogikan seperti menyusun tumpukan buku dari edisi paling lama hingga edisi terbaru. Setiap buku mewakili satu elemen data yang harus ditempatkan pada posisi yang tepat agar susunan menjadi rapi dan teratur. Analogi ini menggambarkan bagaimana komputer mengubah data yang awalnya acak menjadi urutan yang terstruktur dan mudah digunakan. Dengan memahami konsep dasar sorting, mahasiswa diharapkan mampu memahami pentingnya pengurutan data sebagai fondasi dalam berbagai proses komputasi dan algoritma pemrograman. 
                <br>
                Untuk memperjelas pemahaman mengenai proses pengurutan data tersebut, selanjutnya disajikan simulasi sederhana yang memperlihatkan tahapan perbandingan dan pertukaran elemen hingga data tersusun sesuai dengan urutan yang diinginkan.
            </p>

            <div class="text-center my-4">
                <img 
                    src="{{ asset('images/buku/tumpukan-buku.png') }}" 
                    alt="Ilustrasi tumpukan buku"
                    class="img-fluid"
                    style="max-width: 200px;"
                >
            </div>

            <div class="d-flex justify-content-center gap-3 mb-3" id="unsorted-books">
                <img src="{{ asset('images/buku/edisi1.png') }}" class="book" data-edisi="1">
                <img src="{{ asset('images/buku/edisi2.png') }}" class="book" data-edisi="2">

                <img id="bukuA" src="{{ asset('images/buku/edisi4.png') }}"
                    class="book swap-target" data-edisi="4">

                <img id="bukuB" src="{{ asset('images/buku/edisi3.png') }}"
                    class="book swap-target" data-edisi="3">

                <img src="{{ asset('images/buku/edisi5.png') }}" class="book" data-edisi="5">
            </div>

            <div class="text-center mb-3">
                <button id="btnSwap"
                    class="btn btn-outline-primary"
                    onclick="swapAndShowSorted()">
                    Tukar Buku
                </button>
            </div>

            {{-- <div class="d-flex justify-content-center gap-3 mb-3" id="sorted-books"></div> --}}

            <p class="card-text">
                Berdasarkan ilustrasi sederhana di atas, dapat disimpulkan bahwa proses pengurutan data melibatkan tahapan perbandingan antar elemen serta pertukaran posisi apabila urutan elemen belum sesuai dengan kriteria yang ditentukan. Meskipun pada simulasi hanya ditunjukkan satu kali proses pertukaran, mekanisme tersebut merupakan prinsip dasar yang digunakan dalam berbagai algoritma sorting. Untuk menilai tingkat efisiensi suatu algoritma dalam melakukan proses pengurutan, diperlukan pemahaman lebih lanjut mengenai kompleksitas algoritma sorting, yang berkaitan dengan jumlah operasi yang dilakukan selama proses tersebut berlangsung.
            </p>
        </div>
    </div>
</div>


<!-- ===== Kompleksitas algoritma sorting ===== -->
<div class="materi-page d-none">
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

<div class="d-flex justify-content-center gap-3 mt-4">

    <button id="btnPrev"
            class="btn btn-outline-secondary"
            onclick="prevMateri()">
        <- Sebelumnya
    </button>

    <button id="btnNext"
            class="btn btn-primary"
            onclick="nextMateri()">
        Selanjutnya ->
    </button>

</div>


<script>

document.addEventListener('DOMContentLoaded', () => {

    let draggedItem = null;

    const dragItems  = document.querySelectorAll('.drag-item');
    const dropZones  = document.querySelectorAll('.drop-zone');
    const feedbackEl = document.getElementById('dragFeedback');
    const checkBtn   = document.getElementById('checkAnswerBtn');
    const resetBtn   = document.getElementById('resetDragBtn');
    const activityBox = document.getElementById('dragActivity');

    /* ========== DRAG ========== */
    dragItems.forEach(item => {
        item.addEventListener('dragstart', e => {
            draggedItem = item;
            e.dataTransfer.setData('text/plain', 'drag');
        });

        item.addEventListener('dragend', () => {
            draggedItem = null;
        });
    });

 
    /* ========== DROP ========== */
   const dropTargets = document.querySelectorAll('.drop-target');

dropTargets.forEach(target => {

    target.addEventListener('dragover', e => {
        e.preventDefault(); // 🔑 KUNCI UTAMA
        target.parentElement.classList.add('active');
    });

    target.addEventListener('dragleave', () => {
        target.parentElement.classList.remove('active');
    });

    target.addEventListener('drop', e => {
        e.preventDefault();
        target.parentElement.classList.remove('active');

        if (!draggedItem) return;
        if (draggedItem.dataset.used === 'true') return;

        const img = draggedItem.querySelector('img').cloneNode(true);
        img.classList.add('dropped-image');
        img.dataset.answer = draggedItem.dataset.answer;

        target.appendChild(img);

        // 🔒 kunci item asal
        draggedItem.dataset.used = 'true';
        draggedItem.draggable = false;
        draggedItem.style.opacity = '0.4';
        draggedItem.style.cursor = 'not-allowed';

        checkBtn.disabled = false;
    });
});



    /* ========== CEK JAWABAN ========== */
    checkBtn.addEventListener('click', () => {
        let correct = 0;
        let total   = 0;

        dropZones.forEach(zone => {
            const imgs = zone.querySelectorAll('img.dropped-image');
            total += imgs.length;

            imgs.forEach(img => {
                img.classList.remove('correct','wrong');
                if (img.dataset.answer === zone.dataset.zone) {
                    img.classList.add('correct');
                    correct++;
                } else {
                    img.classList.add('wrong');
                }
            });
        });

        feedbackEl.innerHTML =
            `<div class="alert alert-success py-3 mb-0">
                Hasil: benar <b>${correct}</b> dari <b>${total}</b> 
             </div>`;
        feedbackEl.classList.remove('d-none');

                if (correct === totalItems) {
            activityBox.classList.add('completed');
        }

    });

    /* ========== RESET ========== */
resetBtn.addEventListener('click', () => {

    // hapus semua hasil drop
    document.querySelectorAll('.dropped-image')
        .forEach(img => img.remove());

    // buka kembali semua item drag
    document.querySelectorAll('.drag-item').forEach(item => {
        item.dataset.used = 'false';
        item.draggable = true;
        item.style.opacity = '';
        item.style.cursor = 'grab';
    });

    // reset tampilan & state
    activityBox.classList.remove('completed');
    feedbackEl.innerHTML = '';
    feedbackEl.classList.add('d-none');
    checkBtn.disabled = true;
});


});


let sedangTertukar = false;

function swapAndShowSorted() {
    const btn = document.getElementById('btnSwap');
    const a = document.getElementById('bukuA');
    const b = document.getElementById('bukuB');

    if (!a || !b || btn.disabled) return;

    // Kunci tombol agar tidak diklik selama animasi berjalan
    btn.disabled = true;

    // 1. Hitung jarak antara buku A dan buku B
    const rectA = a.getBoundingClientRect();
    const rectB = b.getBoundingClientRect();
    const dx = rectB.left - rectA.left;

    // 2. Tambahkan class untuk z-index agar buku di atas
    a.classList.add('swap-active');
    b.classList.add('swap-active');

    // 3. Jalankan efek meluncur (Transform)
    a.style.transform = `translateX(${dx}px)`;
    b.style.transform = `translateX(${-dx}px)`;

    // 4. Tunggu animasi selesai sebelum menukar konten
    setTimeout(() => {
        // Matikan transisi agar saat reset transform tidak terlihat meluncur balik
        a.style.transition = 'none';
        b.style.transition = 'none';

        // TUKAR ISI GAMBAR DAN DATA (Seperti cara awal Anda)
        const tempSrc = a.src;
        a.src = b.src;
        b.src = tempSrc;

        const tempEdisi = a.dataset.edisi;
        a.dataset.edisi = b.dataset.edisi;
        b.dataset.edisi = tempEdisi;

        // Reset posisi transform ke 0 secara instan (karena transition sudah none)
        a.style.transform = '';
        b.style.transform = '';

        // Berikan jeda kecil sebelum mengaktifkan kembali transisi dan tombol
        setTimeout(() => {
            a.style.transition = ''; // Kembalikan transisi untuk penggunaan berikutnya
            b.style.transition = '';
            a.classList.remove('swap-active');
            b.classList.remove('swap-active');
            btn.disabled = false;
        }, 50);

    }, 600); // Harus sama dengan durasi transition di CSS (0.6s)
}
document.addEventListener('DOMContentLoaded', function () {

    const materiPages = document.querySelectorAll('.materi-page');
    if (materiPages.length === 0) return; 

    const submenuPages = document.querySelectorAll('.submenu-page');

    let materiIndex = 0;

    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');

    function updateSidebarActive(index) {
        submenuPages.forEach(link => {
            link.classList.toggle(
                'active-sub',
                Number(link.dataset.index) === index
            );
        });
    }

    function tampilMateri(i) {
        materiPages.forEach((page, idx) => {
            page.classList.toggle('d-none', idx !== i);
        });

        materiIndex = i;
        updateSidebarActive(i);   // 🔥 INI KUNCINYA
        updateButtonState();

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function updateButtonState() {
        if (btnPrev) btnPrev.disabled = materiIndex === 0;
        if (btnNext) btnNext.disabled = materiIndex === materiPages.length - 1;
    }

    window.goMateri = function(i){
        tampilMateri(i);
    }

    window.nextMateri = function(){
        if (materiIndex < materiPages.length - 1) {
            tampilMateri(materiIndex + 1);
        }
    }

    window.prevMateri = function(){
        if (materiIndex > 0) {
            tampilMateri(materiIndex - 1);
        }
    }

    // init
    tampilMateri(0);
});
</script>
@endsection
