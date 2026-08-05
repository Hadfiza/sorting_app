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
        .active-soal { border-color: #3b82f6 !important; transform: scale(1.05); z-index: 10; }
        .unanswered { background-color: #fef08a; border-color: #facc15; color: #854d0e; } /* Kuning */
        .answered { background-color: #22c55e; border-color: #16a34a; color: white; } /* Hijau */

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
                <li>Latihan ini terdiri dari <b>10 soal</b> tentang konsep dasar algoritma sorting.</li>
                <li>Kerjakan soal secara <b>berurutan</b> menggunakan tombol <b>Lanjut</b>.</li>
                <li>Pastikan semua soal telah dijawab sebelum menekan tombol <b>Selesai</b>.</li>
            </ol>

            <!-- Tombol -->
            <div class="flex gap-4 mt-10">
                <a href="/siswa/pendahuluan/materi"
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
                <div class="soal" data-nomor="1">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 1</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">Tujuan utama dari proses sorting dalam struktur data adalah …</p>
                    <div class="quiz-options space-y-3">
                        <label class="option-box"><input type="radio" name="q1" value="A" onchange="markAnswered(1)"> <span class="ml-3">Menghapus data yang tidak diperlukan</span></label>
                        <label class="option-box"><input type="radio" name="q1" value="B" onchange="markAnswered(1)"> <span class="ml-3">Menyusun elemen data dalam urutan tertentu</span></label>
                        <label class="option-box"><input type="radio" name="q1" value="C" onchange="markAnswered(1)"> <span class="ml-3">Menghapus elemen yang tidak diperlukan</span></label>
                        <label class="option-box"><input type="radio" name="q1" value="D" onchange="markAnswered(1)"> <span class="ml-3">Menggabungkan elemen data</span></label>
                    </div>
                </div>

                <div class="soal d-none" data-nomor="2">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 2</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">Berikut yang merupakan contoh pengurutan ascending adalah …</p>
                    <div class="quiz-options space-y-3">
                        <label class="option-box"><input type="radio" name="q2" value="A" onchange="markAnswered(2)"> <span class="ml-3">[9, 7, 5, 3]</span></label>
                        <label class="option-box"><input type="radio" name="q2" value="B" onchange="markAnswered(2)"> <span class="ml-3">[20, 15, 10, 5]</span></label>
                        <label class="option-box"><input type="radio" name="q2" value="C" onchange="markAnswered(2)"> <span class="ml-3">[1, 4, 7, 9]</span></label>
                        <label class="option-box"><input type="radio" name="q2" value="D" onchange="markAnswered(2)"> <span class="ml-3">[12, 10, 8, 6]</span></label>
                    </div>
                </div>

                <div class="soal d-none" data-nomor="3">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 3</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">Dalam proses sorting, sort key adalah…</p>
                    <div class="quiz-options space-y-3">
                        <label class="option-box"><input type="radio" name="q3" value="A" onchange="markAnswered(3)"> <span class="ml-3">Jumlah total elemen dalam data</span></label>
                        <label class="option-box"><input type="radio" name="q3" value="B" onchange="markAnswered(3)"> <span class="ml-3">Atribut yang dijadikan dasar pengurutan</span></label>
                        <label class="option-box"><input type="radio" name="q3" value="C" onchange="markAnswered(3)"> <span class="ml-3">Indeks pertama dalam array</span></label>
                        <label class="option-box"><input type="radio" name="q3" value="D" onchange="markAnswered(3)"> <span class="ml-3">Nilai yang selalu disimpan di akhir pengurutan</span></label>
                    </div>
                </div>

                <div class="soal d-none" data-nomor="4">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 4</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">Jika diberikan data [7, 4, 6] dan dilakukan proses Sorting secara ascending, maka susunan data setelah satu kali pertukaran (swap) pertama adalah …</p>
                    <div class="quiz-options space-y-3">
                        <label class="option-box"><input type="radio" name="q4" value="A" onchange="markAnswered(4)"> <span class="ml-3">[7, 4, 6]</span></label>
                        <label class="option-box"><input type="radio" name="q4" value="B" onchange="markAnswered(4)"> <span class="ml-3">[4, 7, 6]</span></label>
                        <label class="option-box"><input type="radio" name="q4" value="C" onchange="markAnswered(4)"> <span class="ml-3">[4, 6, 7]</span></label>
                        <label class="option-box"><input type="radio" name="q4" value="D" onchange="markAnswered(4)"> <span class="ml-3">[6, 4, 7]</span></label>
                    </div>
                </div>

                <div class="soal d-none" data-nomor="5">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 5</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">Urutan langkah utama dalam proses sorting yang benar adalah …</p>
                    <div class="quiz-options space-y-3">
                        <label class="option-box"><input type="radio" name="q5" value="A" onchange="markAnswered(5)"> <span class="ml-3">Menukar elemen - Membandingkan elemen - Data terurut</span></label>
                        <label class="option-box"><input type="radio" name="q5" value="B" onchange="markAnswered(5)"> <span class="ml-3">Membandingkan elemen - Data terurut - Menukar elemen</span></label>
                        <label class="option-box"><input type="radio" name="q5" value="C" onchange="markAnswered(5)"> <span class="ml-3">Data terurut - Membandingkan elemen - Menukar elemen</span></label>
                        <label class="option-box"><input type="radio" name="q5" value="D" onchange="markAnswered(5)"> <span class="ml-3">Membandingkan elemen - Menukar elemen - Data terurut</span></label>
                    </div>
                </div>

                <div class="soal d-none" data-nomor="6">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 6</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">
                        Pengurutan data dari nilai terbesar ke terkecil disebut pengurutan __________.
                    </p>
                    <div class="quiz-options">
                        <input type="text" name="q6" id="q6" oninput="markAnswered(6)" placeholder="Ketik jawaban Anda..." class="w-full p-4 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-slate-700 font-bold">
                    </div>
                </div>

                <div class="soal d-none" data-nomor="7">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 7</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">
                        Dua operasi utama yang sering dianalisis dalam algoritma sorting adalah __________ dan __________.
                    </p>
                    <div class="quiz-options">
                        <input type="text" name="q7" id="q7" oninput="markAnswered(7)" placeholder="Ketik jawaban Anda..." class="w-full p-4 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-slate-700 font-bold">
                    </div>
                </div>

                <div class="soal d-none" data-nomor="8">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 8 (Simulasi Case Analysis)</p>
                    <p class="text-slate-700 mb-6 text-lg font-medium leading-relaxed">
                        Jika terdapat data <span class="bg-gray-100 px-2 py-1 rounded">[5, 2, 8]</span>, maka setelah satu kali operasi pertukaran (<b>swap</b>) pertama dilakukan, urutan data akan berubah menjadi...
                    </p>
                    <div class="flex gap-4 mb-10 justify-center" id="source-elements">
                        <div draggable="true" ondragstart="drag(event)" id="drag2" class="w-16 h-16 bg-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl cursor-move shadow-md">2</div>
                        <div draggable="true" ondragstart="drag(event)" id="drag5" class="w-16 h-16 bg-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl cursor-move shadow-md">5</div>
                        <div draggable="true" ondragstart="drag(event)" id="drag8" class="w-16 h-16 bg-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl cursor-move shadow-md">8</div>
                    </div>
                    <div class="flex gap-4 justify-center">
                        <div id="drop1" ondrop="drop(event, 8)" ondragover="allowDrop(event)" class="w-20 h-20 border-2 border-dashed border-blue-200 rounded-2xl flex items-center justify-center bg-slate-50 transition-all"></div>
                        <div id="drop2" ondrop="drop(event, 8)" ondragover="allowDrop(event)" class="w-20 h-20 border-2 border-dashed border-blue-200 rounded-2xl flex items-center justify-center bg-slate-50 transition-all"></div>
                        <div id="drop3" ondrop="drop(event, 8)" ondragover="allowDrop(event)" class="w-20 h-20 border-2 border-dashed border-blue-200 rounded-2xl flex items-center justify-center bg-slate-50 transition-all"></div>
                    </div>
                    <div class="text-center mt-6">
                        <button onclick="resetDrag(8)" class="text-xs font-bold text-red-500 uppercase underline tracking-widest hover:text-red-700 transition">Reset Susunan Angka</button>
                    </div>
                    <input type="hidden" name="q8" id="ans-q8"> 
                </div>

                <div class="soal d-none" data-nomor="9">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 9</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">
                        Bubble Sort memiliki kompleksitas ruang O(1) karena tidak membutuhkan memori tambahan.
                    </p>
                    <div class="quiz-options space-y-3">
                        <label class="option-box">
                            <input type="radio" name="q9" value="Benar" onchange="markAnswered(9)"> 
                            <span class="ml-3 font-semibold text-slate-700">Benar</span>
                        </label>
                        <label class="option-box">
                            <input type="radio" name="q9" value="Salah" onchange="markAnswered(9)"> 
                            <span class="ml-3 font-semibold text-slate-700">Salah</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-400 mt-4 italic">*Pilihlah salah satu jawaban yang menurut Anda paling tepat.</p>
                </div>

                <div class="soal d-none" data-nomor="10">
                    <p class="font-bold text-blue-600 mb-2 text-lg">Soal 10</p>
                    <p class="text-slate-700 mb-8 text-lg leading-relaxed">
                        Algoritma dengan kompleksitas O(n²) sangat efisien untuk data berukuran besar. 
                    </p>
                    <div class="quiz-options space-y-3">
                        <label class="option-box">
                            <input type="radio" name="q10" value="Benar" onchange="markAnswered(10)"> 
                            <span class="ml-3 font-semibold text-slate-700">Benar</span>
                        </label>
                        <label class="option-box">
                            <input type="radio" name="q10" value="Salah" onchange="markAnswered(10)"> 
                            <span class="ml-3 font-semibold text-slate-700">Salah</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-400 mt-4 italic">*Pilihlah salah satu jawaban yang menurut Anda paling tepat.</p>
                </div>

            </div>

            <div id="nav-bottom-container" class="flex justify-between mt-12 pt-6 border-t border-slate-50">
                <button onclick="prevSoal()" class="bg-slate-100 text-slate-500 px-8 py-2.5 rounded-xl font-semibold hover:bg-slate-200 transition">Kembali</button>
                <button id="btn-next" onclick="nextSoal()" class="bg-blue-600 text-white px-10 py-2.5 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">Lanjut</button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 h-fit sticky top-10">
            <p class="font-bold text-slate-700 mb-5 text-center text-[10px] tracking-[0.2em] uppercase border-b pb-3">
                Navigasi Soal
            </p>

            <div class="grid grid-cols-4 gap-2 mb-6" id="navigation-numbers">
                <button onclick="goSoal(0)" id="nav-0" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">1</button>
                <button onclick="goSoal(1)" id="nav-1" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">2</button>
                <button onclick="goSoal(2)" id="nav-2" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">3</button>
                <button onclick="goSoal(3)" id="nav-3" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">4</button>
                <button onclick="goSoal(4)" id="nav-4" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">5</button>
                <button onclick="goSoal(5)" id="nav-5" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">6</button>
                <button onclick="goSoal(6)" id="nav-6" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">7</button>
                <button onclick="goSoal(7)" id="nav-7" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">8</button>
                <button onclick="goSoal(8)" id="nav-8" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">9</button>
                <button onclick="goSoal(9)" id="nav-9" class="nav-btn unanswered w-full aspect-square rounded-lg flex items-center justify-center font-bold text-sm">10</button>
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
    // Kunci Jawaban: q7 adalah '258' (urutan setelah swap 5 dan 2)
    const kunciJawaban = { q1:'B', q2:'C', q3:'B', q4:'B', q5:'D', q6:'descending', q7:'perbandingan dan pertukaran', q8:'258', q9: 'Benar', q10:'salah'};
    let indexSoal = 0;
    const daftarSoal = document.querySelectorAll('.soal');
    const totalSoal = daftarSoal.length;
    let isLocked = false;

    // // --- INISIALISASI NAVIGASI SAMPING ---
    // const navGrid = document.getElementById('navigation-numbers');
    // for(let n=0; n < totalSoal; n++) {
    //     navGrid.innerHTML += `<button onclick="goSoal(${n})" id="nav-${n}" class="nav-btn unanswered w-full aspect-square rounded-xl flex items-center justify-center font-extrabold text-sm border-2">${n+1}</button>`;
    // }
    
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
    }

    function markAnswered(nomor) {
        if(isLocked) return;
        const input = document.querySelector(`[name="q${nomor}"]`);
        const navBtn = document.getElementById(`nav-${nomor-1}`);
        let filled = (input.type === "radio") ? true : input.value.trim().length > 0;
        
        if(filled) {
            navBtn.classList.remove('unanswered');
            navBtn.classList.add('answered');
        } else {
            navBtn.classList.add('unanswered');
            navBtn.classList.remove('answered');
        }
    }

    function isSemuaTerjawab() {
        for (let i = 1; i <= totalSoal; i++) {
            const input = document.querySelector(`[name="q${i}"]`);
            if (input.type === "radio") {
                if (!document.querySelector(`input[name="q${i}"]:checked`)) return false;
            } else {
                if (input.value.trim() === "") return false;
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
            ev.target.classList.replace('bg-slate-50', 'bg-blue-50');
            updateDragAnswer(nomorSoal);
        }
    }

    function updateDragAnswer(nomor) {
        const val = document.getElementById('drop1').innerText.trim() + 
                    document.getElementById('drop2').innerText.trim() + 
                    document.getElementById('drop3').innerText.trim();
        document.getElementById(`ans-q${nomor}`).value = val;
        // Hanya berubah hijau jika semua kotak terisi
        if (val.length === 3) markAnswered(nomor);
    }

    function resetDrag(nomor) {
        if(isLocked) return;
        const src = document.getElementById('source-elements');
        ['drag2','drag5','drag8'].forEach(id => src.appendChild(document.getElementById(id)));
        ['drop1','drop2','drop3'].forEach(id => {
            const el = document.getElementById(id);
            el.classList.replace('bg-blue-50', 'bg-slate-50');
            el.innerHTML = '';
        });
        document.getElementById(`ans-q${nomor}`).value = "";
        const navBtn = document.getElementById(`nav-${nomor-1}`);
        navBtn.classList.add('unanswered'); navBtn.classList.remove('answered');
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
                    window.location.href = "/siswa/pendahuluan/materi"; 
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
</script>
</body>
</html>