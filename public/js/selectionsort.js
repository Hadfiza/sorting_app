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
        updateSidebarActive(i);
        updateButtonState();

        // 🔥 INIT EDITOR SAAT HALAMAN PROGRAM
        if (materiPages[i].querySelector('#code')) {
            setTimeout(() => {
                initPythonEditor();
                editor.refresh(); // WAJIB
            }, 50);
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }


    function updateButtonState() {
        if (btnPrev) btnPrev.disabled = materiIndex === 0;
        if (btnNext) btnNext.disabled = materiIndex === materiPages.length - 1;
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
    

    // JALANKAN EDITOR
    initPythonEditor();
});

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

const IMG_PATH = window.IMG_PATH || '';
const initialData = [21, 13, 23, 17, 19];

let arr = [...initialData];
let i = 0;
let j = 0;
let minIndex = 0;

let container = document.getElementById('simulation-container');


// ================= RESET =================
function resetSimulation() {

    container = document.getElementById('simulation-container');
    container.innerHTML = '';

    document.getElementById('finish-message').style.display = "none";

    arr = [...initialData];
    i = 0;
    j = 0;
    minIndex = 0;

    startIteration();
}


// ================= ITERASI BARU =================
function startIteration() {

    if (i >= arr.length - 1) {
        showFinishMessage();
        return;
    }

    minIndex = i;
    j = i + 1;

    createCard(`
        <strong>Iterasi ke-${i+1}</strong><br>
        Cari nilai terkecil mulai indeks ${i}. <br>
        Minimum sementara adalah <b>${arr[i]}</b>.
    `,
    renderCans(),
    `<button class="btn-sim btn-primary" onclick="startScan()">Mulai Scanning</button>`
    );
}


// ================= MULAI SCAN =================
function startScan() {
    askCompare();
}


// ================= TANYA PERBANDINGAN =================
function askCompare() {

    createCard(`
        Bandingkan <b>${arr[j]}</b> dengan minimum sementara 
        <b>${arr[minIndex]}</b>.<br><br>
        Apakah ${arr[j]} lebih kecil?
    `,
    renderCans(j),
    `
        <button class="btn-sim btn-yes" onclick="answerCompare(true)">Ya</button>
        <button class="btn-sim btn-no" onclick="answerCompare(false)">Tidak</button>
    `
    );
}


// ================= CEK JAWABAN COMPARE =================
function answerCompare(userChoice) {

    let correct = arr[j] < arr[minIndex];

    if (userChoice === correct) {

        Swal.fire({
            icon: 'success',
            title: 'Benar!',
            timer: 900,
            showConfirmButton: false,
            didClose: () => {

                if (correct) {
                    minIndex = j;
                }

                askNextAction();
            }
        });

    } else {

        Swal.fire({
            icon: 'error',
            title: 'Kurang Tepat',
            text: 'Perhatikan kembali perbandingannya.'
        });

    }
}


// ================= TANYA LANJUT SCAN =================
function askNextAction() {

    if (j < arr.length - 1) {

        createCard(`
            Apakah ingin lanjut scan ke elemen berikutnya?
        `,
        renderCans(j),
        `
            <button class="btn-sim btn-primary" onclick="continueScan()">Lanjut Scan</button>
        `
        );

    } else {

        askSwapDecision();
    }
}


// ================= LANJUT SCAN =================
function continueScan() {
    j++;
    askCompare();
}


// ================= TANYA TUKAR =================
function askSwapDecision() {

    createCard(`
        Scanning selesai.<br>
        Minimum ditemukan: <b>${arr[minIndex]}</b>.<br><br>
        Apakah perlu ditukar dengan posisi indeks ${i}?
    `,
    renderCans(minIndex),
    `
        <button class="btn-sim btn-yes" onclick="answerSwap(true)">Ya, Tukar</button>
        <button class="btn-sim btn-no" onclick="answerSwap(false)">Tidak</button>
    `
    );
}


// ================= CEK TUKAR =================
function answerSwap(userChoice) {

    let correct = (minIndex !== i);

    if (userChoice === correct) {

        Swal.fire({
            icon: 'success',
            title: 'Benar!',
            timer: 900,
            showConfirmButton: false,
            didClose: () => {

                if (correct) {
                    [arr[i], arr[minIndex]] = [arr[minIndex], arr[i]];
                }

                i++;
                startIteration();
            }
        });

    } else {

        Swal.fire({
            icon: 'error',
            title: 'Kurang Tepat',
            text: 'Perhatikan posisi minimum.'
        });

    }
}


// ================= CREATE CARD =================
function createCard(text, cansHTML, buttonsHTML) {

    const cardHTML = `
        <div class="sim-card fade-in">
            <div class="sim-header">${text}</div>
            <div class="sim-body">
                <div class="can-container">
                    ${cansHTML}
                </div>
                <div class="action-buttons">
                    ${buttonsHTML}
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', cardHTML);

    scrollToBottom();
}


// ================= RENDER KALENG =================
function renderCans(highlightIndex = null) {

    return arr.map((val, idx) => {

        let cls = 'can-img-wrap';

        if (idx === highlightIndex) cls += ' scanning';
        if (idx === minIndex) cls += ' min-found';
        if (idx === i) cls += ' current-pos';

        return `
            <div class="${cls}">
                <img src="${IMG_PATH}${val}.png" width="80">
                <div class="can-index">Idx: ${idx}</div>
            </div>
        `;
    }).join('');
}


// ================= SCROLL STABIL =================
function scrollToBottom() {

    setTimeout(() => {

        const wrapper = document.querySelector('.simulation-wrapper');

        if (!wrapper) return;

        wrapper.scrollTop = wrapper.scrollHeight;

    }, 150);
}


// ================= FINISH =================
function showFinishMessage() {
    document.getElementById('finish-message').style.display = "block";
    scrollToBottom();
}


// ================= AUTO START =================
setTimeout(resetSimulation, 500);
