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



// Simulasi

const IMG_PATH = window.IMG_PATH || '';

/* ===============================
   DATA AWAL Nama kartu meja
   =============================== */
const initialData = [
    { id: 'f1', val: 'SINTA' },
    { id: 'f2', val: 'AKMAL' },
    { id: 'f3', val: 'FITRI' },
    { id: 'f4', val: 'BUDI' },
    { id: 'f5', val: 'YAHYA' }
];

/* ===============================
   CONFIG LAYOUT
   =============================== */
const FILE_WIDTH = 100;
const GAP = 40;

/* ===============================
   GLOBAL STATE
   =============================== */
let arr = [];
let i = 1;
let j = 0;
let keyObj = null;
let currentCardId = null;

const STATE = {
    PICK_KEY: 'PICK_KEY',
    COMPARE: 'COMPARE',
    SHIFT: 'SHIFT',
    INSERT: 'INSERT',
    FINISHED: 'FINISHED'
};

let currentState = STATE.PICK_KEY;
let container = document.getElementById('simulation-container');

/* ===============================
   UTIL – POSISI TENGAH
   =============================== */
function getCenteredLeft(index, total) {
    const totalWidth = total * FILE_WIDTH + (total - 1) * GAP;
    const startX = (container.clientWidth - totalWidth) / 2;
    return startX + index * (FILE_WIDTH + GAP);
}

/* ===============================
   RESET
   =============================== */
function resetSimulation() {
    container.innerHTML = '';
    const finishMsg = document.getElementById('finish-message');
    if (finishMsg) finishMsg.style.display = 'none';

    arr = initialData.map(item => ({ ...item }));
    i = 1;
    j = 0;
    keyObj = null;
    currentState = STATE.PICK_KEY;

    nextStep();
}

/* ===============================
   STATE MACHINE
   =============================== */
function nextStep() {
    if (currentState === STATE.FINISHED) {
        document.getElementById('finish-message').style.display = 'block';
        if (currentCardId) disableButtonsInCard(currentCardId);
        return;
    }

    let text = '';
    let btnLabel = '';
    let btnFunc = '';
    let btnClass = 'btn-sim active';

    let vState = {
        keyId: keyObj ? keyObj.id : null,
        compareIndex: -1,
        sortedLimit: i - 1
    };

    switch (currentState) {

        case STATE.PICK_KEY:
            if (i >= arr.length) {
                currentState = STATE.FINISHED;
                nextStep();
                return;
            }

            keyObj = arr[i];
            j = i - 1;
            arr[i] = null;

            const snapshot = [...arr];
            snapshot[i] = keyObj;

            createNewCard(i, snapshot);

            // text = `Sisipkan <b>KEY (${keyObj.val})</b> ke kiri`;
            text = `
            Ambil <b>KEY arsip(${keyObj.val})</b> untuk dibandingkan dengan arsip
            bagian kiri yang sudah terurut
            `;
            btnLabel = 'Mulai Bandingkan';
            btnFunc = 'startCompare()';

            vState.keyId = keyObj.id;
            break;

        case STATE.COMPARE:

            const leftValue = arr[j] ? arr[j].val : '-';

            text = `
            Perhatikan arsip di sebelah kiri.<br><br>
            Apakah <b>${leftValue}</b> secara alfabet 
            lebih besar dari <b>${keyObj.val}</b> ?
            `;

            btnLabel = `
                <button class="btn-sim btn-yes" onclick="answerCompare(true)">Ya</button>
                <button class="btn-sim btn-no" onclick="answerCompare(false)">Tidak</button>
            `;

            btnFunc = null;
            vState.keyId = keyObj.id;
            vState.compareIndex = j;

            break;



        case STATE.SHIFT:
            // text = `Karena <b>${arr[j].val}</b> > <b>${keyObj.val}</b>, geser file ke kanan`;
            text = `
            Karena <b>${arr[j].val}</b> secara alfabet lebih besar dari
            <b>${keyObj.val}</b>, maka file disisipkan ke kanan
            `;
            btnLabel = 'Sisipkan';
            btnFunc = 'executeShift()';
            btnClass = 'btn-sim btn-swap';

            vState.keyId = keyObj.id;
            vState.compareIndex = j;
            break;

        case STATE.INSERT:
            // text = `Sisipkan <b>KEY (${keyObj.val})</b> ke indeks <b>${j + 1}</b>`;
            text = `
            <b>KEY (${keyObj.val})</b> sudah berada pada posisi yang benar,
            sehingga tidak perlu disisipkan
            `;
            btnLabel = 'Sisipkan';
            btnFunc = 'executeInsert()';

            vState.keyId = keyObj.id;
            break;
    }

    updateVisuals(text, btnLabel, btnFunc, btnClass, vState);
}

/* ===============================
            AKSI TOMBOL
   =============================== */
function startCompare() {
    currentState = STATE.COMPARE;
    nextStep();
}

function checkCondition() {
    if (
        j >= 0 &&
        arr[j] &&
        arr[j].val.localeCompare(keyObj.val, 'id') > 0
    ) {
        currentState = STATE.SHIFT;
    } else {
        currentState = STATE.INSERT;
    }
    nextStep();
}

function executeShift() {
    arr[j + 1] = arr[j];
    arr[j] = null;
    j--;
    currentState = STATE.COMPARE;
    nextStep();
}

function executeInsert() {
    arr[j + 1] = keyObj;
    i++;
    currentState = STATE.PICK_KEY;
    disableButtonsInCard(currentCardId);
    nextStep();
}

/* ===============================
   VISUAL
   =============================== */
function createNewCard(iterIdx, data) {
    if (currentCardId) disableButtonsInCard(currentCardId);
    currentCardId = `card-${iterIdx}`;

    const html = `
    <div class="sim-card fade-in" id="${currentCardId}">
        <div class="sim-header">
            <b>Iterasi ke-${iterIdx}</b>
            <p class="exp-text"></p>
        </div>
        <div class="sim-body">
            <div class="file-container">
                ${generateInitialDOM(data)}
            </div>
            <div class="action-buttons"></div>
        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
}

function generateInitialDOM(data) {
    const total = data.filter(Boolean).length;

    return data.map((item, idx) => {
        if (!item) return '';
        const left = getCenteredLeft(idx, total);
        return `
        <div class="file-wrap" id="${currentCardId}-${item.id}" style="left:${left}px">
            <img src="${IMG_PATH}${item.val.toLowerCase()}.png">
            <span class="file-label">${item.val}</span>
        </div>`;
    }).join('');
}

function updateVisuals(text, btnLabel, btnFunc, btnClass, v) {
    const card = document.getElementById(currentCardId);
    if (!card) return;

    card.querySelector('.exp-text').innerHTML = text;

    // 🔥 FIX DI SINI
    if (btnFunc) {
        // kalau single button
        card.querySelector('.action-buttons').innerHTML =
            `<button class="${btnClass}" onclick="${btnFunc}">${btnLabel}</button>`;
    } else {
        // kalau multiple button (Ya / Tidak)
        card.querySelector('.action-buttons').innerHTML = btnLabel;
    }

    const total = arr.filter(Boolean).length;

    arr.forEach((item, idx) => {
        if (!item) return;
        const el = document.getElementById(`${currentCardId}-${item.id}`);
        if (!el) return;

        el.className = 'file-wrap';
        el.style.left = `${getCenteredLeft(idx, total)}px`;

        if (idx <= v.sortedLimit) el.classList.add('is-sorted');
        if (idx === v.compareIndex) el.classList.add('comparing');
    });

    if (v.keyId) {
        const keyEl = document.getElementById(`${currentCardId}-${v.keyId}`);
        if (keyEl) {
            keyEl.className = 'file-wrap is-key';
            const target = currentState === STATE.PICK_KEY ? i : j + 1;
            keyEl.style.left = `${getCenteredLeft(target, total)}px`;
        }
    }
}


function disableButtonsInCard(id) {
    const card = document.getElementById(id);
    if (card) {
        card.querySelector('.action-buttons').innerHTML =
            `<small class="text-muted">✓ Selesai</small>`;
    }
}

function answerCompare(userChoice) {

    const condition =
        j >= 0 &&
        arr[j] &&
        arr[j].val.localeCompare(keyObj.val, 'id') > 0;

    if (userChoice === condition) {

        Swal.fire({
            icon: 'success',
            title: 'Benar!',
            timer: 800,
            showConfirmButton: false
        }).then(() => {

            if (condition) {
                currentState = STATE.SHIFT;
            } else {
                currentState = STATE.INSERT;
            }

            nextStep();
        });

    } else {

        Swal.fire({
            icon: 'error',
            title: 'Kurang Tepat',
            text: 'Perhatikan kembali urutan alfabetnya.',
            confirmButtonColor: '#d33'
        });

    }
}


/* ===============================
   AUTO START
   =============================== */
setTimeout(nextStep, 400);
