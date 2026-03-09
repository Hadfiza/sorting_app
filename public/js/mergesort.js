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

// SIMULASI

// ===============================
// SIMULASI MERGE SORT (FINAL)
// ===============================


const IMG_PATH = window.IMG_PATH || '';

const initialData = [
    { id: 'b1', val: 8 },
    { id: 'b2', val: 3 },
    { id: 'b3', val: 9 },
    { id: 'b4', val: 4 },
    { id: 'b5', val: 6 }
];

// ===============================
// GLOBAL
// ===============================
let queue = [];
let currentTask = null;
let currentCardId = null;
let container = document.getElementById('simulation-container');

// ===============================
// STATE MERGE
// ===============================
let mergeState = {
    leftArr: [],
    rightArr: [],
    resultArr: [],
    i: 0,
    j: 0,
    phase: 'COMPARE',   // COMPARE | MOVE
    nextMove: null,     // LEFT | RIGHT
    highlightCompare: false
};

// ===============================
// RESET
// ===============================
function resetSimulation() {
    container.innerHTML = '';
    queue = [];
    generateTasks([...initialData]);
    processNextTask();
}

// ===============================
// GENERATE TASK (REKURSIF)
// ===============================
function generateTasks(arr) {
    if (arr.length <= 1) return arr;

    const mid = Math.floor(arr.length / 2);
    const left = arr.slice(0, mid);
    const right = arr.slice(mid);

    queue.push({ type: 'DIVIDE', left, right });

    const sortedLeft = generateTasks(left);
    const sortedRight = generateTasks(right);

    queue.push({ type: 'MERGE', left: sortedLeft, right: sortedRight });

    return [...sortedLeft, ...sortedRight].sort((a, b) => a.val - b.val);
}

// ===============================
// PROCESS TASK
// ===============================
function processNextTask() {

    // ===============================
    // JIKA SEMUA TUGAS SELESAI
    // ===============================
    if (queue.length === 0) {

        const lastCard = container.lastElementChild;
        if (lastCard) {
            const btnArea = lastCard.querySelector('.action-buttons');
            if (btnArea) {
                btnArea.remove(); 
            }
        }


        // Tampilkan kartu selesai
        container.insertAdjacentHTML('beforeend', `
            <div class="sim-card fade-in" style="
                margin-top:30px;
                padding:30px;
                background:#eafaf1;
                border:2px solid #27ae60;
                border-radius:12px;
                text-align:center;
            ">
                <h3 style="color:#1e8449;">
                    <i class="fa fa-check-circle"></i>
                    Pengurutan Selesai!
                </h3>

                <button class="btn-sim active" 
                        style="margin-top:15px; background:#27ae60;"
                        onclick="resetSimulation()">
                    Ulangi Simulasi
                </button>
            </div>
        `);

        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: "smooth"
        });

        return;
    }

    // ===============================
    // LANJUT TASK NORMAL
    // ===============================
    currentTask = queue.shift();
    currentCardId = `card-${Date.now()}`;

    if (currentTask.type === 'DIVIDE') {
        renderDivideCard();
    } else {
        initMergeState();
        renderMergeCard();
    }
}


// ===============================
// INIT MERGE STATE
// ===============================
function initMergeState() {
    mergeState = {
        leftArr: currentTask.left,
        rightArr: currentTask.right,
        resultArr: [],
        i: 0,
        j: 0,
        phase: 'COMPARE',
        nextMove: null,
        highlightCompare: false
    };
}

// ===============================
// DIVIDE CARD
// ===============================
function renderDivideCard() {
    const html = `
    <div class="sim-card fade-in" id="${currentCardId}">
        <div class="sim-header">
            <strong>MEMECAH DATA (DIVIDE)</strong>
        </div>
        <div class="sim-body">
            <div class="book-container">
                <div class="group-box" data-label="KIRI">
                    ${renderBooksHTML(currentTask.left)}
                </div>
                <div class="group-box" data-label="KANAN">
                    ${renderBooksHTML(currentTask.right)}
                </div>
            </div>
            <div class="action-buttons">
                <button class="btn-sim active" onclick="processNextTask()">Lanjut</button>
            </div>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    scrollToCard();
}

// ===============================
// MERGE CARD (DOM TETAP)
// ===============================
function renderMergeCard() {
    const html = `
    <div class="sim-card fade-in" id="${currentCardId}">
        <div class="sim-header">
            <strong>MENGGABUNG & MENGURUTKAN (MERGE)</strong>
            <p class="exp-text">Bandingkan nilai kiri dan kanan.</p>
        </div>
        <div class="sim-body">
            <div class="book-container">
                <div class="group-box" data-label="KIRI" id="${currentCardId}-left"></div>
                <div class="group-box" data-label="KANAN" id="${currentCardId}-right"></div>
                <div class="group-box result-group" data-label="HASIL (URUT)" id="${currentCardId}-result"></div>
            </div>
            <div class="action-buttons">
                <button class="btn-sim active" onclick="stepMerge()">Cek Kondisi</button>
            </div>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    updateMergeVisuals();
    scrollToCard();
}

// ===============================
// STEP MERGE (INTI LOGIKA)
// ===============================
function stepMerge() {
    const { leftArr, rightArr, i, j, phase } = mergeState;

    // SELESAI SEGMENT
    if (i >= leftArr.length && j >= rightArr.length) {
        document.querySelector(`#${currentCardId} .exp-text`)
            .innerHTML = '<strong>SELESAI!</strong> Segmen ini telah terurut.';
        document.querySelector(`#${currentCardId} .action-buttons`)
            .innerHTML = `<button class="btn-sim active" onclick="processNextTask()">Lanjut</button>`;
        return;
    }

    // =====================
    // FASE COMPARE
    // =====================
    if (mergeState.phase === 'COMPARE') {

        // =========================
        // JIKA KIRI HABIS
        // =========================
        if (mergeState.i >= mergeState.leftArr.length) {
            mergeState.nextMove = 'RIGHT';
            mergeState.moveReason = 'LEFT_EMPTY';
            mergeState.phase = 'MOVE';
            mergeState.highlightCompare = false;
            updateMergeVisuals();
            return;
        }

        // =========================
        // JIKA KANAN HABIS
        // =========================
        if (mergeState.j >= mergeState.rightArr.length) {
            mergeState.nextMove = 'LEFT';
            mergeState.moveReason = 'RIGHT_EMPTY';
            mergeState.phase = 'MOVE';
            mergeState.highlightCompare = false;
            updateMergeVisuals();
            return;
        }

        // =========================
        // BARU BOLEH BANDINGKAN
        // =========================
        mergeState.highlightCompare = true;
        mergeState.moveReason = 'COMPARE';

        if (mergeState.leftArr[mergeState.i].val <= mergeState.rightArr[mergeState.j].val) {
            mergeState.nextMove = 'LEFT';
        } else {
            mergeState.nextMove = 'RIGHT';
        }

        mergeState.phase = 'MOVE';
        updateMergeVisuals();
        return;
    }


    // =====================
    // FASE MOVE
    // =====================
    else if (phase === 'MOVE') {
        mergeState.highlightCompare = false;

        if (mergeState.nextMove === 'LEFT') {
            mergeState.resultArr.push(leftArr[i]);
            mergeState.i++;
        } else {
            mergeState.resultArr.push(rightArr[j]);
            mergeState.j++;
        }

        mergeState.phase = 'COMPARE';
    }

    updateMergeVisuals();
}

// ===============================
// UPDATE VISUAL (TANPA HAPUS DOM)
// ===============================
function updateMergeVisuals() {
    const leftBox   = document.getElementById(`${currentCardId}-left`);
    const rightBox  = document.getElementById(`${currentCardId}-right`);
    const resultBox = document.getElementById(`${currentCardId}-result`);
    const card      = document.getElementById(currentCardId);

    leftBox.innerHTML = renderBooksWithIndex(
        mergeState.leftArr,
        mergeState.i,
        mergeState.highlightCompare ? 'comparing' : ''
    );

    rightBox.innerHTML = renderBooksWithIndex(
        mergeState.rightArr,
        mergeState.j,
        mergeState.highlightCompare ? 'comparing' : ''
    );

    resultBox.innerHTML = mergeState.resultArr.map(item => `
        <div class="book-img-wrap merged-item">
            <img src="${IMG_PATH}${item.val}.png">
            <span class="book-label">${item.val}</span>
        </div>
    `).join('');

    const btn = card.querySelector('.action-buttons button');
    const exp = card.querySelector('.exp-text');

    if (mergeState.phase === 'COMPARE') {

        const leftVal  = mergeState.i < mergeState.leftArr.length
            ? mergeState.leftArr[mergeState.i].val
            : '-';

        const rightVal = mergeState.j < mergeState.rightArr.length
            ? mergeState.rightArr[mergeState.j].val
            : '-';

        exp.innerHTML = `
            Bandingkan nilai <b>KIRI (${leftVal})</b>
            dengan <b>KANAN (${rightVal})</b>.
        `;
        btn.innerText = 'Cek Kondisi';

    } else {
    let chosenVal, source, reasonText;

    if (mergeState.nextMove === 'LEFT') {
        chosenVal = mergeState.leftArr[mergeState.i].val;
        source = 'KIRI';
    } else {
        chosenVal = mergeState.rightArr[mergeState.j].val;
        source = 'KANAN';
    }

    if (mergeState.moveReason === 'COMPARE') {
        reasonText = `Karena nilai <b>${chosenVal}</b> dari <b>${source}</b> lebih kecil,`;
    }
    else if (mergeState.moveReason === 'LEFT_EMPTY') {
        reasonText = `Karena <b>seluruh elemen KIRI telah habis</b>,`;
    }
    else if (mergeState.moveReason === 'RIGHT_EMPTY') {
        reasonText = `Karena <b>seluruh elemen KANAN telah habis</b>,`;
    }

    exp.innerHTML = `
        ${reasonText}
        maka nilai <b>${chosenVal}</b> dipindahkan ke <b>HASIL</b>.
    `;

    btn.innerText = 'Pindahkan ke Hasil';
}


}

// ===============================
// RENDER HELPER
// ===============================
function renderBooksHTML(arr) {
    return arr.map(item => `
        <div class="book-img-wrap">
            <img src="${IMG_PATH}${item.val}.png">
            <span class="book-label">${item.val}</span>
        </div>
    `).join('');
}

function renderBooksWithIndex(arr, currentIndex, highlightClass) {
    return arr
        .slice(currentIndex) // 🔥 INI KUNCI UTAMA
        .map((item, idx) => `
            <div class="book-img-wrap ${idx === 0 ? highlightClass : ''}">
                <img src="${IMG_PATH}${item.val}.png">
                <span class="book-label">${item.val}</span>
            </div>
        `)
        .join('');
}


function scrollToCard() {
    setTimeout(() => {
        document.getElementById(currentCardId)
            .scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 100);
}

// ===============================
// AUTO START
// ===============================
setTimeout(resetSimulation, 500);
