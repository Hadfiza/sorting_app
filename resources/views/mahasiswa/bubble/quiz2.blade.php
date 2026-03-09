<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Pendahuluan Sorting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        .option-box { display: block; padding: 12px; border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 8px; cursor: pointer; transition: 0.2s; }
        .option-box:hover { background-color: #f8fafc; border-color: #cbd5e1; }
        input[type="radio"]:checked + span { font-weight: bold; color: #1d4ed8; }
        .d-none { display: none; }
        
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
  

        .code-input {
  background: transparent;
  border: none;
  border-bottom: 2px solid #38bdf8;
  color: #22c55e;
  font-family: monospace;
  font-size: 0.95rem;
  width: 40px;
  outline: none;
  text-align: center;
}

.drag-item {
    width: 56px;
    height: 56px;
    background: #3b82f6;
    color: white;
    font-weight: 800;
    font-size: 1.1rem;
    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: grab;
    user-select: none;
    box-shadow: 0 6px 14px rgba(59,130,246,.35);
}

.drag-item:active {
    cursor: grabbing;
    opacity: 0.85;
}
.drop-box {
    width: 56px;
    height: 56px;
    border: 2px dashed #cbd5e1;
    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f8fafc;
    transition: 0.2s;
}

.drop-box:hover {
    background: #e0f2fe;
    border-color: #38bdf8;
}

.source-elements {
    gap: 16px;
}

.drop-zone {
    gap: 16px;
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
                <li>Latihan ini terdiri dari <b>10 soal</b> tentang konsep dasar algoritma sorting.</li>
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
            <h3 class="text-2xl font-bold mb-6 text-slate-800 border-b border-slate-100 pb-5 text-center md:text-left text-sm uppercase tracking-widest">Latihan Pendahuluan Sorting</h3>
            
            <div id="soal-container">

            @foreach($soal as $index => $s)
            <div class="soal {{ $index != 0 ? 'd-none' : '' }}"
                id="soal-{{ $s->nomor }}"
                data-nomor="{{ $s->nomor }}">

                <p class="font-bold text-blue-600 mb-2 text-lg">
                    Soal {{ $s->nomor }}
                </p>

                {{-- ================= PERTANYAAN ================= --}}
                @if($s->tipe == 'essay' && str_contains($s->pertanyaan, '______'))

                    @php
                        $parts = explode('______', $s->pertanyaan);
                    @endphp

                    <pre class="bg-slate-900 text-green-400 p-6 rounded-xl text-sm overflow-x-auto whitespace-pre">{{ $parts[0] }}<input name="q{{ $s->nomor }}"
                    oninput="markAnswered({{ $s->nomor }})"
                    class="inline-block w-20 bg-slate-800 text-green-300 border-b border-green-400 outline-none text-center">{{ $parts[1] ?? '' }}</pre>

                @else
                    <p class="text-slate-700 mb-6 text-lg leading-relaxed whitespace-pre-line">
                        {{ $s->pertanyaan }}
                    </p>
                @endif


                {{-- ================= PILIHAN GANDA ================= --}}
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


                {{-- ================= ESSAY BIASA ================= --}}
                @if($s->tipe == 'essay' && !str_contains($s->pertanyaan, '______'))
                    <input type="text"
                        name="q{{ $s->nomor }}"
                        oninput="markAnswered({{ $s->nomor }})"
                        placeholder="Ketik jawaban Anda..."
                        class="w-full p-4 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-bold">
                @endif


                {{-- ================= TRUE FALSE ================= --}}
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


                {{-- ================= DRAGDROP ================= --}}
                @if($s->tipe == 'dragdrop')

                    @php
                        $data = json_decode($s->jawaban_benar, true);
                        $items = $data['source'];
                    @endphp

                    <div class="flex gap-4 mb-8 justify-center source-elements">
                        @foreach($items as $item)
                            <div draggable="true"
                                ondragstart="drag(event)"
                                id="drag{{ $s->nomor }}-{{ $item }}"
                                class="drag-item">
                                {{ $item }}
                            </div>
                        @endforeach
                    </div>

                    <div class="flex gap-4 justify-center drop-zone">
                        @for($i=0;$i<count($items);$i++)
                            <div class="drop-box"
                                ondrop="drop(event, {{ $s->nomor }})"
                                ondragover="allowDrop(event)">
                            </div>
                        @endfor
                    </div>

                    <input type="hidden"
                        name="q{{ $s->nomor }}"
                        id="ans-q{{ $s->nomor }}">
                @endif

            </div>
            @endforeach

            </div>

            <div id="nav-bottom-container" class="flex justify-between mt-12 pt-6 border-t border-slate-50">
                <button onclick="prevSoal()" class="bg-slate-100 text-slate-500 px-8 py-2.5 rounded-xl font-semibold hover:bg-slate-200 transition">Kembali</button>
                <button id="btn-ragu"
                        onclick="toggleRaguCurrent()"
                        class="bg-yellow-400 text-yellow-900 px-6 py-2.5 rounded-xl font-bold hover:bg-yellow-500 transition">
                    Tandai Ragu
                </button>
                <button id="btn-next" onclick="nextSoal()" class="bg-blue-600 text-white px-10 py-2.5 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">Lanjut</button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 h-fit sticky top-10">
            <p class="font-bold text-slate-700 mb-5 text-center text-[10px] tracking-[0.2em] uppercase border-b pb-3">
                Navigasi Soal
            </p>

            <div class="grid grid-cols-4 gap-2 mb-6" id="navigation-numbers">
                {{-- <button onclick="goSoal(0)" ondblclick="toggleRagu(0)" id="nav-0" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">1</button>
                <button onclick="goSoal(1)" ondblclick="toggleRagu(1)" id="nav-1" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">2</button>
                <button onclick="goSoal(2)" ondblclick="toggleRagu(2)" id="nav-2" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">3</button>
                <button onclick="goSoal(3)" ondblclick="toggleRagu(3)" id="nav-3" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">4</button>
                <button onclick="goSoal(4)" ondblclick="toggleRagu(4)" id="nav-4" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">5</button>
                <button onclick="goSoal(5)" ondblclick="toggleRagu(5)" id="nav-5" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">6</button>
                <button onclick="goSoal(6)" ondblclick="toggleRagu(6)" id="nav-6" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">7</button>
                <button onclick="goSoal(7)" ondblclick="toggleRagu(7)" id="nav-7" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">8</button>
                <button onclick="goSoal(8)" ondblclick="toggleRagu(8)" id="nav-8" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">9</button>
                <button onclick="goSoal(9)" ondblclick="toggleRagu(9)" id="nav-9" class="nav-btn  w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">10</button> --}}
                @foreach($soal as $index => $s)
                    <button onclick="goSoal({{ $index }})"
                        id="nav-{{ $index }}"
                        class="nav-btn w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">
                        {{ $s->nomor }}
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

    
    let indexSoal = 0;
    const daftarSoal = document.querySelectorAll('.soal');
    const totalSoal = daftarSoal.length;
    let isLocked = false;
    const kunciJawaban = {

    @foreach($soal as $s)

    @if($s->tipe == 'dragdrop')
        @php
            $data = json_decode($s->jawaban_benar, true);
            $correct = implode('', $data['correct']);
        @endphp
        q{{ $s->nomor }}: "{{ strtolower($correct) }}",
    @else
        q{{ $s->nomor }}: "{{ strtolower($s->jawaban_benar) }}",
    @endif

    @endforeach

    };


    function mulaiLatihan() {
        document.getElementById('intro-area').classList.add('d-none');
        document.getElementById('quiz-area').classList.remove('d-none');
    }

    function tampilkanSoal(i) {
        daftarSoal.forEach((soal, idx) => {
            soal.classList.toggle('d-none', idx !== i);
            document.getElementById(`nav-${idx}`).classList.toggle('active-soal', idx === i);
        });
        indexSoal = i;
        const btnNext = document.getElementById('btn-next');
        if(!isLocked) btnNext.innerText = (indexSoal === totalSoal - 1) ? 'Finish' : 'Lanjut';

        const navBtn = document.getElementById(`nav-${i}`);
        if (!navBtn.classList.contains('answered') &&
            !navBtn.classList.contains('ragu')) {
            navBtn.classList.add('unanswered');
        }
    }

    function markAnswered(nomor) {
        if (isLocked) return;

        const input = document.querySelector(`[name="q${nomor}"]`);
        const navBtn = document.getElementById(`nav-${nomor-1}`);

        let filled = (input.type === "radio")
            ? document.querySelector(`input[name="q${nomor}"]:checked`)
            : input.value.trim().length > 0;

        navBtn.classList.remove('ragu','unanswered','answered');

        if (filled) {
            navBtn.classList.add('answered');
        } else {
            navBtn.classList.add('unanswered');
        }
    }
    
    function toggleRaguCurrent() {
        if (isLocked) return;

        const navBtn = document.getElementById(`nav-${indexSoal}`);
        const nomor = indexSoal + 1;
        const input = document.querySelector(`[name="q${nomor}"]`);

        let filled = false;

        if (input.type === "radio") {
            filled = document.querySelector(`input[name="q${nomor}"]:checked`);
        } else {
            filled = input.value.trim().length > 0;
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

        let semuaTerjawab = true;

        daftarSoal.forEach(soal => {

            const nomor = soal.dataset.nomor;
            const input = document.querySelector(`[name="q${nomor}"]`);

            if (!input) return;

            if (input.type === "radio") {
                if (!document.querySelector(`input[name="q${nomor}"]:checked`)) {
                    semuaTerjawab = false;
                }
            } else {
                if (input.value.trim() === "") {
                    semuaTerjawab = false;
                }
            }

        });

        return semuaTerjawab;
    }

    // --- LOGIKA DRAG & DROP ---


// ===== DRAG BASIC =====
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, nomorSoal) {
    ev.preventDefault();
    if (isLocked) return;

    const data = ev.dataTransfer.getData("text");
    const dragged = document.getElementById(data);

    if (
        ev.target.classList.contains('drop-box') &&
        ev.target.children.length === 0
    ) {
        ev.target.appendChild(dragged);
        ev.target.classList.replace('bg-slate-50', 'bg-blue-50');
        updateDragAnswer(nomorSoal);
    }
}

// ===== AMBIL JAWABAN DINAMIS =====
function updateDragAnswer(nomor) {
    const soal = document.getElementById(`soal-${nomor}`);
    const drops = soal.querySelectorAll('.drop-box');

    let val = "";
    drops.forEach(box => {
        val += box.innerText.trim();
    });

    document.getElementById(`ans-q${nomor}`).value = val;

    if (val.length === drops.length) {
        markAnswered(nomor);
    }
}

// ===== RESET =====
function resetDrag(nomor) {
    if (isLocked) return;

    const soal = document.getElementById(`soal-${nomor}`);
    const source = soal.querySelector('.source-elements');

    soal.querySelectorAll('.drag-item').forEach(el => source.appendChild(el));
    soal.querySelectorAll('.drop-box').forEach(el => el.innerHTML = "");

    document.getElementById(`ans-q${nomor}`).value = "";

    const navBtn = document.getElementById(`nav-${nomor-1}`);
    if (navBtn) {
        navBtn.classList.add('unanswered');
        navBtn.classList.remove('answered');
    }
}

// function cekSoal6() {
//     const input = document.getElementById("q6").value.trim();
//     const navBtn = document.getElementById("nav-5"); // soal 6 index 5

//     navBtn.classList.remove('ragu','answered','unanswered');

//     if (input.length > 0) {
//         navBtn.classList.add('answered');
//     } else {
//         navBtn.classList.add('unanswered');
//     }
// }

// function cekSoal7() {
//     const input = document.getElementById("q7").value.trim();
//     const navBtn = document.getElementById("nav-6"); // soal 7 index 6

//     navBtn.classList.remove('ragu','answered','unanswered');

//     if (input.length > 0) {
//         navBtn.classList.add('answered');
//     } else {
//         navBtn.classList.add('unanswered');
//     }
// }


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

    function hitungNilai() {
            let benar = 0;
            for (const key in kunciJawaban) {
                const inputElement = document.querySelector(`[name="${key}"]`);
                if (inputElement) {
                    let jawabanUser = "";
                    if (inputElement.type === "radio") {
                        const checkedRadio = document.querySelector(`input[name="${key}"]:checked`);
                        jawabanUser = checkedRadio ? checkedRadio.value : "";
                    } else {
                        jawabanUser = inputElement.value.trim();
                    }
                    if (jawabanUser.toLowerCase() === kunciJawaban[key].toLowerCase()) {
                        benar++;
                    }
                }
            }

            const skor = Math.round((benar / totalSoal) * 100);

            // Alert 1: Konfirmasi Finish
            Swal.fire({
                title: 'Konfirmasi Selesai',
                text: "Setelah menekan Selesai, Anda tidak dapat mengubah jawaban lagi.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Selesai',
                cancelButtonText: 'Cek Lagi',
                buttonsStyling: false, // Matikan style bawaan SweetAlert
                customClass: {
                    confirmButton: 'bg-green-600 text-white px-6 py-2.5 rounded-lg mx-2 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-bold block',
                    cancelButton: 'bg-red-600 text-white px-6 py-2.5 rounded-lg mx-2 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-bold block'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    kunciKuis();

                // Alert 2: Hasil Skor
                Swal.fire({
                    title: 'Hasil Kuis!',
                    html: `
                        <div class="p-6 bg-blue-50 rounded-xl border-2 border-blue-100 shadow-inner">
                            <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-2">Skor Akhir Anda</p>
                            <p class="text-7xl font-black text-blue-600 mb-4">${skor}</p>
                            <p class="text-xs text-slate-400 font-bold border-t pt-2 uppercase">Benar: ${benar} dari ${totalSoal}</p>
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
            }
        });
    }

function kunciKuis() {
    isLocked = true;

    document.querySelectorAll('input').forEach(i => i.disabled = true);

    document.getElementById('nav-bottom-container').classList.add('hidden');
    document.getElementById('finish-status').classList.remove('hidden');
}

    function prevSoal() { if (indexSoal > 0) tampilkanSoal(indexSoal - 1); }
    function goSoal(i) { tampilkanSoal(i); }

    // Start
    tampilkanSoal(0);
</script>
</body>
</html>