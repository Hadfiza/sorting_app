/* =========================================================
                        GLOBAL VARIABLE
========================================================= */


// =========================================================
// BAGIAN 1: NAVIGASI MATERI
// =========================================================
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
        // updateSidebarActive(i); // Aktifkan jika sidebar logic ada
        updateButtonState();
        window.scrollTo({ top: 0, behavior: 'smooth' });

        const page = materiPages[i];
        if (page.querySelector('#code')) {
            setTimeout(() => {
                initPythonEditor();
                if (editor) editor.refresh();
            }, 50);
        }
    }

    function updateButtonState() {
        if (btnPrev) {
            const isFirst = materiIndex === 0;
            btnPrev.disabled = isFirst;
            btnPrev.classList.toggle('btn-disabled', isFirst);
            btnPrev.classList.toggle('btn-active', !isFirst);
        }

        if (btnNext) {
            const isLast = materiIndex === materiPages.length - 1;
            btnNext.disabled = isLast;
            btnNext.classList.toggle('btn-disabled', isLast);
            btnNext.classList.toggle('btn-active', !isLast);
        }
    }


    window.goMateri = function(i){ tampilMateri(i); }
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

    // Init halaman pertama
    tampilMateri(0);
    
    // Init Simulasi (Render awal buku)
    renderBooks();
    addHistoryRow('Data Awal', [...arr]);

});

// =========================================================
// BAGIAN 2: LOGIKA SIMULASI BUBBLE SORT
// =========================================================

const IMG_PATH = window.IMG_PATH || ''; 
const initialData = [4, 2, 5, 1, 3]; 

let arr = [...initialData];
let i = 0; 
let j = 0; 
let isProcessing = false;


let container = document.getElementById('simulation-container');

// --- FUNGSI RESET (Dimodifikasi agar langsung mulai ulang tanpa tombol start) ---
function resetSimulation() {
    // 1. Ambil elemen
    container = document.getElementById('simulation-container');
    const finishMsg = document.getElementById('finish-message');

    // 2. Bersihkan & Reset
    container.innerHTML = '';
    if(finishMsg) finishMsg.style.display = 'none';
    
    arr = [...initialData];
    i = 0; j = 0;
    
    // 3. Langsung jalankan langkah pertama lagi
    nextStep();
}

// --- LOGIKA STEP-BY-STEP ---
function nextStep() {
    // Pastikan container terambil (untuk berjaga-jaga jika script load duluan)
    if(!container) container = document.getElementById('simulation-container');
    
    const n = arr.length;

    // Cek Selesai
    if (i >= n - 1) {
        showFinishMessage();
        return;
    }

    let valA = arr[j];
    let valB = arr[j+1];
    let isSwapNeeded = valA > valB;

    // Teks Penjelasan
    let explanationText = `
        Iterasi ke-${i+1}, langkah ke-${j+1}: Bandingkan data posisi 
        <strong>${j+1}</strong>  dan data posisi <strong>${j+2}</strong>. 
    `;
    
    explanationText += `
        <br>Apakah buku edisi <strong>${valA}</strong> lebih besar dari buku edisi
        <strong>${valB}</strong>? 
        Jika ya, apa yang seharusnya dilakukan?
    `;


    // Status Tombol
    let btnTukarClass = isSwapNeeded ? "btn-tukar active" : "btn-tukar disabled"; 
    let btnStayClass = !isSwapNeeded ? "btn-stay active" : "btn-stay disabled"; 
    
    let statusMsg = isSwapNeeded 
        ? `Klik tombol <strong>Tukar</strong> untuk melanjutkan.`
        : `Klik tombol <strong>Tidak Ditukar</strong> untuk melanjutkan.`;

    let currentArrSnapshot = [...arr]; 
    let highlightIndices = [j, j+1];

    // HTML Template
    const cardHTML = `
    <div class="sim-card fade-in">
        <div class="sim-header">${explanationText}</div>
        <div class="sim-body">
            <div class="iter-title">Proses Iterasi ke-${i+1}</div>
            
            <div class="book-container">
                ${renderBooksHTML(currentArrSnapshot, highlightIndices)}
            </div>

            <div class="action-buttons">
                <button class="btn-sim btn-tukar"
                    onclick="checkAnswer(true, ${valA}, ${valB}, ${j})">
                    Tukar
                </button>

                <button class="btn-sim btn-stay"
                    onclick="checkAnswer(false, ${valA}, ${valB}, ${j})">
                    Tidak Ditukar
                </button>
            </div>

            <div class="status-text"><small>${statusMsg}</small></div>
        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', cardHTML);
    
    // Auto scroll ke elemen baru
    requestAnimationFrame(() => {
        const lastCard = container.lastElementChild;
        if (lastCard) {
            lastCard.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    });

}

// --- FUNGSI EKSEKUSI ---
function executeSwap(idx) {
    disableLastCardButtons();   
    let temp = arr[idx];
    arr[idx] = arr[idx+1];
    arr[idx+1] = temp;
    advanceLoop();
}



function executeStay() {
    disableLastCardButtons();
    advanceLoop();
}

function advanceLoop() {
    j++;
    if (j >= arr.length - 1 - i) {
        i++;
        j = 0;
        if(i < arr.length - 1) {
            container.insertAdjacentHTML('beforeend', `<div style="text-align:center; padding:15px; color:#aaa; font-style:italic;">--- Selesai Iterasi ${i} ---</div>`);
        }
    }
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

function disableLastCardButtons() {
    const lastCard = container.lastElementChild;
    if (!lastCard) return;

    const buttons = lastCard.querySelectorAll('.btn-sim');
    buttons.forEach(btn => {
        btn.disabled = true;
        btn.style.opacity = '0.6';
        btn.style.cursor = 'not-allowed';
    });
}



function showFinishMessage() {
    const finishMsg = document.getElementById('finish-message');
    if(finishMsg) finishMsg.style.display = 'block';
    
    window.scrollTo(0, document.body.scrollHeight);
}

function checkAnswer(userChoice, valA, valB, idx) {

    if (isProcessing) return;
    isProcessing = true;

    // 🔥 VALIDASI PAKAI NILAI YANG DITAMPILKAN
    let correctAnswer = valA > valB;

    disableLastCardButtons();

    if (userChoice === correctAnswer) {

        if (correctAnswer) {
            Swal.fire({
                icon: 'success',
                title: 'Benar!',
                text: 'Data ditukar karena nilai kiri lebih besar.',
                confirmButtonColor: '#28a745'
            }).then(() => {
                executeSwap(idx);
                isProcessing = false;
            });

        } else {
            Swal.fire({
                icon: 'success',
                title: 'Benar!',
                text: 'Data tidak ditukar karena sudah urut.',
                confirmButtonColor: '#28a745'
            }).then(() => {
                executeStay();
                isProcessing = false;
            });
        }

    } else {

        Swal.fire({
            icon: 'error',
            title: 'Jawaban kurang tepat',
            text: 'Coba pikirkan kembali.',
            confirmButtonColor: '#e74c3c'
        }).then(() => {

            // aktifkan lagi tombol
            const lastCard = container.lastElementChild;
            if (lastCard) {
                const buttons = lastCard.querySelectorAll('.btn-sim');
                buttons.forEach(btn => {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                });
            }

            isProcessing = false;
        });

    }
}




// --- AUTO START ---
nextStep();





// =========================================================
// BAGIAN 4: LOGIKA KUIS
// =========================================================
document.addEventListener('DOMContentLoaded', function () {

    const kunciJawaban = {
        q1: 'B',
        q2: 'C',
        q3: 'B',
        q4: 'A',
        q5: 'D'
    };

    let indexSoal = 0;
    const daftarSoal = document.querySelectorAll('.soal');

    function tampilkanSoal(i){
        daftarSoal.forEach((soal, idx)=>{
            soal.classList.toggle('d-none', idx !== i);
        });
        indexSoal = i;
    }

    function nextSoal(){
        if(indexSoal < daftarSoal.length - 1){
            tampilkanSoal(indexSoal + 1);
        } else {
            hitungNilai();
        }
    }

    function prevSoal(){
        if(indexSoal > 0){
            tampilkanSoal(indexSoal - 1);
        }
    }

    function hitungNilai(){
        let benar = 0;

        for(const key in kunciJawaban){
            const jawaban = document.querySelector(`input[name="${key}"]:checked`);
            if(jawaban && jawaban.value === kunciJawaban[key]){
                benar++;
            }
        }

        Swal.fire({
            title: 'Hasil Kuis',
            html: `
              <p>Jawaban benar: <b>${benar} dari ${Object.keys(kunciJawaban).length}</b></p>
              <p>Skor: <b>${benar * 20}</b></p>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ulangi',
            cancelButtonText: 'Selesai'
        }).then((result)=>{
            if(result.isConfirmed){
                resetKuis();
            }
        });
    }

    function resetKuis(){
        document.querySelectorAll('input[type="radio"]').forEach(r=>r.checked=false);
        tampilkanSoal(0);
    }

    // expose
    window.nextSoal = nextSoal;
    window.prevSoal = prevSoal;

    tampilkanSoal(0);
});















































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
