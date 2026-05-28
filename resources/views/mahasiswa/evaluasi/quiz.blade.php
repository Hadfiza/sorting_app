<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Evaluasi Akhir</title>
    
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
    
    /* Highlight untuk Tap Drag & Drop */
    .ring-4.ring-yellow-400 {
        box-shadow: 0 0 0 4px rgba(250, 204, 21, 0.5) !important;
        border-color: #facc15 !important;
    }

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
        border-bottom: 2px solid white;
        outline: none;
        text-align: center;
        font-weight: bold;
    }
    .essay-input:focus { border-color: #93c5fd; }

    /* Pilihan Ganda & True False */
    .option-box { 
        display: block; 
        padding: 12px; 
        border: 1px solid #dee2e6; 
        border-radius: 12px; 
        margin-bottom: 8px; 
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
        cursor: move; cursor: grab;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        transition: 0.2s;
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

{{-- MENGACAK SOAL SEBELUM DITAMPILKAN --}}
@php
    $soal = $soal->shuffle()->values();
@endphp

<body class="py-4 py-md-5">

<div class="container">
    <div class="row g-4 align-items-start">

        <!-- KONTEN UTAMA (KIRI) -->
        <div class="col-12 col-lg-9">
            
            <!-- INTRO AREA -->
            <div id="intro-area" class="card border-primary-subtle shadow-sm rounded-4 border p-4 p-md-5 intro-card">
                <!-- Header Petunjuk -->
                <div class="bg-light rounded-3 px-4 py-3 mb-4 d-flex align-items-center gap-3">
                    <span class="fs-4 text-secondary"><i class="fa-solid fa-folder"></i></span>
                    <h4 class="fw-bold text-secondary mb-0 tracking-widest">Petunjuk Evaluasi</h4>
                </div>

                <!-- Isi Petunjuk -->
                <ol class="fs-5 text-secondary ps-4 mb-5" style="line-height: 1.8;">
                    <li class="mb-2">Latihan ini terdiri dari <b>{{ $soal->count() }} soal</b> acak tentang semua materi algoritma yang telah dipelajari.</li>
                    <li class="mb-2">Kerjakan soal secara <b>berurutan</b> menggunakan tombol <b>Lanjut</b>.</li>
                    <li class="mb-2">Pastikan semua soal telah dijawab sebelum menekan tombol <b>Selesai</b>.</li>
                </ol>

                <!-- Tombol Intro -->
                <div class="d-flex gap-3">
                    <a href="{{ route('mahasiswa.aktivitas.show',['merge','quiz']) }}" class="btn btn-light border fw-bold px-4 py-2 text-primary">
                        Kembali
                    </a>
                    <button onclick="mulaiLatihan()" class="btn btn-primary fw-bold px-4 py-2 shadow-sm">
                        Mulai Evaluasi
                    </button>
                </div>
            </div>
            
            <!-- QUIZ AREA -->
            <div id="quiz-area" class="card border-primary-subtle shadow-sm rounded-4 border p-4 p-md-5 d-none">
                
                <h3 class="fs-6 fw-bold mb-4 text-secondary border-bottom pb-3 text-center text-md-start text-uppercase tracking-widest">
                    Evaluasi Akhir
                </h3>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="small fw-bold text-secondary text-uppercase tracking-widest mb-0">Sisa Waktu</p>
                    <div id="timer" class="bg-danger text-white px-3 py-2 rounded-3 fw-bolder fs-5">
                        10:00
                    </div>
                </div>

                <div id="soal-container">
                    @foreach($soal as $index => $s)
                    <div class="soal {{ $index != 0 ? 'd-none' : '' }}" data-nomor="{{ $s->nomor }}">
                        
                        <p class="fw-bold text-primary mb-3 fs-5">Soal {{ $index + 1 }}</p>

                        <!-- ESSAY -->
                        @if($s->tipe == 'essay' && str_contains($s->pertanyaan,'___'))
                            @php
                            $pertanyaan = e($s->pertanyaan);
                            $pertanyaan = preg_replace('/_{3,}/', '[[INPUT]]', $pertanyaan);
                            $parts = explode('[[INPUT]]', $pertanyaan);
                            @endphp
                            <pre class="bg-dark text-white p-4 rounded-4 small font-monospace" style="white-space: pre-wrap; overflow-x: auto;">{{ $parts[0] }}<input name="q{{ $s->nomor }}" oninput="markAnswered({{ $s->nomor }})" class="essay-input">{{ $parts[1] ?? '' }}</pre>

                        <!-- STANDAR -->
                        @else
                            <pre class="text-secondary mb-4 fs-5 font-monospace" style="white-space: pre-wrap; overflow-x: auto;">{{ $s->pertanyaan }}</pre>
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
                <div id="nav-bottom-container" class="d-flex justify-content-between mt-5 pt-4 border-top">
                    <button onclick="prevSoal()" class="btn btn-light border text-secondary fw-bold px-4 py-2 rounded-3">Kembali</button>
                    <button onclick="toggleRaguCurrent()" class="btn btn-warning text-dark fw-bold px-4 py-2 rounded-3">Tandai Ragu</button>
                    <button id="btn-next" onclick="nextSoal()" class="btn btn-primary fw-bold px-5 py-2 rounded-3 shadow-sm">Lanjut</button>
                </div>

            </div>
        </div>

        <!-- NAVIGASI KANAN -->
        <div class="col-12 col-lg-3">
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
const submitQuizUrl = "{{ route('mahasiswa.quiz.submit', $quiz->id ?? 0) }}";
</script>
<script>
    let indexSoal = 0;
    const daftarSoal = document.querySelectorAll('.soal');
    const totalSoal = daftarSoal.length;
    // let selectedItem = null; // TAP Drop
    let isLocked = false;

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

    function mulaiLatihan() {
        totalWaktu = {{ $quiz->durasi ?? 0 }} * 60;
        fetch("{{ route('mahasiswa.quiz.start', $quiz->id ?? 0) }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        document.getElementById('intro-area').classList.add('d-none');
        document.getElementById('quiz-area').classList.remove('d-none');
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
        const targetSoal = document.querySelector(`.soal[data-nomor="${nomor}"]`);
        const actualIndex = Array.from(daftarSoal).indexOf(targetSoal);
        const navBtn = document.getElementById(`nav-${actualIndex}`);

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
        const nomor = daftarSoal[indexSoal].getAttribute('data-nomor'); // Get actual question ID after shuffle
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
        for (let i = 0; i < totalSoal; i++) {
            const nomor = daftarSoal[i].getAttribute('data-nomor');
            const radios = document.querySelectorAll(`input[name="q${nomor}"]`);
            const textInput = document.querySelector(`input[name="q${nomor}"]`);

            if (radios.length > 1) {
                if (!document.querySelector(`input[name="q${nomor}"]:checked`)) return false;
            } else {
                if (!textInput || textInput.value.trim() === "") return false;
            }
        }
        return true;
    }
    
    // --- LOGIKA DRAG & DROP & TAP ---
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

    // function selectItem(el) {
    //     if (isLocked) return;
    //     // reset semua
    //     document.querySelectorAll('[draggable="true"]').forEach(i => {
    //         i.classList.remove('ring-4','ring-yellow-400');
    //     });
    //     selectedItem = el;
    //     // kasih highlight
    //     el.classList.add('ring-4','ring-yellow-400');
    // }

    // function tapDrop(target, nomorSoal) {
    //     if (isLocked) return;
    //     if (!selectedItem) return;

    //     if (target.children.length === 0) {
    //         target.appendChild(selectedItem);
    //         selectedItem.classList.remove('ring-4','ring-yellow-400');
    //         selectedItem = null;
    //         updateAfterDrop(target, nomorSoal);
    //     }
    // }

    // function updateAfterDrop(target, nomorSoal) {
    //     target.classList.remove('bg-slate-50');
    //     target.classList.add('bg-blue-50');
    //     updateDragAnswer(nomorSoal);
    // }

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
        
        const targetSoal = document.querySelector(`.soal[data-nomor="${nomor}"]`);
        const actualIndex = Array.from(daftarSoal).indexOf(targetSoal);
        const navBtn = document.getElementById(`nav-${actualIndex}`);

        navBtn.classList.add('unanswered');
        navBtn.classList.remove('answered');
    }

    // --- LOGIKA PENILAIAN ---
    function nextSoal() {
        if (indexSoal < totalSoal - 1) {
            tampilkanSoal(indexSoal + 1);
        } else {
            if (isSemuaTerjawab()) {
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

    function hitungNilai() {
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
                try { userArr = JSON.parse(jawabanUser); } catch(e) {}
                if (JSON.stringify(userArr) === JSON.stringify(kunciJawaban[key])) benar++;
            } else {
                if (jawabanUser.toLowerCase() === kunciJawaban[key].toLowerCase()) benar++;
            }
        }

        const skor = Math.round((benar / totalSoal) * 100);

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
                    body: JSON.stringify({ jawaban: semuaJawaban, })
                })
                .then(response => {
                    if(!response.ok) throw new Error("Server Error");
                    return response.json();
                })
                .then(data => {
                    const skorServer = data.skor;
                    Swal.fire({
                        title: 'Hasil Evaluasi!',
                        html: `
                            <div class="p-4 bg-primary-subtle rounded-3 border border-primary shadow-sm mt-3">
                                <p class="text-secondary fw-bold small text-uppercase mb-2 tracking-widest">Skor Akhir Anda</p>
                                <p class="display-3 fw-bold text-primary mb-3">${skorServer}</p>
                                <p class="small text-secondary fw-bold border-top pt-2 text-uppercase">Benar: ${Math.round(skorServer/10)} dari ${totalSoal}</p>
                            </div>
                        `,
                        icon: 'success',
                        confirmButtonText: 'Kembali',
                        allowOutsideClick: false,
                        buttonsStyling: false,
                        customClass: { confirmButton: 'btn btn-primary fw-bold px-4 py-2 mt-3' }
                    }).then(() => {
                        window.location.href = "{{ route('mahasiswa.aktivitas.show',['pendahuluan','sorting']) }}";
                    });
                })
                .catch(error => {
                    Swal.fire({ icon:'error', title:'Terjadi Kesalahan', text:'Jawaban tidak dapat disimpan ke server.' });
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
            text: 'Evaluasi otomatis diselesaikan.',
            icon: 'warning',
            confirmButtonText: 'Lihat Hasil',
            allowOutsideClick: false,
            buttonsStyling: false,
            customClass: { confirmButton: 'btn btn-primary fw-bold px-4 py-2' }
        }).then(() => { hitungNilai(); });
    }
</script>
</body>
</html>