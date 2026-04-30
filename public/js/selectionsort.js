// =========================================================
// BAGIAN 2: LOGIKA SIMULASI SELECTION SORT (DENGAN ANIMASI)
// =========================================================

const IMG_PATH = window.IMG_PATH || '';
const initialData = [21, 13, 23, 17, 19]; // Data tanggal EXP Kaleng

let arr = [...initialData];
let i = 0;              // Indeks batas awal iterasi (daerah belum terurut)
let j = 1;              // Indeks untuk mencari nilai terkecil
let minIndex = 0;       // Menyimpan indeks dengan nilai terkecil sementara
let phase = 'COMPARE';  // State mesin: 'COMPARE' (Mencari Min) atau 'SWAP' (Menukar)
let isProcessing = false;

let container = document.getElementById('simulation-container');

// --- FUNGSI RESET ---
function resetSimulation() {
    container = document.getElementById('simulation-container');
    const finishMsg = document.getElementById('finish-message');
    
    container.innerHTML = '';
    if(finishMsg) finishMsg.style.display = 'none';

    arr = [...initialData];
    i = 0;
    j = 1;
    minIndex = 0;
    phase = 'COMPARE';
    isProcessing = false;

    nextStep();
}

// --- LOGIKA STEP-BY-STEP---
function nextStep() {
    if(!container) container = document.getElementById('simulation-container');
    const n = arr.length;

    // Cek Selesai (Jika tinggal 1 elemen terakhir, pasti sudah urut)
    if (i >= n - 1) {
        showFinishMessage();
        return;
    }

    let explanationText = "";
    let btn1HTML = "";
    let btn2HTML = "";
    let highlightIndices = [];
    let val1, val2;

    // --- FASE 1: PENCARIAN NILAI MINIMUM (EXP TERDEKAT) ---
    if (phase === 'COMPARE') {
        val1 = arr[minIndex]; // Nilai minimum sementara
        val2 = arr[j];        // Nilai target yang sedang dicek
        highlightIndices = [minIndex, j];

        explanationText = `
            <div class="mb-2"><span class="badge bg-secondary">Iterasi ke-${i+1} | Pencarian EXP Terawal</span></div>
            Berdasarkan prinsip <em>Selection Sort</em> (ascending), analisislah apakah status nilai minimum sementara perlu diperbarui ke indeks ke-${j}?
        `;

        btn1HTML = `<button class="btn-sim btn-tukar fw-bold" onclick="checkAnswer(true, ${val1}, ${val2}, ${minIndex}, ${j}, ${i}, 'COMPARE')">Perbarui Minimum</button>`;
        btn2HTML = `<button class="btn-sim btn-stay fw-bold" onclick="checkAnswer(false, ${val1}, ${val2}, ${minIndex}, ${j}, ${i}, 'COMPARE')">Tidak Diperbarui</button>`;
    }
    // --- FASE 2: EVALUASI PERTUKARAN AKHIR ITERASI ---
    else if (phase === 'SWAP') {
        val1 = arr[i];        // Elemen di posisi awal yang belum terurut
        val2 = arr[minIndex]; // Elemen terkecil yang ditemukan di fase compare
        highlightIndices = [i, minIndex];

        explanationText = `
            <div class="mb-2"><span class="badge bg-primary">Iterasi ke-${i+1} | Evaluasi Pertukaran Akhir</span></div>
            Pencarian pada iterasi ini selesai. Tanggal EXP paling awal dari elemen yang tersisa telah ditemukan pada indeks ke-<strong>${minIndex}</strong> (Kaleng EXP ${val2}).<br>
            Indeks target awal untuk iterasi ini adalah indeks ke-<strong>${i}</strong> (Kaleng EXP ${val1}).<br>
            Berdasarkan aturan akhir <em>Selection Sort</em>, analisislah apakah kedua kaleng tersebut wajib ditukar posisinya?
        `;

        btn1HTML = `<button class="btn-sim btn-tukar fw-bold" onclick="checkAnswer(true, ${val1}, ${val2}, ${i}, ${minIndex}, ${i}, 'SWAP')"><i class="fa-solid fa-right-left me-1"></i> Perlu Ditukar</button>`;
        btn2HTML = `<button class="btn-sim btn-stay fw-bold" onclick="checkAnswer(false, ${val1}, ${val2}, ${i}, ${minIndex}, ${i}, 'SWAP')"><i class="fa-solid fa-lock me-1"></i> Tidak Ditukar</button>`;
    }

    // ID Unik untuk animasi kartu
    const cardIdSuffix = phase === 'COMPARE' ? `${i}-${j}-C` : `${i}-${minIndex}-S`;

    const cardHTML = `
    <div class="sim-card fade-in">
        <div class="sim-header" style="font-size: 0.95rem; line-height: 1.5;">${explanationText}</div>
        <div class="sim-body">

            <div class="can-container" id="book-container-${cardIdSuffix}">
                ${renderCansHTML([...arr], highlightIndices, minIndex, phase)}
            </div>

            <div class="action-buttons" id="action-btn-${cardIdSuffix}">
                ${btn1HTML}
                ${btn2HTML}
            </div>

            <div id="explanation-${cardIdSuffix}" class="mt-3 p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25" style="display: none;">
            </div>

        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', cardHTML);

    requestAnimationFrame(() => {
        const lastCard = container.lastElementChild;
        if (lastCard) {
            lastCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
}

// --- FUNGSI PENGECEKAN JAWABAN ---
function checkAnswer(userChoice, val1, val2, idx1, idx2, iterI, currentPhase) {
    if (isProcessing) return;
    isProcessing = true;

    // Logika Kunci Jawaban
    let correctAnswer = false;
    if (currentPhase === 'COMPARE') correctAnswer = val2 < val1;  // Update min jika nilai baru lebih kecil
    if (currentPhase === 'SWAP') correctAnswer = idx1 !== idx2;   // Tukar jika indeks awal bukan indeks minimum

    const cardIdSuffix = currentPhase === 'COMPARE' ? `${iterI}-${idx2}-C` : `${iterI}-${idx2}-S`;
    const actionContainer = document.getElementById(`action-btn-${cardIdSuffix}`);
    const explanationBox = document.getElementById(`explanation-${cardIdSuffix}`);

    if (userChoice === correctAnswer) {
        // Matikan tombol opsi
        const buttons = actionContainer.querySelectorAll('.btn-sim');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.style.cursor = 'not-allowed';
            if((userChoice && btn.classList.contains('btn-stay')) || (!userChoice && btn.classList.contains('btn-tukar'))) {
                btn.style.display = 'none';
            }
        });

        let explText = "";
        let actionType = correctAnswer ? 'yes' : 'no'; // yes = Perbarui/Tukar, no = Tetap

        // Susun Penjelasan Sesuai Fase
        if (currentPhase === 'COMPARE') {
            if (correctAnswer) {
                explText = `
                    <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Anda Tepat!</div>
                    <div class="text-dark" style="font-size: 0.9rem;">
                        Status minimum <strong>wajib diperbarui</strong> karena Kaleng EXP ${val2} lebih awal (kecil) daripada minimum sementara saat ini yaitu EXP ${val1} (${val2} < ${val1}).
                    </div>`;
            } else {
                explText = `
                    <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Anda Tepat!</div>
                    <div class="text-dark" style="font-size: 0.9rem;">
                        Status minimum <strong>tidak diperbarui</strong> karena Kaleng EXP ${val2} lebih lama atau sama dengan minimum sementara EXP ${val1} (${val2} &ge; ${val1}).
                    </div>`;
            }
        } else if (currentPhase === 'SWAP') {
            if (correctAnswer) {
                explText = `
                    <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Anda Tepat!</div>
                    <div class="text-dark" style="font-size: 0.9rem;">
                        Pertukaran <strong>wajib dilakukan</strong> agar kaleng dengan EXP terawal yang ditemukan (EXP ${val2}) menempati posisi terdepan pada batas array yang belum terurut (indeks ke-${idx1}).
                    </div>`;
            } else {
                explText = `
                    <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Anda Tepat!</div>
                    <div class="text-dark" style="font-size: 0.9rem;">
                        Pertukaran <strong>tidak perlu dilakukan</strong> karena kaleng pada indeks target awal (indeks ke-${idx1}) ternyata sudah memiliki tanggal EXP paling awal.
                    </div>`;
            }
        }

        explText += `
            <div class="mt-3 text-end">
                <button class="btn btn-sm btn-success px-4 rounded-pill fw-bold" onclick="proceedNext('${currentPhase}', '${actionType}', '${cardIdSuffix}', event)">
                    Lanjutkan Simulasi <i class="fa-solid fa-arrow-right ms-1"></i>
                </button>
            </div>
        `;

        explanationBox.innerHTML = explText;
        explanationBox.style.display = 'block';

        isProcessing = false;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Analisis Kurang Tepat',
            text: 'Ingat, Selection Sort bertugas mencari nilai (Tanggal EXP) yang paling kecil untuk diletakkan di indeks awal.',
            confirmButtonColor: '#e74c3c'
        }).then(() => {
            isProcessing = false;
        });
    }
}

// --- FUNGSI MELANJUTKAN & MATIKAN TOMBOL ---
function proceedNext(currentPhase, actionType, cardIdSuffix, event) {
    if (isProcessing) return;
    isProcessing = true;

    // Matikan tombol lanjutkan
    const btnLanjut = event.currentTarget;
    btnLanjut.disabled = true;
    btnLanjut.style.opacity = '0.6';
    btnLanjut.style.cursor = 'not-allowed';

    if (currentPhase === 'COMPARE') {
        if (actionType === 'yes') minIndex = j; // Perbarui indeks minimum
        advanceCompare();
    } else if (currentPhase === 'SWAP') {
        if (actionType === 'yes') {
            executeSwapWithAnimation(i, minIndex, cardIdSuffix); // Eksekusi dengan animasi
        } else {
            advanceIter();
        }
    }
}

function advanceCompare() {
    j++;
    const n = arr.length;
    // Jika j sudah mencapai akhir, ganti fase menjadi SWAP
    if (j >= n) {
        phase = 'SWAP';
    }
    isProcessing = false;
    nextStep();
}

// --- FUNGSI ANIMASI PERTUKARAN ---
function executeSwapWithAnimation(idxA, idxB, cardIdSuffix) {
    const bookContainer = document.getElementById(`book-container-${cardIdSuffix}`);
    const books = bookContainer.querySelectorAll('.can-img-wrap'); // Disesuaikan dengan nama class kaleng

    const bookA = books[idxA];
    const bookB = books[idxB];

    if(!bookA || !bookB) {
        completeSwap(idxA, idxB);
        return;
    }

    const distance = bookB.offsetLeft - bookA.offsetLeft;

    bookA.style.transform = `translateX(${distance}px) scale(1.15)`;
    bookB.style.transform = `translateX(-${distance}px) scale(1.15)`;

    setTimeout(() => {
        completeSwap(idxA, idxB);
    }, 600);
}

function completeSwap(idxA, idxB) {
    let temp = arr[idxA];
    arr[idxA] = arr[idxB];
    arr[idxB] = temp;
    advanceIter();
}

function advanceIter() {
    container.insertAdjacentHTML('beforeend', `<div style="text-align:center; padding:15px; color:#aaa; font-style:italic; font-size:0.85rem;">--- Iterasi ${i+1} Selesai ---</div>`);
    i++;
    minIndex = i;
    j = i + 1;
    phase = 'COMPARE';
    isProcessing = false;
    nextStep();
}

// --- HELPER RENDERING KALENG ---
function renderCansHTML(dataArr, highlights, currentMinIndex, currentPhase) {
    return dataArr.map((val, idx) => {
        let activeClass = highlights.includes(idx) ? 'scanning' : ''; // Disesuaikan dengan class CSS Anda
        let labelBadge = '';

        // Tampilkan lencana "MIN" khusus di fase pencarian agar dosen/siswa tahu mana nilai terkecil sementara
        if (currentPhase === 'COMPARE' && idx === currentMinIndex) {
            labelBadge = `<div style="position:absolute; top:-15px; left:50%; transform:translateX(-50%); background:#0d6efd; color:white; font-size:0.65rem; padding:3px 8px; border-radius:12px; font-weight:bold; z-index:20; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">MIN</div>`;
        }

        return `
            <div class="can-img-wrap ${activeClass}" style="position: relative; transition: all 0.6s ease-in-out;">
                ${labelBadge}
                <img src="${IMG_PATH}${val}.png" width="80" alt="${val}">
                <div class="can-index fw-bold mt-2 text-secondary">Idx: ${idx}</div>
            </div>
        `;
    }).join('');
}

function showFinishMessage() {
    const finishMsg = document.getElementById('finish-message');
    if(finishMsg) finishMsg.style.display = 'block';
    window.scrollTo(0, document.body.scrollHeight);
}

// --- AUTO START ---
resetSimulation();

// =========================================================
// BAGIAN 3: LOGIKA EDITOR PYTHON
// =========================================================
let editorInitialized = false;

async function initPythonEditor() {
    if (editorInitialized) return;

    const codeArea = document.getElementById("code");
    if (!codeArea) return;

    editor = CodeMirror.fromTextArea(codeArea, {
        mode: { name: "python", version: 3 },
        theme: "dracula",
        lineNumbers: true,
        indentUnit: 4,
        smartIndent: true,
        matchBrackets: true,
        autofocus: true
    });

    editor.setSize("100%", "100%");
    editor.focus();

    const outputDiv = document.getElementById("output");
    const runBtn = document.getElementById("runBtn");

    pyodideInstance = await loadPyodide({
        stdout: (t) => outputDiv.innerText += t + "\n",
        stderr: (t) => outputDiv.innerText += t + "\n"
    });

    runBtn.disabled = false;

    runBtn.onclick = async () => {
        outputDiv.innerText = "";
        runBtn.disabled = true;
        try {
            await pyodideInstance.runPythonAsync(editor.getValue());
        } finally {
            runBtn.disabled = false;
        }
    };

    editorInitialized = true;
}


// =========================================================
// SIMULASI SELECTION SORT – INTERAKTIF BERPIKIR
// =========================================================

// const IMG_PATH = window.IMG_PATH || '';
// const initialData = [21, 13, 23, 17, 19];

// let arr = [...initialData];
// let i = 0;
// let j = 0;
// let minIndex = 0;

// let container = document.getElementById('simulation-container');


// // ================= RESET =================
// function resetSimulation() {

//     container = document.getElementById('simulation-container');
//     container.innerHTML = '';

//     document.getElementById('finish-message').style.display = "none";

//     arr = [...initialData];
//     i = 0;
//     j = 0;
//     minIndex = 0;

//     startIteration();
// }


// // ================= ITERASI BARU =================
// function startIteration() {

//     if (i >= arr.length - 1) {
//         showFinishMessage();
//         return;
//     }

//     minIndex = i;
//     j = i + 1;

//     createCard(`
//         <strong>Iterasi ke-${i+1}</strong><br>
//         Cari nilai terkecil mulai indeks ${i}. <br>
//         Minimum sementara adalah <b>${arr[i]}</b>.
//     `,
//     renderCans(),
//     `<button class="btn-sim btn-primary" onclick="startScan()">Mulai Scanning</button>`
//     );
// }


// // ================= MULAI SCAN =================
// function startScan() {
//     askCompare();
// }


// // ================= TANYA PERBANDINGAN =================
// function askCompare() {

//     createCard(`
//         Bandingkan <b>${arr[j]}</b> dengan minimum sementara 
//         <b>${arr[minIndex]}</b>.<br><br>
//         Apakah ${arr[j]} lebih kecil?
//     `,
//     renderCans(j),
//     `
//         <button class="btn-sim btn-yes" onclick="answerCompare(true)">Ya</button>
//         <button class="btn-sim btn-no" onclick="answerCompare(false)">Tidak</button>
//     `
//     );
// }


// // ================= CEK JAWABAN COMPARE =================
// function answerCompare(userChoice) {

//     let correct = arr[j] < arr[minIndex];

//     if (userChoice === correct) {

//         Swal.fire({
//             icon: 'success',
//             title: 'Benar!',
//             timer: 900,
//             showConfirmButton: false,
//             didClose: () => {

//                 if (correct) {
//                     minIndex = j;
//                 }

//                 askNextAction();
//             }
//         });

//     } else {

//         Swal.fire({
//             icon: 'error',
//             title: 'Kurang Tepat',
//             text: 'Perhatikan kembali perbandingannya.'
//         });

//     }
// }


// // ================= TANYA LANJUT SCAN =================
// function askNextAction() {

//     if (j < arr.length - 1) {

//         createCard(`
//             Apakah ingin lanjut scan ke elemen berikutnya?
//         `,
//         renderCans(j),
//         `
//             <button class="btn-sim btn-primary" onclick="continueScan()">Lanjut Scan</button>
//         `
//         );

//     } else {

//         askSwapDecision();
//     }
// }


// // ================= LANJUT SCAN =================
// function continueScan() {
//     j++;
//     askCompare();
// }


// // ================= TANYA TUKAR =================
// function askSwapDecision() {

//     createCard(`
//         Scanning selesai.<br>
//         Minimum ditemukan: <b>${arr[minIndex]}</b>.<br><br>
//         Apakah perlu ditukar dengan posisi indeks ${i}?
//     `,
//     renderCans(minIndex),
//     `
//         <button class="btn-sim btn-yes" onclick="answerSwap(true)">Ya, Tukar</button>
//         <button class="btn-sim btn-no" onclick="answerSwap(false)">Tidak</button>
//     `
//     );
// }


// // ================= CEK TUKAR =================
// function answerSwap(userChoice) {

//     let correct = (minIndex !== i);

//     if (userChoice === correct) {

//         Swal.fire({
//             icon: 'success',
//             title: 'Benar!',
//             timer: 900,
//             showConfirmButton: false,
//             didClose: () => {

//                 if (correct) {
//                     [arr[i], arr[minIndex]] = [arr[minIndex], arr[i]];
//                 }

//                 i++;
//                 startIteration();
//             }
//         });

//     } else {

//         Swal.fire({
//             icon: 'error',
//             title: 'Kurang Tepat',
//             text: 'Perhatikan posisi minimum.'
//         });

//     }
// }


// // ================= CREATE CARD =================
// function createCard(text, cansHTML, buttonsHTML) {

//     const cardHTML = `
//         <div class="sim-card fade-in">
//             <div class="sim-header">${text}</div>
//             <div class="sim-body">
//                 <div class="can-container">
//                     ${cansHTML}
//                 </div>
//                 <div class="action-buttons">
//                     ${buttonsHTML}
//                 </div>
//             </div>
//         </div>
//     `;

//     container.insertAdjacentHTML('beforeend', cardHTML);

//     scrollToBottom();
// }


// // ================= RENDER KALENG =================
// function renderCans(highlightIndex = null) {

//     return arr.map((val, idx) => {

//         let cls = 'can-img-wrap';

//         if (idx === highlightIndex) cls += ' scanning';
//         if (idx === minIndex) cls += ' min-found';
//         if (idx === i) cls += ' current-pos';

//         return `
//             <div class="${cls}">
//                 <img src="${IMG_PATH}${val}.png" width="80">
//                 <div class="can-index">Idx: ${idx}</div>
//             </div>
//         `;
//     }).join('');
// }


// // ================= SCROLL STABIL =================
// function scrollToBottom() {

//     setTimeout(() => {

//         const wrapper = document.querySelector('.simulation-wrapper');

//         if (!wrapper) return;

//         wrapper.scrollTop = wrapper.scrollHeight;

//     }, 150);
// }


// // ================= FINISH =================
// function showFinishMessage() {
//     document.getElementById('finish-message').style.display = "block";
//     scrollToBottom();
// }


// // ================= AUTO START =================
// setTimeout(resetSimulation, 500);