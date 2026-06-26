<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quiz Selection Sort</title>
    
    <!-- Ganti CDN Tailwind ke Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
    body {
        background-color: #f0f7ff;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #1e293b;
    }

    /* === CUSTOM UTILITIES PENGGANTI TAILWIND === */
    .rounded-4 { border-radius: 1rem !important; }
    .tracking-widest { letter-spacing: 0.1em; }
    .border-dashed { border-style: dashed !important; border-width: 2px !important; }
    
    /* Class spesifik yang dipakai oleh JavaScript Drag & Drop (Jangan dihapus) */
    .bg-slate-50 { background-color: #f8fafc !important; }
    .bg-blue-50 { background-color: #eff6ff !important; }
    
    /* Input di Essay */
    .essay-input {
        display: inline-block;
        width: 6rem;
        margin: 0 0.25rem;
        background-color: transparent;
        color: inherit;
        border: none;
        border-bottom: 2px solid #000;
        outline: none;
        text-align: center;
        font-weight: bold;
        font-size: 1rem; /* tambahkan ini */
    }
    .essay-input:focus { border-color: #000; }

    /* Pilihan Ganda & True False */
    .option-box { 
        display: block; 
        padding: 6px; 
        border: 1px solid #dee2e6; 
        border-radius: 12px; 
        margin-bottom: 5px; 
        cursor: pointer; 
        transition: 0.2s; 
    }
    .option-box:hover { background-color: #f8fafc; border-color: #adb5bd; }
    input[type="radio"]:checked + span { font-weight: bold; color: #0d6efd; }
    
    /* Drag & Drop Helpers */
    .drag-item {
        width: 4rem; height: 4rem;
        background-color: #0d6efd; color: white;
        border-radius: 0.75rem;
        display: flex; align-items: center; justify-content: center;
        font-weight: bold; font-size: 1.5rem;
        cursor: move;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    .drop-zone {
        width: 5rem; height: 5rem;
        border-radius: 1rem;
        border-color: #b6d4fe;
        display: flex; align-items: center; justify-content: center;
        transition: 0.3s;
    }

    /* === STATE NAVIGASI SOAL === */
    .nav-btn {
        transition: 0.25s ease;
        border: 2px solid #d1d5db;
        background-color: #e5e7eb;
        color: #374151;
        width: 100%;
        aspect-ratio: 1/1;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.875rem;
    }
    .unanswered { background-color: #dbeafe; border-color: #3b82f6; color: #1e3a8a; }
    .ragu { background-color: #fef08a; border-color: #facc15; color: #854d0e; }
    .answered { background-color: #198754; border-color: #146c43; color: white; }
    .active-soal { transform: scale(1.07); z-index: 10; box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1); }
    .quiz-locked { opacity: 0.7; pointer-events: none; filter: grayscale(20%); }

#quiz-area {
    height: calc(100vh - 40px);
}

#soal-container {
    height: calc(100% - 180px);
    overflow-y: auto;
    padding-right: 5px;
}

    /* Responsiveness Tambahan */
    @media (max-width: 768px) {
        #nav-bottom-container { gap: 6px; }
        #nav-bottom-container button { padding: 6px 10px; font-size: 12px; border-radius: 8px; }
        #btn-next { padding: 6px 12px; }
        #navigation-numbers { grid-template-columns: repeat(5, 1fr) !important; }
        #navigation-numbers button { font-size: 12px; padding: 6px; }
    }
    </style>
</head>
<body class="py-3">

<div class="container">
    <div class="row g-4 align-items-start">

        <!-- KONTEN UTAMA (KIRI) -->
        <div id="quiz-column" class="col-12 col-lg-12">
            
            <!-- INTRO AREA -->
            <div id="intro-area" class="card border-primary-subtle shadow-sm rounded-4 border p-4 p-md-5 intro-card">
                <!-- Header Petunjuk -->
                <div class="bg-light rounded-3 px-4 py-3 mb-4 d-flex align-items-center gap-3">
                    <span class="fs-4 text-secondary"><i class="fa-solid fa-folder"></i></span>
                    <h4 class="fw-bold text-secondary mb-0 tracking-widest">Petunjuk</h4>
                </div>

                <!-- Isi Petunjuk -->
                <ol class="text-dark ps-3 mb-3" style="line-height: 1.6; font-size: 1rem;">
                    <li class="mb-3">
                        Kuis terdiri dari <b>10 soal</b> yang bertujuan untuk mengukur pemahaman Anda terhadap materi yang telah dipelajari.
                    </li>

                    <li class="mb-3">
                        Bacalah setiap soal dengan teliti sebelum menentukan jawaban yang paling tepat.
                    </li>

                    <li class="mb-3">
                        Klik tombol <b>Mulai Kerjakan</b> untuk memulai kuis. Waktu pengerjaan akan mulai dihitung setelah kuis dimulai.
                    </li>

                    <li class="mb-3">
                        Cara menjawab soal:
                        <ul class="mt-2">
                            <li><b>Pilihan Ganda:</b> pilih satu jawaban yang dianggap paling benar.</li>
                            <li><b>Benar/Salah:</b> pilih jawaban Benar atau Salah sesuai pernyataan yang diberikan.</li>
                            <li><b>Isian Singkat (Essay):</b> ketik jawaban pada kolom yang tersedia sesuai instruksi soal.</li>
                            <li><b>Drag & Drop:</b> seret (drag) setiap item ke posisi yang sesuai untuk membentuk urutan atau pasangan yang benar.</li>
                        </ul>
                    </li>

                    <li class="mb-3">
                        Gunakan tombol <b>Lanjut</b> dan <b>Kembali</b> untuk berpindah antar soal. Setelah kuis dimulai, panel navigasi nomor soal akan muncul untuk memudahkan perpindahan soal.
                    </li>

                    <li class="mb-3">
                        Gunakan tombol <b>Tandai Ragu</b> apabila masih belum yakin dengan jawaban yang dipilih.
                    </li>

                    <li class="mb-3">
                        Pastikan seluruh soal telah dijawab sebelum menekan tombol <b>Selesai</b>.
                    </li>

                    <li class="mb-3">
                        Jika waktu pengerjaan habis, kuis akan diselesaikan secara otomatis dan jawaban yang telah tersimpan akan langsung diproses.
                    </li>
                </ol>

                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    <strong>Peringatan:</strong>
                    Selama kuis berlangsung, jangan melakukan <b>refresh halaman (F5)</b>,
                    menutup tab browser, kembali ke halaman sebelumnya, atau keluar dari halaman kuis karena dapat menyebabkan proses hilang atau terulang kembali dari awal.
                </div>

                <!-- Tombol Intro -->
                <div class="d-flex gap-3">
                    <a href="{{ route('mahasiswa.aktivitas.show',['pendahuluan','kompleksitas']) }}" class="btn btn-secondary border fw-bold px-4 py-2">
                        Kembali ke Materi
                    </a>
                    <button onclick="mulaiLatihan()" class="btn btn-primary fw-bold px-4 py-2 shadow-sm">
                        Mulai Kerjakan
                    </button>
                </div>
            </div>
            
            <!-- QUIZ AREA -->
            <div id="quiz-area" class="card border-primary-subtle shadow-sm rounded-4 border p-4 d-none">
                
                <h3 class="fs-6 fw-bold mb-3 text-secondary border-bottom pb-3 text-center text-md-start text-uppercase tracking-widest">
                    Kuis Selection Sort
                </h3>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <p class="small fw-bold text-secondary text-uppercase tracking-widest mb-0">Sisa Waktu</p>
                    <div id="timer" class="bg-danger text-white px-3 py-2 rounded-3 fw-bolder fs-5">
                        10:00
                    </div>
                </div>

                <div id="soal-container" class="mt-2">
                    @foreach($soal as $index => $s)
                    <div class="soal {{ $index != 0 ? 'd-none' : '' }}" data-nomor="{{ $s->nomor }}">
                        
                        <p class="fw-bold text-primary mb-2 fs-5">Soal {{ $s->nomor }}</p>

                        <!-- ESSAY -->
                        @if($s->tipe == 'essay')

                            @if(str_contains($s->pertanyaan,'___'))

                                @php
                                    $pertanyaan = e($s->pertanyaan);
                                    $pertanyaan = preg_replace('/_{3,}/', '[[INPUT]]', $pertanyaan);
                                    $parts = explode('[[INPUT]]', $pertanyaan);
                                @endphp

                            <div class="text-dark fs-5 mb-4 border rounded-4 p-4">
                                {!! nl2br($parts[0]) !!}
                                <input name="q{{ $s->nomor }}"
                                    oninput="markAnswered({{ $s->nomor }})"
                                    class="essay-input">
                                {!! nl2br($parts[1] ?? '') !!}
                            </div>

                            @else
                                {{-- ESSAY BIASA (TANPA ___) --}}
                                <div class="mb-4">
                                    <p class="text-dark fs-5 mb-4">{{ $s->pertanyaan }}</p>
                                    <input type="text"
                                        name="q{{ $s->nomor }}"
                                        class="form-control"
                                        oninput="markAnswered({{ $s->nomor }})">
                                </div>
                            @endif

                        @else
                        {{-- standar --}}

                        <div class="text-dark fs-5 mb-2">
                            {!! nl2br(e($s->pertanyaan)) !!}
                        </div>
                        @endif

                        <!-- PILIHAN GANDA -->
                        @if($s->tipe == 'pilgan')
                        <div class="quiz-options">
                            @foreach(['a','b','c','d','e'] as $opt)
                                @php $field = 'pilihan_'.$opt; @endphp
                                @if($s->$field)
                                <label class="option-box">
                                    <input type="radio" name="q{{ $s->nomor }}" value="{{ strtoupper($opt) }}" onchange="markAnswered({{ $s->nomor }})">
                                    <span class="ms-2">{{ $s->$field }}</span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        <!-- TRUE FALSE -->
                        @if($s->tipe == 'truefalse')
                        <div class="quiz-options">
                            <label class="option-box">
                                <input type="radio" name="q{{ $s->nomor }}" value="Benar" onchange="markAnswered({{ $s->nomor }})">
                                <span class="ms-2 fw-semibold">Benar</span>
                            </label>
                            <label class="option-box">
                                <input type="radio" name="q{{ $s->nomor }}" value="Salah" onchange="markAnswered({{ $s->nomor }})">
                                <span class="ms-2 fw-semibold">Salah</span>
                            </label>
                        </div>
                        @endif

                        <!-- DRAG DROP -->
                        @if($s->tipe == 'dragdrop')
                            @php
                                $data = json_decode($s->jawaban_benar, true);
                                $items = $data['source'];
                            @endphp
                            <div class="d-flex gap-3 mb-5 justify-content-center flex-wrap" id="source-{{ $s->nomor }}">
                                @foreach($items as $item)
                                    <div draggable="true" ondragstart="drag(event)" id="drag{{ $item }}-{{ $s->nomor }}" class="drag-item">
                                        {{ $item }}
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                @for($i=1;$i<=count($items);$i++)
                                    <div id="drop{{ $i }}-{{ $s->nomor }}" ondrop="drop(event, {{ $s->nomor }})" ondragover="allowDrop(event)" class="drop-zone border-dashed bg-slate-50"></div>
                                @endfor
                            </div>
                            <input type="hidden" name="q{{ $s->nomor }}" id="ans-q{{ $s->nomor }}">
                        @endif

                    </div>
                    @endforeach
                </div>

                <!-- AKSI BAWAH -->
                <div id="nav-bottom-container" class="d-flex justify-content-between mt-4 pt-4 border-top">
                    <button onclick="prevSoal()" class="btn btn-light border text-secondary fw-bold px-4 py-2 rounded-3">Kembali</button>
                    <button onclick="toggleRaguCurrent()" class="btn btn-warning text-dark fw-bold px-4 py-2 rounded-3">Tandai Ragu</button>
                    <button id="btn-next" onclick="nextSoal()" class="btn btn-primary fw-bold px-5 py-2 rounded-3 shadow-sm">Lanjut</button>
                </div>

            </div>
        </div>

        <!-- NAVIGASI KANAN -->
        <div id="navigation-panel" class="col-12 col-lg-3 d-none">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 2rem;">
                <p class="fw-bold text-secondary text-center small tracking-widest text-uppercase border-bottom pb-3 mb-4">Navigasi Soal</p>
                
                <div class="d-grid gap-2 mb-4" id="navigation-numbers" style="grid-template-columns: repeat(4, 1fr);">
                    @foreach($soal as $index => $s)
                        <button onclick="goSoal({{ $index }})" ondblclick="toggleRagu({{ $index }})" id="nav-{{ $index }}" class="nav-btn unanswered">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>

                <div class="small fw-bold text-secondary border-top pt-4 text-uppercase">
                    <div class="d-flex align-items-center mb-2">
                        <span class="bg-success rounded-2 me-2" style="width: 1rem; height: 1rem;"></span> Sudah Dijawab
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="bg-warning rounded-2 me-2" style="width: 1rem; height: 1rem;"></span> Ragu-ragu
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="bg-primary bg-opacity-25 border border-primary rounded-2 me-2" style="width: 1rem; height: 1rem;"></span> Belum Dijawab
                    </div>
                </div>

                <div class="mt-4 d-grid">
                    <button id="btn-finish-sidebar"
                            onclick="finishQuiz()"
                            class="btn btn-primary fw-bold py-2 rounded-3">
                            {{-- <i class="fa-solid fa-check me-2"></i> --}}
                            Selesai
                    </button>
                </div>

                <div id="finish-status" class="d-none mt-4 p-3 bg-primary-subtle text-primary rounded-3 small fw-bold text-center border border-primary-subtle text-uppercase tracking-widest">
                    STATUS: KUIS TERKUNCI
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const submitQuizUrl = "{{ route('mahasiswa.quiz.submit', $quiz->id) }}";
</script>
<script>
    
    let indexSoal = 0;
    const daftarSoal = document.querySelectorAll('.soal');
    const totalSoal = daftarSoal.length;
    let isLocked = false;
    let totalWaktu = 0;

    const kunciJawaban = {
    @foreach($soal as $s)
        @if($s->tipe == 'dragdrop')
            @php
                $data = json_decode($s->jawaban_benar, true);
                $correct = json_encode($data['correct']);
            @endphp
            q{{ $s->nomor }}: {!! $correct !!},
        @else
            q{{ $s->nomor }}: "{{ strtolower($s->jawaban_benar) }}",
        @endif
    @endforeach
    };

    function normalisasiJawaban(value) {
        return String(value ?? '')
            .toLowerCase()
            .trim()
            .replace(/\s+/g, ' ');
    }

    function mulaiLatihan() {
        totalWaktu = {{ $quiz->durasi }} * 60;
        fetch("{{ route('mahasiswa.quiz.start', $quiz->id) }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        document.getElementById('intro-area').classList.add('d-none');
        document.getElementById('quiz-area').classList.remove('d-none');
        document.getElementById('navigation-panel').classList.remove('d-none');
        // kembalikan ukuran kolom quiz
        document.getElementById('quiz-column').classList.remove('col-lg-12');
        document.getElementById('quiz-column').classList.add('col-lg-9');
        startTimer();
    }

    function tampilkanSoal(i) {
        daftarSoal.forEach((soal, idx) => {
            soal.classList.toggle('d-none', idx !== i);
            document.getElementById(`nav-${idx}`).classList.toggle('active-soal', idx === i);
        });
        indexSoal = i;
        const btnNext = document.getElementById('btn-next');
        if(!isLocked) btnNext.innerText = (indexSoal === totalSoal - 1) ? 'Finish' : 'Lanjut';
    }

    function markAnswered(nomor) {
        if(isLocked) return;
        const navBtn = document.getElementById(`nav-${nomor-1}`);
        if (navBtn.classList.contains('ragu')) return;
        let filled = false;

        const radios = document.querySelectorAll(`input[name="q${nomor}"][type="radio"]`);
        if (radios.length > 0) {
            filled = document.querySelector(`input[name="q${nomor}"]:checked`);
        } else {
            const input = document.querySelector(`input[name="q${nomor}"]`);
            filled = input && input.value.trim().length > 0;
        }

        if(filled) {
            navBtn.classList.remove('unanswered');
            navBtn.classList.add('answered');
        } else {
            navBtn.classList.add('unanswered');
            navBtn.classList.remove('answered');
        }
    }

    function toggleRaguCurrent() {
        if (isLocked) return;
        const navBtn = document.getElementById(`nav-${indexSoal}`);
        const nomor = indexSoal + 1;
        const input = document.querySelector(`[name="q${nomor}"]`);
        let filled = false;

        if (input) {
            filled = (input.type === "radio")
                ? document.querySelector(`input[name="q${nomor}"]:checked`)
                : input.value.trim().length > 0;
        }

        if (!navBtn.classList.contains('ragu')) {
            navBtn.classList.remove('answered','unanswered');
            navBtn.classList.add('ragu');
        } else {
            navBtn.classList.remove('ragu');
            if (filled) {
                navBtn.classList.add('answered');
            } else {
                navBtn.classList.add('unanswered');
            }
        }
    }

    function isSemuaTerjawab() {
        for (let i = 1; i <= totalSoal; i++) {
            const radios = document.querySelectorAll(`input[name="q${i}"]`);
            const textInput = document.querySelector(`input[name="q${i}"]`);
            if (radios.length > 1) {
                if (!document.querySelector(`input[name="q${i}"]:checked`)) return false;
            } else {
                if (!textInput || textInput.value.trim() === "") return false;
            }
        }
        return true;
    }
    
    function allowDrop(ev) { ev.preventDefault(); }
    function drag(ev) { ev.dataTransfer.setData("text", ev.target.id); }
    
    function drop(ev, nomorSoal) {
        ev.preventDefault();
        if(isLocked) return;
        let target = ev.target;

        if (ev.dataTransfer) {
            var data = ev.dataTransfer.getData("text");
            var draggedElement = document.getElementById(data);
            
            if (target.classList.contains('border-dashed') && target.children.length === 0) {
                target.appendChild(draggedElement);
            }
        }
        updateAfterDrop(target, nomorSoal);
    }

    function updateAfterDrop(target, nomorSoal) {
        if (target.classList.contains('border-dashed')) {
            target.classList.remove('bg-slate-50');
            target.classList.add('bg-blue-50');
            updateDragAnswer(nomorSoal);
        }
    }

    function updateDragAnswer(nomor) {
        let arr = [];
        const drops = document.querySelectorAll(`[id^="drop"][id$="-${nomor}"]`);
        drops.forEach(d => {
            if (d.innerText.trim() !== "") arr.push(parseInt(d.innerText.trim()));
        });
        document.getElementById(`ans-q${nomor}`).value = JSON.stringify(arr);
        markAnswered(nomor);
    }

    function resetDrag(nomor) {
        if (isLocked) return;
        const source = document.getElementById(`source-${nomor}`);
        const drops = document.querySelectorAll(`[id^="drop"][id$="-${nomor}"]`);
        drops.forEach(drop => {
            const child = drop.firstElementChild;
            if (child) source.appendChild(child);
            drop.classList.remove('bg-blue-50');
            drop.classList.add('bg-slate-50');
        });
        document.getElementById(`ans-q${nomor}`).value = "";
        const navBtn = document.getElementById(`nav-${nomor-1}`);
        navBtn.classList.add('unanswered');
        navBtn.classList.remove('answered');
    }

    function nextSoal() {
        if (indexSoal < totalSoal - 1) {
            tampilkanSoal(indexSoal + 1);
        } else {
            if (isSemuaTerjawab() && !masihAdaRagu()) {
                hitungNilai();
            } else {
                Swal.fire({ 
                    icon: 'warning', 
                    title: 'Belum Selesai', 
                    text: 'Jawab semua soal terlebih dahulu!', 
                    buttonsStyling: false, 
                    customClass: { confirmButton: 'btn btn-primary fw-bold px-4 py-2' }
                });
            }
        }
    }

    function masihAdaRagu() {
        return document.querySelectorAll('.nav-btn.ragu').length > 0;
    }

    function finishQuiz() {

        if (!isSemuaTerjawab()) {
            Swal.fire({
                icon: 'warning',
                title: 'Belum Selesai',
                text: 'Masih terdapat soal yang belum dijawab. Silakan periksa kembali dan lengkapi semua jawaban sebelum mengakhiri kuis.'
            });
            return;
        }

        if (masihAdaRagu()) {
            Swal.fire({
                icon: 'warning',
                title: 'Masih Ada Soal Ragu-ragu',
                text: 'Masih terdapat soal yang ditandai ragu-ragu. Silakan periksa kembali sebelum mengakhiri kuis.'
            });
            return;
        }

        hitungNilai();
    }

function hitungNilai(otomatis = false) {
    let benar = 0;
    clearInterval(intervalTimer);
    let semuaJawaban = {};

    for (const key in kunciJawaban) {
        const radios = document.querySelectorAll(`input[name="${key}"]`);
        const input = document.querySelector(`[name="${key}"]`);
        let jawabanUser = "";

        if (radios.length > 1) {
            const checked = document.querySelector(`input[name="${key}"]:checked`);
            jawabanUser = checked ? checked.value : "";
        } else if (input) {
            jawabanUser = input.value.trim();
        }

        semuaJawaban[key] = jawabanUser;

        if (Array.isArray(kunciJawaban[key])) {
            let userArr = [];
            try {
                userArr = JSON.parse(jawabanUser);
            } catch (e) {}

            if (JSON.stringify(userArr) === JSON.stringify(kunciJawaban[key])) {
                benar++;
            }
        } else {
            if (normalisasiJawaban(jawabanUser) === normalisasiJawaban(kunciJawaban[key])) {
                benar++;
            }
        }
    }

    const tampilkanHasil = (data) => {
        const skorServer = data.skor;
        const benarServer = data.benar ?? Math.round((Number(skorServer) / 100) * totalSoal);
        const totalSoalServer = data.total_soal ?? totalSoal;

        Swal.fire({
            title: data.lulus ? 'Selamat, Anda Lulus!' : 'Belum Lulus',
            html: `
                <div class="p-4 bg-primary-subtle rounded-3 border border-primary shadow-sm mt-3">

                    <p class="text-secondary fw-bold small text-uppercase mb-2 tracking-widest">
                        Hasil Kuis
                    </p>

                    <p class="display-3 fw-bold text-primary mb-3">
                        ${skorServer}
                    </p>

                    <div class="border-top pt-3">

                        <p class="mb-1">
                            <strong>KKM :</strong> ${data.kkm}
                        </p>

                        <p class="mb-1">
                            <strong>Jawaban Benar :</strong> ${benarServer} dari ${totalSoalServer}
                        </p>

                        <p class="fw-bold mt-2 ${data.lulus ? 'text-success' : 'text-danger'}">
                            ${
                                data.lulus
                                ? 'Anda telah memenuhi KKM dan dapat melanjutkan ke materi berikutnya.'
                                : 'Nilai Anda belum mencapai KKM. Silakan pelajari kembali materi dan kerjakan kuis ulang.'
                            }
                        </p>

                    </div>
                </div>
            `,
            icon: data.lulus ? 'success' : 'warning',
            confirmButtonText: data.lulus
                ? 'Lanjut ke Materi Berikutnya'
                : 'Pelajari Materi Kembali',
            allowOutsideClick: false,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary fw-bold px-4 py-2 mt-3'
            }
        }).then(() => {

            if (data.lulus) {
                window.location.href = "{{ route('mahasiswa.aktivitas.show',['insertion','materi']) }}";
            } else {
                window.location.href = "{{ route('mahasiswa.aktivitas.show',['selection','materi']) }}";
            }

        });
    };

    if (otomatis) {
        kunciKuis();
        document.getElementById("btn-next").disabled = true;

        fetch(submitQuizUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ jawaban: semuaJawaban })
        })
        .then(response => response.json())
        .then(data => tampilkanHasil(data));

        return;
    }

    Swal.fire({
        title: 'Konfirmasi Selesai',
        text: "Setelah menekan Selesai, Anda tidak dapat mengubah jawaban lagi.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Selesai',
        cancelButtonText: 'Cek Lagi',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-success fw-bold px-4 py-2 mx-2',
            cancelButton: 'btn btn-danger fw-bold px-4 py-2 mx-2'
        }
    }).then((result) => {

        if (result.isConfirmed) {

            kunciKuis();
            document.getElementById("btn-next").disabled = true;

            fetch(submitQuizUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ jawaban: semuaJawaban })
            })
            .then(response => {
                if (!response.ok) throw new Error("Server Error");
                return response.json();
            })
            .then(data => tampilkanHasil(data))
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Jawaban tidak dapat disimpan ke server.'
                });
            });
        }

    });
}

    function kunciKuis() {
        isLocked = true;
        document.querySelectorAll('input').forEach(i => i.disabled = true);
        document.getElementById('quiz-area').classList.add('quiz-locked');
        document.getElementById('nav-bottom-container').classList.add('d-none');
        document.getElementById('finish-status').classList.remove('d-none');
    }

    function prevSoal() { if (indexSoal > 0) tampilkanSoal(indexSoal - 1); }
    function goSoal(i) { tampilkanSoal(i); }
    
    // Start Kuis
    tampilkanSoal(0);

    // Timer
    let intervalTimer = null;
    function startTimer() {
        if (intervalTimer) clearInterval(intervalTimer);
        intervalTimer = setInterval(function () {
            if (totalWaktu <= 0) {
                clearInterval(intervalTimer);
                intervalTimer = null; 
                document.getElementById("timer").innerText = "00:00";
                waktuHabis();
                return;
            }
            let menit = Math.floor(totalWaktu / 60);
            let detik = totalWaktu % 60;
            menit = menit < 10 ? "0" + menit : menit;
            detik = detik < 10 ? "0" + detik : detik;
            document.getElementById("timer").innerText = menit + ":" + detik;
            totalWaktu--;
        }, 1000);
    }

function waktuHabis() {
    Swal.fire({
        title: 'Waktu Habis!',
        text: 'Kuis akan diselesaikan secara otomatis.',
        icon: 'warning',
        confirmButtonText: 'Lihat Hasil',
        allowOutsideClick: false,
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary fw-bold px-4 py-2'
        }
    }).then(() => {
        hitungNilai(true);
    });
}
</script>
</body>
</html>