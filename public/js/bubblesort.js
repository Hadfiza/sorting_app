/* =========================================================
                        GLOBAL VARIABLE
========================================================= */

// =========================================================
// BAGIAN 2: LOGIKA SIMULASI BUBBLE SORT Revisi (DENGAN ANIMASI)
// =========================================================

const IMG_PATH = window.IMG_PATH || ''; 
const initialData = [4, 2, 5, 1, 3]; 

let arr = [...initialData];
let i = 0; 
let j = 0; 
let isProcessing = false;

let container = document.getElementById('simulation-container');

// --- FUNGSI RESET ---
function resetSimulation() {
    container = document.getElementById('simulation-container');
    const finishMsg = document.getElementById('finish-message');

    container.innerHTML = '';
    if(finishMsg) finishMsg.style.display = 'none';
    
    arr = [...initialData];
    i = 0; j = 0;
    
    nextStep();
}

// --- LOGIKA STEP-BY-STEP ---
function nextStep() {
    if(!container) container = document.getElementById('simulation-container');
    
    const n = arr.length;

    // Cek Selesai
    if (i >= n - 1) {
        showFinishMessage();
        return;
    }

    let valA = arr[j];
    let valB = arr[j+1];

    let explanationText = `
        <div class="mb-2"><span class="badge bg-secondary">Iterasi ke-${i+1} | Langkah ke-${j+1}</span></div>
        Berdasarkan prinsip algoritma Bubble Sort untuk pengurutan <em>ascending</em> (menaik), analisislah apakah kedua elemen tersebut memerlukan pertukaran posisi?
    `;

    let currentArrSnapshot = [...arr]; 
    let highlightIndices = [j, j+1];

    // HTML Template - (DITAMBAHKAN id="book-container-${i}-${j}" UNTUK TARGET ANIMASI)
    const cardHTML = `
    <div class="sim-card fade-in">
        <div class="sim-header" style="font-size: 0.95rem; line-height: 1.5;">${explanationText}</div>
        <div class="sim-body">
            
            <div class="book-container" id="book-container-${i}-${j}">
                ${renderBooksHTML(currentArrSnapshot, highlightIndices)}
            </div>

            <div class="action-buttons" id="action-btn-${i}-${j}">
                <button class="btn-sim btn-tukar fw-bold"
                    onclick="checkAnswer(true, ${valA}, ${valB}, ${j}, ${i})">
                    Perlu Ditukar
                </button>

                <button class="btn-sim btn-stay fw-bold"
                    onclick="checkAnswer(false, ${valA}, ${valB}, ${j}, ${i})">
                    Tidak Ditukar
                </button>
            </div>

            <div id="explanation-${i}-${j}" class="mt-3 p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25" style="display: none;">
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
function checkAnswer(userChoice, valA, valB, idx, iterI) {
    if (isProcessing) return;
    isProcessing = true;

    let correctAnswer = valA > valB; //Ascending

    const actionContainer = document.getElementById(`action-btn-${iterI}-${idx}`);
    const explanationBox = document.getElementById(`explanation-${iterI}-${idx}`);

    if (userChoice === correctAnswer) {
        // Matikan tombol
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
        let actionType = correctAnswer ? 'swap' : 'stay';

        if (correctAnswer) {
            explText = `
                <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Anda Tepat!</div>
                <div class="text-dark" style="font-size: 0.9rem;">
                    Pertukaran <strong>wajib dilakukan</strong> karena nilai Buku Edisi ${valA} lebih besar daripada Edisi ${valB} (${valA} > ${valB}). 
                </div>`;
        } else {
            explText = `
                <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Anda Tepat!</div>
                <div class="text-dark" style="font-size: 0.9rem;">
                    Pertukaran <strong>tidak perlu dilakukan</strong> karena nilai Buku Edisi ${valA} lebih kecil atau sama dengan Edisi ${valB} (${valA} &le; ${valB}). 
                    Kedua elemen tersebut sudah berada pada urutan yang benar untuk langkah saat ini.
                </div>`;
        }

        // DITAMBAHKAN PARAMETER event AGAR TOMBOL BISA DIMATIKAN
        explText += `
            <div class="mt-3 text-end">
                <button class="btn btn-sm btn-success px-4 rounded-pill fw-bold" onclick="proceedNext('${actionType}', ${idx}, ${iterI}, event)">
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
            text: 'Coba evaluasi kembali aturan pengurutan ascending (dari kecil ke besar) pada algoritma Bubble Sort.',
            confirmButtonColor: '#e74c3c'
        }).then(() => {
            isProcessing = false;
        });
    }
}

// --- FUNGSI MELANJUTKAN (TOMBOL DIMATIKAN DISINI) ---
function proceedNext(actionType, idx, iterI, event) {
    if (isProcessing) return;
    isProcessing = true; // Kunci saat animasi berjalan

    // Matikan Tombol
    const btnLanjut = event.currentTarget;
    btnLanjut.disabled = true;
    btnLanjut.style.opacity = '0.6';
    btnLanjut.style.cursor = 'not-allowed';

    if (actionType === 'swap') {
        executeSwapWithAnimation(idx, iterI); // Panggil fungsi animasi
    } else {
        executeStay();
    }
}
// --- FUNGSI ANIMASI TRANSFORM (FUNGSI BARU) ---
function executeSwapWithAnimation(idx, iterI) {
    const bookContainer = document.getElementById(`book-container-${iterI}-${idx}`);
    const books = bookContainer.querySelectorAll('.book-img-wrap');
    
    const bookA = books[idx];
    const bookB = books[idx+1];

    if(!bookA || !bookB) {
        executeSwap(idx); // Jika error, langsung tukar tanpa animasi
        return;
    }

    // Hitung jarak pergeseran
    const distance = bookB.offsetLeft - bookA.offsetLeft;

    // Terapkan Transform (Dilengkapi scale 1.15 agar buku kuning tidak mengecil)
    bookA.style.transform = `translateX(${distance}px) scale(1.15)`;
    bookB.style.transform = `translateX(-${distance}px) scale(1.15)`;

    // Tunggu animasi CSS selesai (600ms), lalu eksekusi array sebenarnya
    setTimeout(() => {
        executeSwap(idx);
    }, 600); 
}

// --- FUNGSI EKSEKUSI perukaran ARRAY --- 
function executeSwap(idx) {
    let temp = arr[idx];
    arr[idx] = arr[idx+1];
    arr[idx+1] = temp;
    advanceLoop();
}

function executeStay() {
    advanceLoop();
}

function advanceLoop() {
    j++;
    if (j >= arr.length - 1 - i) {
        i++;
        j = 0;
        if(i < arr.length - 1) {
            container.insertAdjacentHTML('beforeend', `<div style="text-align:center; padding:15px; color:#aaa; font-style:italic; font-size:0.85rem;">--- Iterasi ${i} Selesai ---</div>`);
        }
    }
    isProcessing = false; // Buka kunci sistem
    nextStep();
}

// --- HELPER FUNCTIONS ---
function renderBooksHTML(dataArr, highlights) {
    return dataArr.map((val, idx) => {
        let activeClass = highlights.includes(idx) ? 'comparing' : '';
        return `
            <div class="book-img-wrap ${activeClass}">
                <img src="${IMG_PATH}edisi${val}.png" width="80" alt="${val}">
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

// // =========================================================
// // BAGIAN 2: LOGIKA SIMULASI BUBBLE SORT
// // =========================================================

// const IMG_PATH = window.IMG_PATH || ''; 
// const initialData = [4, 2, 5, 1, 3]; 

// let arr = [...initialData];
// let i = 0; 
// let j = 0; 
// let isProcessing = false;


// let container = document.getElementById('simulation-container');


// function resetSimulation() {
//     // 1. Ambil elemen
//     container = document.getElementById('simulation-container');
//     const finishMsg = document.getElementById('finish-message');

//     // 2. Bersihkan & Reset
//     container.innerHTML = '';
//     if(finishMsg) finishMsg.style.display = 'none';
    
//     arr = [...initialData];
//     i = 0; j = 0;
    
//     // 3. Langsung jalankan langkah pertama lagi
//     nextStep();
// }

// // --- LOGIKA STEP-BY-STEP ---
// function nextStep() {
//     // Pastikan container terambil (untuk berjaga-jaga jika script load duluan)
//     if(!container) container = document.getElementById('simulation-container');
    
//     const n = arr.length;

//     // Cek Selesai
//     if (i >= n - 1) {
//         showFinishMessage();
//         return;
//     }

//     let valA = arr[j];
//     let valB = arr[j+1];
//     let isSwapNeeded = valA > valB;

//     // Teks Penjelasan
//     let explanationText = `
//         Iterasi ke-${i+1}, langkah ke-${j+1}: Bandingkan data posisi 
//         <strong>${j+1}</strong>  dan data posisi <strong>${j+2}</strong>. 
//     `;
    
//     explanationText += `
//         <br>Apakah buku edisi <strong>${valA}</strong> lebih besar dari buku edisi
//         <strong>${valB}</strong>? 
//         Jika ya, apa yang seharusnya dilakukan?
//     `;


//     // Status Tombol
//     let btnTukarClass = isSwapNeeded ? "btn-tukar active" : "btn-tukar disabled"; 
//     let btnStayClass = !isSwapNeeded ? "btn-stay active" : "btn-stay disabled"; 
    
//     let statusMsg = isSwapNeeded 
//         ? `Klik tombol <strong>Tukar</strong> untuk melanjutkan.`
//         : `Klik tombol <strong>Tidak Ditukar</strong> untuk melanjutkan.`;

//     let currentArrSnapshot = [...arr]; 
//     let highlightIndices = [j, j+1];

//     // HTML Template
//     const cardHTML = `
//     <div class="sim-card fade-in">
//         <div class="sim-header">${explanationText}</div>
//         <div class="sim-body">
//             <div class="iter-title">Proses Iterasi ke-${i+1}</div>
            
//             <div class="book-container">
//                 ${renderBooksHTML(currentArrSnapshot, highlightIndices)}
//             </div>

//             <div class="action-buttons">
//                 <button class="btn-sim btn-tukar"
//                     onclick="checkAnswer(true, ${valA}, ${valB}, ${j})">
//                     Tukar
//                 </button>

//                 <button class="btn-sim btn-stay"
//                     onclick="checkAnswer(false, ${valA}, ${valB}, ${j})">
//                     Tidak Ditukar
//                 </button>
//             </div>

//             <div class="status-text"><small>${statusMsg}</small></div>
//         </div>
//     </div>`;

//     container.insertAdjacentHTML('beforeend', cardHTML);
    
//     // Auto scroll ke elemen baru
//     requestAnimationFrame(() => {
//         const lastCard = container.lastElementChild;
//         if (lastCard) {
//             lastCard.scrollIntoView({
//                 behavior: 'smooth',
//                 block: 'center'
//             });
//         }
//     });

// }

// // --- FUNGSI EKSEKUSI ---
// function executeSwap(idx) {
//     disableLastCardButtons();   
//     let temp = arr[idx];
//     arr[idx] = arr[idx+1];
//     arr[idx+1] = temp;
//     advanceLoop();
// }



// function executeStay() {
//     disableLastCardButtons();
//     advanceLoop();
// }

// function advanceLoop() {
//     j++;
//     if (j >= arr.length - 1 - i) {
//         i++;
//         j = 0;
//         if(i < arr.length - 1) {
//             container.insertAdjacentHTML('beforeend', `<div style="text-align:center; padding:15px; color:#aaa; font-style:italic;">--- Selesai Iterasi ${i} ---</div>`);
//         }
//     }
//     nextStep();
// }

// // --- HELPER FUNCTIONS ---
// function renderBooksHTML(dataArr, highlights) {
//     return dataArr.map((val, idx) => {
//         let activeClass = highlights.includes(idx) ? 'comparing' : '';
//         return `
//             <div class="book-img-wrap ${activeClass}">
//                 <img src="${IMG_PATH}edisi${val}.png" width="80" alt="${val}">
//             </div>
//         `;
//     }).join('');
// }

// function disableLastCardButtons() {
//     const lastCard = container.lastElementChild;
//     if (!lastCard) return;

//     const buttons = lastCard.querySelectorAll('.btn-sim');
//     buttons.forEach(btn => {
//         btn.disabled = true;
//         btn.style.opacity = '0.6';
//         btn.style.cursor = 'not-allowed';
//     });
// }



// function showFinishMessage() {
//     const finishMsg = document.getElementById('finish-message');
//     if(finishMsg) finishMsg.style.display = 'block';
    
//     window.scrollTo(0, document.body.scrollHeight);
// }

// function checkAnswer(userChoice, valA, valB, idx) {

//     if (isProcessing) return;
//     isProcessing = true;

//     // 🔥 VALIDASI PAKAI NILAI YANG DITAMPILKAN
//     let correctAnswer = valA > valB;

//     disableLastCardButtons();

//     if (userChoice === correctAnswer) {

//         if (correctAnswer) {
//             Swal.fire({
//                 icon: 'success',
//                 title: 'Benar!',
//                 text: 'Data ditukar karena nilai kiri lebih besar.',
//                 confirmButtonColor: '#28a745'
//             }).then(() => {
//                 executeSwap(idx);
//                 isProcessing = false;
//             });

//         } else {
//             Swal.fire({
//                 icon: 'success',
//                 title: 'Benar!',
//                 text: 'Data tidak ditukar karena sudah urut.',
//                 confirmButtonColor: '#28a745'
//             }).then(() => {
//                 executeStay();
//                 isProcessing = false;
//             });
//         }

//     } else {

//         Swal.fire({
//             icon: 'error',
//             title: 'Jawaban kurang tepat',
//             text: 'Coba pikirkan kembali.',
//             confirmButtonColor: '#e74c3c'
//         }).then(() => {

//             // aktifkan lagi tombol
//             const lastCard = container.lastElementChild;
//             if (lastCard) {
//                 const buttons = lastCard.querySelectorAll('.btn-sim');
//                 buttons.forEach(btn => {
//                     btn.disabled = false;
//                     btn.style.opacity = '1';
//                 });
//             }

//             isProcessing = false;
//         });

//     }
// }

// // --- AUTO START ---
// nextStep();





















































// const IMG_PATH = window.IMG_PATH || '';

// const initialData = [4, 2, 5, 1, 3];
// let arr = [...initialData];
// let i = 0, j = 0, state = 'START';

// // Ambil elemen DOM (akan tersedia karena script dijalankan di bawah)
// const shelf = document.getElementById('shelf');
// const highlightBox = document.getElementById('highlight-box');
// const explanation = document.getElementById('explanation');
// const mainBtn = document.getElementById('main-btn');
// const iterBadge = document.getElementById('iter-badge');
// const historyContainer = document.getElementById('history-container');

// const startX = 150;
// const gap = 95;

// /* RENDER AWAL */
// function renderBooks() {
//     // Bersihkan buku lama jika ada (kecuali highlight box)
//     document.querySelectorAll('.book-wrap').forEach(e => e.remove());

//     arr.forEach((val, idx) => {
//         const wrap = document.createElement('div');
//         wrap.className = 'book-wrap';
//         wrap.style.left = (startX + idx * gap) + 'px';

//         const img = document.createElement('img');
//         img.src = `${IMG_PATH}edisi${val}.png`;
//         img.className = 'book-img';
//         img.id = `book-${val}`;

//         wrap.appendChild(img);
//         shelf.appendChild(wrap);
//     });
// }

// /* HIGHLIGHT */
// function showHighlight(a, b) {
//     highlightBox.style.display = 'block';

//     const bookWidth = 80;     // lebar buku asli
//     const padding   = 5;

//     const leftX  = startX + a * gap;
//     const rightX = startX + b * gap + 90; // 90 = lebar buku

//     highlightBox.style.left  = (leftX - padding) + 'px';
//     highlightBox.style.width = (rightX - leftX + 2) + 'px';
// }


// /* TOMBOL */
// function setBtn(text, cls) {
//     mainBtn.innerText = text;
//     mainBtn.className = `btn-action ${cls}`;
// }

// /* STATE MACHINE (LOGIKA UTAMA) */
// function nextAction() {
//     const n = arr.length;

//     if (state === 'START') {
//         state = 'COMPARE';
//         i = 0; j = 0;
//         iterBadge.innerText = `Iterasi ke-${i + 1}`;
        
//         setBtn('Cek Edisi', 'btn-cek'); 
        
//         explanation.innerHTML = 'Bandingkan dua buku pertama.';
//         return;
//     }

//     if (state === 'COMPARE') {
//         showHighlight(j, j + 1);
//         const a = arr[j], b = arr[j + 1];

//         explanation.innerHTML = `
//             Bandingkan <strong style="color:#e67e22">Edisi ${a}</strong>
//             dan <strong style="color:#e67e22">Edisi ${b}</strong>.<br>
//         `;

//         if (a > b) {
//             explanation.innerHTML += `
//                 Karena ${a} &gt; ${b}, maka posisi harus
//                 <strong style="color:#e74c3c">DITUKAR</strong>.
//             `;
//             setBtn('LAKUKAN TUKAR', 'btn-swap');
//         } else {
//             explanation.innerHTML += `
//                 Karena ${a} &lt; ${b}, maka posisi
//                 <strong style="color:#27ae60">TETAP</strong>.
//             `;
//             setBtn('POSISI TETAP', 'btn-stay');
//         }
//         state = 'DECIDE';
//         return;
//     }

//     if (state === 'DECIDE') {
//         const a = arr[j], b = arr[j + 1];

//         if (a > b) {
//             [arr[j], arr[j + 1]] = [b, a];
//             swapVisuals(a, b, j, j + 1);
//         }
//         j++;

//         if (j >= n - 1 - i) {
//             // Selesai satu putaran iterasi
//             addHistoryRow(`Iterasi ${i + 1}`, [...arr]);
//             i++; 
//             j = 0;
//             highlightBox.style.display = 'none';

//             if (i >= n - 1) {
//                 finish();
//                 return;
//             }

//             iterBadge.innerText = `Iterasi ke-${i + 1}`;
//             explanation.innerHTML = 'Iterasi sebelumnya selesai.';
//             setBtn('Lanjut Iterasi', 'btn-start');
//             state = 'COMPARE';
//         } else {
//             // Lanjut ke pasangan berikutnya dalam iterasi yang sama
//             state = 'COMPARE';
            
//             // PERBAIKAN: Ganti 'btn-check' jadi 'btn-cek'
//             setBtn('Cek Berikutnya', 'btn-cek');
//         }
//     }
// }

// /* FINISH STATE */
// function finish() {
//     iterBadge.innerText = 'SELESAI';
//     explanation.innerHTML = '<strong style="color:#27ae60">DATA SUDAH TERURUT!</strong>';
//     mainBtn.style.display = 'none'; // Sembunyikan tombol
//     highlightBox.style.display = 'none';
// }

// /* SWAP VISUAL */
// function swapVisuals(v1, v2, idx1, idx2) {
//     const el1 = document.getElementById(`book-${v1}`).parentElement;
//     const el2 = document.getElementById(`book-${v2}`).parentElement;

//     el1.style.left = (startX + idx2 * gap) + 'px';
//     el2.style.left = (startX + idx1 * gap) + 'px';
// }

// /* HISTORY ROW */
// function addHistoryRow(label, arrSnapshot) {
//     const row = document.createElement('div');
//     row.className = 'history-row';

//     let html = `<strong>${label}</strong>&nbsp;`;

//     arrSnapshot.forEach(v => {
//         html += `<img src="${IMG_PATH}edisi${v}.png" class="mini-book-img">`;
//     });

//     row.innerHTML = html;
//     historyContainer.appendChild(row);
// }
