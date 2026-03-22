<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quiz Bubble Sort</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
    .option-box { display: block; padding: 12px; border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 8px; cursor: pointer; transition: 0.2s; }
    .option-box:hover { background-color: #f8fafc; border-color: #cbd5e1; }
    input[type="radio"]:checked + span { font-weight: bold; color: #1d4ed8; }
    .d-none { display: none; }
    
    /* State Navigasi */
        /* State Navigasi */
    .nav-btn { transition: 0.3s; border-width: 2px; }

    /* === BASE BUTTON === */
    .nav-btn {
        transition: 0.25s ease;
        border-width: 2px;
    }

    /* DEFAULT (AWAL) = ABU SOFT */
    .nav-btn {
        background-color: #e5e7eb;
        border-color: #d1d5db;
        color: #374151;
    }

    /* BELUM DIJAWAB = BIRU */
    .unanswered {
        background-color: #dbeafe;
        border-color: #3b82f6;
        color: #1e3a8a;
    }

    /* RAGU-RAGU = KUNING */
    .ragu {
        background-color: #fef08a;
        border-color: #facc15;
        color: #854d0e;
    }

    /* SUDAH DIJAWAB = HIJAU */
    .answered {
        background-color: #22c55e;
        border-color: #16a34a;
        color: white;
    }

    /* SOAL AKTIF (PRIORITAS TERTINGGI) */
    .active-soal {
        transform: scale(1.07);
        z-index: 10;
    }
  
    /* State Terkunci */
    .quiz-locked { opacity: 0.7; pointer-events: none; filter: grayscale(20%); 
    }
    </style>
</head>
<body class="p-4 md:p-10 font-sans text-slate-800" style="background-color: #f0f7ff;">


<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">

        <div id="intro-area" class="md:col-span-3 bg-white p-8 rounded-2xl shadow-sm border border-blue-100 intro-card">

            <!-- Header Petunjuk -->
            <div class="bg-slate-100 rounded-xl px-5 py-3 mb-6 flex items-center gap-3">
                <span class="text-xl"><i class="fa-solid fa-folder"></i></span>
                <h4 class="font-bold text-slate-700 tracking-wide">Petunjuk</h4>
            </div>

            <!-- Isi Petunjuk -->
            <ol class="list-decimal ml-6 space-y-3 text-slate-700 text-lg leading-relaxed">
                <li>Latihan ini terdiri dari <b>10 soal</b> tentang Algoritma Bubble Sort.</li>
                <li>Kerjakan soal secara <b>berurutan</b> menggunakan tombol <b>Lanjut</b>.</li>
                <li>Pastikan semua soal telah dijawab sebelum menekan tombol <b>Selesai</b>.</li>
            </ol>

            <!-- Tombol -->
            <div class="flex gap-4 mt-10">
                <a href="{{ route('mahasiswa.aktivitas.show',['bubble','materi']) }}"
                class="bg-blue-100 text-blue-700 px-6 py-3 rounded-xl font-bold hover:bg-blue-200 transition">
                     Kembali ke Materi
                </a>

                <button onclick="mulaiLatihan()"
                        class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                     Mulai Latihan
                </button>
            </div>
        </div>
        
        <div id="quiz-area" class="md:col-span-3 bg-white p-8 rounded-2xl shadow-sm border border-blue-100 d-none">
            <h3 class="text-2xl font-bold mb-6 text-slate-800 border-b border-slate-100 pb-5 text-center md:text-left text-sm uppercase tracking-widest">Quiz Algoritma Bubble Sort</h3>
            
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">
                    Sisa Waktu
                </p>
                <div id="timer"
                    class="bg-red-100 text-red-600 px-4 py-2 rounded-xl font-black text-lg">
                    10:00
                </div>
            </div>


            <div id="soal-container">

            @foreach($soal as $index => $s)
            <div class="soal {{ $index != 0 ? 'd-none' : '' }}" data-nomor="{{ $s->nomor }}">
                
                <p class="font-bold text-blue-600 mb-2 text-lg">
                    Soal {{ $s->nomor }}
                </p>

            @if($s->tipe == 'essay' && str_contains($s->pertanyaan,'___'))

@php
$pertanyaan = e($s->pertanyaan);

// ganti ___ dengan placeholder unik
$pertanyaan = preg_replace('/_{3,}/', '[[INPUT]]', $pertanyaan);

// pecah berdasarkan placeholder
$parts = explode('[[INPUT]]', $pertanyaan);
@endphp

<pre class="bg-slate-900 text-white p-6 rounded-2xl text-sm font-mono leading-relaxed">{{ $parts[0] }}<input
name="q{{ $s->nomor }}"
oninput="markAnswered({{ $s->nomor }})"
class="inline-block w-24 mx-1 bg-slate-800 text-white border-b border-white outline-none text-center font-bold">{{ $parts[1] ?? '' }}</pre>

            @else

            <p class="text-slate-700 mb-8 text-lg leading-relaxed">
            {{ $s->pertanyaan }}
            </p>

            @endif

                {{-- PILIHAN GANDA --}}
                @if($s->tipe == 'pilgan')
                <div class="quiz-options space-y-3">
                    @foreach(['a','b','c','d'] as $opt)
                        @php $field = 'pilihan_'.$opt; @endphp
                        @if($s->$field)
                        <label class="option-box">
                            <input type="radio"
                                name="q{{ $s->nomor }}"
                                value="{{ strtoupper($opt) }}"
                                onchange="markAnswered({{ $s->nomor }})">
                            <span class="ml-3">{{ $s->$field }}</span>
                        </label>
                        @endif
                    @endforeach
                </div>
                @endif

                {{-- TRUE FALSE --}}
                @if($s->tipe == 'truefalse')
                <div class="quiz-options space-y-3">
                    <label class="option-box">
                        <input type="radio"
                            name="q{{ $s->nomor }}"
                            value="Benar"
                            onchange="markAnswered({{ $s->nomor }})">
                        <span class="ml-3 font-semibold">Benar</span>
                    </label>
                    <label class="option-box">
                        <input type="radio"
                            name="q{{ $s->nomor }}"
                            value="Salah"
                            onchange="markAnswered({{ $s->nomor }})">
                        <span class="ml-3 font-semibold">Salah</span>
                    </label>
                </div>
                @endif

                {{-- DRAGDROP --}}
                @if($s->tipe == 'dragdrop')

                @php
                    $data = json_decode($s->jawaban_benar, true);
                    $items = $data['source'];
                @endphp

                <div class="flex gap-4 mb-10 justify-center" id="source-{{ $s->nomor }}">
                    @foreach($items as $item)
                        <div draggable="true"
                            ondragstart="drag(event)"
                            id="drag{{ $item }}-{{ $s->nomor }}"
                            class="w-16 h-16 bg-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl cursor-move shadow-md">
                            {{ $item }}
                        </div>
                    @endforeach
                </div>

                <div class="flex gap-4 justify-center">
                    @for($i=1;$i<=count($items);$i++)
                        <div id="drop{{ $i }}-{{ $s->nomor }}"
                            ondrop="drop(event, {{ $s->nomor }})"
                            ondragover="allowDrop(event)"
                            class="w-20 h-20 border-2 border-dashed border-blue-200 rounded-2xl flex items-center justify-center bg-slate-50 transition-all">
                        </div>
                    @endfor
                </div>

                <input type="hidden" name="q{{ $s->nomor }}" id="ans-q{{ $s->nomor }}">

                @endif

            </div>
            @endforeach

            </div>

            {{-- AKSI --}}
            <div id="nav-bottom-container" class="flex justify-between mt-12 pt-6 border-t border-slate-50">
                <button onclick="prevSoal()" class="bg-slate-100 text-slate-500 px-8 py-2.5 rounded-xl font-semibold hover:bg-slate-200 transition">Kembali</button>

                <button onclick="toggleRaguCurrent()"
                    class="bg-yellow-400 text-yellow-900 px-6 py-2.5 rounded-xl font-bold hover:bg-yellow-500 transition">
                    Tandai Ragu
                </button>

                <button id="btn-next" onclick="nextSoal()" class="bg-blue-600 text-white px-10 py-2.5 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">Lanjut</button>
            </div>

        </div>

        {{-- Navagisi --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 h-fit sticky top-10">
            <p class="font-bold text-slate-700 mb-5 text-center text-[10px] tracking-[0.2em] uppercase border-b pb-3">
                Navigasi Soal
            </p>
        <div class="grid grid-cols-4 gap-2 mb-6" id="navigation-numbers">
            @foreach($soal as $index => $s)
                <button
                    onclick="goSoal({{ $index }})"
                    ondblclick="toggleRagu({{ $index }})"
                    id="nav-{{ $index }}"
                    class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>

            <div class="space-y-3 text-[10px] font-bold text-slate-400 border-t pt-5 uppercase tracking-wider">
                <div class="flex items-center">
                    <span class="w-4 h-4 bg-green-500 rounded-md mr-3"></span> 
                    Sudah Dijawab
                </div>
                <div class="flex items-center">
                    <span class="w-4 h-4 bg-yellow-300 rounded-md mr-3"></span> 
                    Ragu-ragu
                </div>
                <div class="flex items-center">
                    <span class="w-4 h-4 bg-blue-300 rounded-md mr-3"></span> 
                    Belum Dijawab
                </div>
            </div>

            <div id="finish-status" class="hidden mt-6 p-4 bg-blue-50 text-blue-600 rounded-xl text-[10px] font-black text-center border border-blue-100 uppercase tracking-widest leading-tight">
                STATUS: KUIS TERKUNCI
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const submitQuizUrl = "{{ route('mahasiswa.quiz.submit', $quiz->id) }}";
</script>
<script>
    
    let indexSoal = 0;
    const daftarSoal = document.querySelectorAll('.soal');
    const totalSoal = daftarSoal.length;
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
    totalWaktu = {{ $quiz->durasi }} * 60;

    fetch("{{ route('mahasiswa.quiz.start', $quiz->id) }}", {
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

    const navBtn = document.getElementById(`nav-${nomor-1}`);

    if (navBtn.classList.contains('ragu')) return;

    let filled = false;

    // CEK RADIO
    const radios = document.querySelectorAll(`input[name="q${nomor}"][type="radio"]`);
    if (radios.length > 0) {
        filled = document.querySelector(`input[name="q${nomor}"]:checked`);
    } 
    // CEK INPUT TEXT / HIDDEN (DRAGDROP)
    else {
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

        // Toggle ragu
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
                if (!document.querySelector(`input[name="q${i}"]:checked`)) {
                    return false;
                }
            } else {
                if (!textInput || textInput.value.trim() === "") {
                    return false;
                }
            }

        }

        return true;
    }
    
    // --- LOGIKA DRAG & DROP ---
    function allowDrop(ev) { ev.preventDefault(); }
    function drag(ev) { ev.dataTransfer.setData("text", ev.target.id); }
    function drop(ev, nomorSoal) {

        ev.preventDefault();
        if(isLocked) return;

        var data = ev.dataTransfer.getData("text");
        var draggedElement = document.getElementById(data);

        if (ev.target.classList.contains('border-dashed') && ev.target.children.length === 0) {

            ev.target.appendChild(draggedElement);

            ev.target.classList.remove('bg-slate-50');
            ev.target.classList.add('bg-blue-50');

            updateDragAnswer(nomorSoal);
        }
    }

function updateDragAnswer(nomor) {

    let arr = [];

    const drops = document.querySelectorAll(`[id^="drop"][id$="-${nomor}"]`);

    drops.forEach(d => {
        if (d.innerText.trim() !== "") {
            arr.push(parseInt(d.innerText.trim()));
        }
    });

    document.getElementById(`ans-q${nomor}`).value = JSON.stringify(arr);

    // 🔥 INI WAJIB
    markAnswered(nomor);
}

    function resetDrag(nomor) {

        if (isLocked) return;

        const source = document.getElementById(`source-${nomor}`);

        // Ambil semua drop zone untuk nomor ini
        const drops = document.querySelectorAll(`[id^="drop"][id$="-${nomor}"]`);

        drops.forEach(drop => {

            const child = drop.firstElementChild;

            if (child) {
                source.appendChild(child);
            }

            drop.classList.remove('bg-blue-50');
            drop.classList.add('bg-slate-50');
        });

        document.getElementById(`ans-q${nomor}`).value = "";

        const navBtn = document.getElementById(`nav-${nomor-1}`);
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
                Swal.fire({ icon: 'warning', title: 'Belum Selesai', text: 'Jawab semua soal terlebih dahulu!', buttonsStyling: false, customClass: {
                        confirmButton: 'bg-blue-600 text-white px-8 py-2.5 rounded-lg hover:bg-blue-700 font-bold focus:ring-4 focus:ring-blue-300' }});
            }
        }
    }

    //Hitung Nilai
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

    try {
        userArr = JSON.parse(jawabanUser);
        } catch(e) {}

        if (JSON.stringify(userArr) === JSON.stringify(kunciJawaban[key])) {
            benar++;
        }

        } else {

            if (jawabanUser.toLowerCase() === kunciJawaban[key].toLowerCase()) {
                benar++;
        }

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
            confirmButton: 'bg-green-600 text-white px-6 py-2.5 rounded-lg mx-2 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-bold block',
            cancelButton: 'bg-red-600 text-white px-6 py-2.5 rounded-lg mx-2 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-bold block'
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

                body: JSON.stringify({
                    jawaban: semuaJawaban,
                })

            })

            .then(response => {
                if(!response.ok){
                    throw new Error("Server Error");
                }
                return response.json();
            })

            .then(data => {

                const skorServer = data.skor;

                Swal.fire({
                    title: 'Hasil Kuis!',
                    html: `
                        <div class="p-6 bg-blue-50 rounded-xl border-2 border-blue-100 shadow-inner">
                            <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-2">Skor Akhir Anda</p>
                            <p class="text-7xl font-black text-blue-600 mb-4">${skorServer}</p>
                            <p class="text-xs text-slate-400 font-bold border-t pt-2 uppercase">Benar: ${Math.round(skorServer/10)} dari ${totalSoal}</p>
                        </div>
                    `,
                    icon: 'success',
                    confirmButtonText: 'Kembali ke Materi',
                    allowOutsideClick: false,
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'bg-blue-600 text-white px-10 py-3 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-bold mt-4'
                    }

                }).then(() => {

                    window.location.href = "{{ route('mahasiswa.aktivitas.show',['bubble','materi']) }}";

                });

            })

            .catch(error => {

                Swal.fire({
                    icon:'error',
                    title:'Terjadi Kesalahan',
                    text:'Jawaban tidak dapat disimpan ke server.'
                });

            });

        }

    });
    }

    function kunciKuis() {
        isLocked = true;
        document.querySelectorAll('input').forEach(i => i.disabled = true);
        document.getElementById('quiz-area').classList.add('quiz-locked');
        document.getElementById('nav-bottom-container').classList.add('hidden');
        document.getElementById('finish-status').classList.remove('hidden');
    }

    function prevSoal() { if (indexSoal > 0) tampilkanSoal(indexSoal - 1); }
    function goSoal(i) { tampilkanSoal(i); }

    // Start
    tampilkanSoal(0);


    // ================= TIMER =================
    let intervalTimer = null;

    function startTimer() {

        // reset dulu kalau ada timer lama
        if (intervalTimer) {
            clearInterval(intervalTimer);
        }

        intervalTimer = setInterval(function () {

            if (totalWaktu <= 0) {
                clearInterval(intervalTimer);
                intervalTimer = null; // penting
                document.getElementById("timer").innerText = "00:00";
                waktuHabis();
                return;
            }

            let menit = Math.floor(totalWaktu / 60);
            let detik = totalWaktu % 60;

            // format 2 digit
            menit = menit < 10 ? "0" + menit : menit;
            detik = detik < 10 ? "0" + detik : detik;

            document.getElementById("timer").innerText = menit + ":" + detik;

            totalWaktu--;

        }, 1000);
    }

        function waktuHabis() {
            Swal.fire({
                title: 'Waktu Habis!',
                text: 'Kuis otomatis diselesaikan.',
                icon: 'warning',
                confirmButtonText: 'Lihat Hasil',
                allowOutsideClick: false,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold'
                }
            }).then(() => {
                hitungNilai();
            });
        }
</script>
</body>
</html>