@extends('layouts.hlmns')

@section('title','Pendahuluan Sorting')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sorting.css') }}">
@endsection

@section('content')

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

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">

            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book"></i>
                <span class="materi-badge">Sorting</span>
            </div>
            <p class="card-text text-justify">
                Sorting atau pengurutan merupakan proses fundamental dalam ilmu komputer yang bertujuan untuk menyusun elemen-elemen data ke dalam urutan tertentu. Proses ini penting karena membantu data menjadi lebih terstruktur sehingga lebih mudah dianalisis, dicari, dan diproses oleh komputer. Dalam berbagai sistem komputasi, sorting sering digunakan sebagai langkah awal sebelum dilakukan proses lanjutan seperti pencarian dan analisis data.</br></br>

                Sorting memiliki peran penting dalam berbagai aplikasi komputasi, seperti pengelolaan basis data, sistem pencarian informasi, serta pengolahan dan analisis data. Data yang terurut memungkinkan proses pencarian berjalan lebih cepat dan efisien. Sebaliknya, data yang tidak terurut dapat menyebabkan pencarian menjadi lambat dan menurunkan performa program. Bahkan, beberapa algoritma pencarian tertentu, seperti Binary Search, tidak dapat digunakan tanpa data yang telah diurutkan terlebih dahulu. <br><br>

                Dalam proses sorting, komputer melakukan serangkaian perbandingan antar elemen untuk menentukan urutan yang benar, serta pertukaran posisi elemen hingga data tersusun sesuai dengan kriteria yang diinginkan. Efisiensi suatu algoritma sorting sangat dipengaruhi oleh jumlah operasi yang dilakukan selama proses ini. Oleh karena itu, berbagai algoritma sorting telah dikembangkan dengan karakteristik dan tingkat efisiensi yang berbeda, mulai dari algoritma sederhana untuk data berukuran kecil hingga algoritma yang lebih kompleks untuk data berukuran besar.
            </p>
        </div>
    </div>

    <div class="card mb-4 materi-box" >
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-play-circle"></i>
                <span class="materi-badge">Contoh Sederhana</span>

                <i class="fas fa-circle-info text-secondary ms-2"
                data-bs-toggle="tooltip"
                data-bs-placement="right"
                title="Bacalah materi dan amati ilustrasi berikut. Perhatikan urutan buku yang belum sesuai, lalu klik Tukar Buku untuk mengamati proses pertukaran elemen pada sorting.">
                </i>
            </div>

            <p class="card-text">
                Dalam kehidupan sehari-hari, konsep sorting dapat dianalogikan seperti menyusun tumpukan buku dari edisi paling lama hingga edisi terbaru. Setiap buku mewakili satu elemen data yang harus ditempatkan pada posisi yang tepat agar susunan menjadi rapi dan teratur. Analogi ini menggambarkan bagaimana komputer mengubah data yang awalnya acak menjadi urutan yang terstruktur dan mudah digunakan. Dengan memahami konsep dasar sorting, mahasiswa diharapkan mampu memahami pentingnya pengurutan data sebagai fondasi dalam berbagai proses komputasi dan algoritma pemrograman. 
                <br>
                Untuk memperjelas pemahaman mengenai proses pengurutan data tersebut, selanjutnya disajikan simulasi sederhana yang memperlihatkan tahapan perbandingan dan pertukaran elemen hingga data tersusun sesuai dengan urutan yang diinginkan.
            </p>

            <div class="text-center">
                <img 
                    src="{{ asset('images/buku/tumpukan-buku.png') }}" 
                    alt="Ilustrasi tumpukan buku"
                    class="img-fluid"
                    style="max-width: 200px;"><br>
                    <span style="font-size: 0.85rem; color: #6c757d;">
                        Gambar 1.1 Tumpukan Buku
                    </span>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-2 mt-2 mb-3" id="unsorted-books">
                <img src="{{ asset('images/buku/edisi1.png') }}" class="book" data-edisi="1">
                <img src="{{ asset('images/buku/edisi2.png') }}" class="book" data-edisi="2">

                <img id="bukuA" src="{{ asset('images/buku/edisi4.png') }}"
                    class="book swap-target" data-edisi="4">

                <img id="bukuB" src="{{ asset('images/buku/edisi3.png') }}"
                    class="book swap-target" data-edisi="3">

                <img src="{{ asset('images/buku/edisi5.png') }}" class="book" data-edisi="5">
            </div>

            {{-- <span style="font-size: 0.85rem; color: #6c757d; text-align:center;">
                Gambar 1.2 Kumpulan buka yang diurtukan
            </span> --}}

            <div class="text-center mb-2">
                <small class="text-primary">
                Klik <strong>Tukar Buku</strong> untuk melihat proses sorting
                </small>
            </div>

            <div class="text-center mb-3">
                <button id="btnSwap"
                    class="btn btn-outline-primary"
                    onclick="swapAndShowSorted()">
                    Tukar Buku
                </button>
            </div>

            <p class="card-text">
                Berdasarkan ilustrasi sederhana di atas, dapat disimpulkan bahwa proses pengurutan data melibatkan tahapan perbandingan antar elemen serta pertukaran posisi apabila urutan elemen belum sesuai dengan kriteria yang ditentukan. Meskipun pada simulasi hanya ditunjukkan satu kali proses pertukaran, mekanisme tersebut merupakan prinsip dasar yang digunakan dalam berbagai algoritma sorting. Untuk menilai tingkat efisiensi suatu algoritma dalam melakukan proses pengurutan, diperlukan pemahaman lebih lanjut mengenai kompleksitas algoritma sorting, yang berkaitan dengan jumlah operasi yang dilakukan selama proses tersebut berlangsung.
            </p>
        </div>
    </div>

    <div class="card mb-3 materi-box mt-1" id="dragActivity">
        <div class="card-body materi-text">

            <div class="materi-header mb-1">
                <i class="fas fa-hand-pointer"></i>
                <span class="materi-badge">Aktivitas 1.1</span>
            </div>

            <p class="card-text mb-1 text-dark fw-bold">
                <i class="fa-solid fa-lock me-1"></i> Selesaikan aktivitas berikut dengan benar semua untuk membuka akses ke materi selanjutnya!
            </p>

            <p class="card-text mb-1">
                <strong>Instruksi:</strong> Analisis setiap gambar skenario, kemudian tarik dan lepaskan gambar tersebut ke kategori yang tepat
                (<em>Ascending</em> atau <em>Descending</em>).
            </p>
            
            <div class="row g-2">

                <!-- SUMBER GAMBAR -->
                <div class="col-12" id="kolomSumber">
                    <h6 class="fw-semibold mb-2">Skenario</h6>

                    <div class="drag-list" id="dragSource">
                        <div class="drag-item image-only" draggable="true" data-answer="ascending">
                            <img src="/images/sort/1.png" alt="Skenario 1">
                        </div>

                        <div class="drag-item image-only" draggable="true" data-answer="descending">
                            <img src="/images/sort/2.png" alt="Skenario 2">
                        </div>

                        <div class="drag-item image-only" draggable="true" data-answer="descending">
                            <img src="/images/sort/4.png" alt="Skenario 3">
                        </div>
                    </div>
                </div>

                <!-- TARGET -->
                <div class="col-12" id="kolomTarget">

                    <div class="sorting-zones">

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

        </div>

            <div id="dragFeedback" class="mt-4 text-center d-none"></div>
            <div class="text-center mt-3">
                <button id="checkAnswerBtn" class="btn btn-primary" disabled>
                    <i class="fa-solid fa-check-double me-1"></i> Periksa Jawaban
                </button>

                <button id="resetDragBtn" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-rotate-right me-1"></i> Reset
                </button>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">
        Sebelumnya
    </a>

    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','kompleksitas']) }}" 
       class="btn btn-success disabled" id="btnNextMateri" tabindex="-1" aria-disabled="true" style="pointer-events: none; opacity: 0.5;">
        <i class="fa-solid fa-lock me-1" id="lockIcon"></i> Selanjutnya
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    let draggedItem = null;
    const isSelesai = @json($isSelesai);

    const dragItems  = document.querySelectorAll('.drag-item');
    const dropZones  = document.querySelectorAll('.drop-zone');
    const feedbackEl = document.getElementById('dragFeedback');
    const checkBtn   = document.getElementById('checkAnswerBtn');
    const resetBtn   = document.getElementById('resetDragBtn');
    const activityBox = document.getElementById('dragActivity');
    
    // Element untuk tombol Kunci dan Kolom Grid Bootstrap
    const btnNext = document.getElementById('btnNextMateri');
    const lockIcon = document.getElementById('lockIcon');
    const kolomSumber = document.getElementById('kolomSumber');
    const kolomTarget = document.getElementById('kolomTarget');
    const totalItems = dragItems.length; 

    function bukaTombolNext() {
        btnNext.classList.remove('disabled');
        btnNext.removeAttribute('tabindex');
        btnNext.removeAttribute('aria-disabled');
        btnNext.style.pointerEvents = 'auto';
        btnNext.style.opacity = '1';
        lockIcon.className = 'fa-solid fa-unlock me-1';
    }

    function tampilkanJawabanBenar() {
        document.querySelectorAll('.dropped-image').forEach(img => img.remove());

        dragItems.forEach(item => {
            const targetZone = document.querySelector(
                `.drop-zone[data-zone="${item.dataset.answer}"] .drop-target`
            );

            if (!targetZone) return;

            const img = item.querySelector('img').cloneNode(true);
            img.classList.add('dropped-image', 'correct');
            img.dataset.answer = item.dataset.answer;
            img.style.pointerEvents = 'none';

            targetZone.appendChild(img);

            item.style.display = 'none';
            item.draggable = false;
            item.dataset.used = 'true';
        });

        kolomSumber.classList.add('d-none');
    }

    /* ========== CEK PROGRESS DARI DATABASE ========== */
    if (isSelesai) {

        activityBox.classList.add('completed');
        bukaTombolNext();
        tampilkanJawabanBenar();

        feedbackEl.className = 'alert alert-success py-3 mb-0 mt-3';
        feedbackEl.innerHTML = `
            <i class="fa-solid fa-unlock-keyhole"></i>
            <strong>Aktivitas telah diselesaikan sebelumnya.</strong>
            Jawaban benar ditampilkan kembali.
        `;
        feedbackEl.classList.remove('d-none');

        checkBtn.disabled = true;
    }

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
            e.preventDefault(); 
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
            img.style.pointerEvents = 'none'; 

            target.appendChild(img);

            draggedItem.dataset.used = 'true';
            draggedItem.draggable = false;
            draggedItem.classList.add('used');
            draggedItem.style.display = 'none'; 

            // Cek jumlah gambar yang sudah di-drop
            const droppedCount = document.querySelectorAll('.dropped-image').length;
            
            // Nyalakan tombol cek jawaban hanya ketika minimal 1 item didrop
            checkBtn.disabled = false;

            // --- LOGIKA BARU: LEBARKAN SAAT SEMUA SUDAH DIDROP ---
            if (droppedCount === totalItems) {
                kolomSumber.classList.add('d-none'); // Sembunyikan sumber
                // kolomTarget.classList.remove('col-md-7'); 
                // kolomTarget.classList.add('col-md-12'); // Jadikan full 100%
            }
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

        if (total < totalItems) {
            feedbackEl.className = 'alert alert-warning py-3 mb-0 mt-3';
            feedbackEl.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Harap masukkan semua skenario (${total}/${totalItems}) terlebih dahulu!`;
            feedbackEl.classList.remove('d-none');
            return;
        }

        if (correct === totalItems) {
            feedbackEl.className = 'alert alert-success py-3 mb-0 mt-3';
            feedbackEl.innerHTML = `<i class="fa-solid fa-unlock-keyhole"></i> <strong>Luar Biasa!</strong> Semua klasifikasi benar (${correct}/${totalItems}). Tombol Selanjutnya telah dibuka.`;
            feedbackEl.classList.remove('d-none');
            activityBox.classList.add('completed');

            // Buka tombol next
            bukaTombolNext();

            // SIMPAN PROGRESS
            fetch("{{ route('mahasiswa.aktivitas.tandai_selesai') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    id_aktivitas: {{ $item->id }} // Mengirim ID aktivitas saat ini
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Progress tersimpan:", data);
            })
            .catch(error => console.error("Error:", error));

        } else {
            feedbackEl.className = 'alert alert-danger py-3 mb-0 mt-3';
            feedbackEl.innerHTML = `<i class="fa-solid fa-circle-xmark"></i> <strong>Kurang Tepat!</strong> Ada klasifikasi yang salah (Benar: ${correct}/${totalItems}). Silakan klik Reset dan coba lagi.`;
            feedbackEl.classList.remove('d-none');
        }
    });

    /* ========== RESET ========== */
    resetBtn.addEventListener('click', () => {
        document.querySelectorAll('.dropped-image').forEach(img => img.remove());

        document.querySelectorAll('.drag-item').forEach(item => {
            item.dataset.used = 'false';
            item.draggable = true;
            item.classList.remove('used');
            item.style.display = ''; 
            item.style.opacity = '';
            item.style.cursor = 'grab';
        });

        activityBox.classList.remove('completed');
        feedbackEl.innerHTML = '';
        feedbackEl.classList.add('d-none');
        checkBtn.disabled = true;

        // --- KEMBALIKAN UKURAN KOLOM SEPERTI SEMULA ---
        kolomSumber.classList.remove('d-none'); 
        // kolomTarget.classList.remove('col-md-12'); 
        // kolomTarget.classList.add('col-md-7'); 

        // Jangan kunci lagi jika aktivitas sudah pernah selesai
        if (!isSelesai) {
            btnNext.classList.add('disabled');
            btnNext.setAttribute('tabindex', '-1');
            btnNext.setAttribute('aria-disabled', 'true');
            btnNext.style.pointerEvents = 'none';
            btnNext.style.opacity = '0.5';

            lockIcon.className = 'fa-solid fa-lock me-1';
        } else {
            activityBox.classList.add('completed');
            bukaTombolNext();
            tampilkanJawabanBenar();

            feedbackEl.className = 'alert alert-success py-3 mb-0 mt-3';
            feedbackEl.innerHTML = `
                <i class="fa-solid fa-unlock-keyhole"></i>
                <strong>Aktivitas telah diselesaikan sebelumnya.</strong>
                Jawaban benar ditampilkan kembali.
            `;
            feedbackEl.classList.remove('d-none');
        }
    });

    //Tooltip
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].forEach(el => {
        new bootstrap.Tooltip(el);
    });
});

MobileDragDrop.polyfill({
    dragImageTranslateOverride:
    MobileDragDrop.scrollBehaviourDragImageTranslateOverride
});

/* auto scroll saat drag dekat tepi layar */
window.addEventListener('dragover', function(e) {

    const y = e.clientY;
    const height = window.innerHeight;

    if (y > height - 120) {
        window.scrollBy(0, 15);
    }

    if (y < 120) {
        window.scrollBy(0, -15);
    }

});

/* efek dragging */
document.addEventListener('dragstart', function(e) {
    if (e.target.classList.contains('drag-item')) {
        e.target.classList.add('dragging');
    }
});

document.addEventListener('dragend', function(e) {
    if (e.target.classList.contains('drag-item')) {
        e.target.classList.remove('dragging');
    }
});

/* ========== ANIMASI TUKAR BUKU ========== */
let sedangTertukar = false;

function swapAndShowSorted() {
    const btn = document.getElementById('btnSwap');
    const a = document.getElementById('bukuA');
    const b = document.getElementById('bukuB');

    if (!a || !b || btn.disabled) return;

    btn.disabled = true;

    const rectA = a.getBoundingClientRect();
    const rectB = b.getBoundingClientRect();
    const dx = rectB.left - rectA.left;

    a.classList.add('swap-active');
    b.classList.add('swap-active');

    a.style.transform = `translateX(${dx}px)`;
    b.style.transform = `translateX(${-dx}px)`;

    setTimeout(() => {
        a.style.transition = 'none';
        b.style.transition = 'none';

        const tempSrc = a.src;
        a.src = b.src;
        b.src = tempSrc;

        const tempEdisi = a.dataset.edisi;
        a.dataset.edisi = b.dataset.edisi;
        b.dataset.edisi = tempEdisi;

        a.style.transform = '';
        b.style.transform = '';

        setTimeout(() => {
            a.style.transition = ''; 
            b.style.transition = '';
            a.classList.remove('swap-active');
            b.classList.remove('swap-active');
            btn.disabled = false;
        }, 50);

    }, 600); 
}
</script>
@endsection