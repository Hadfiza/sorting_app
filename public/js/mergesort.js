// =========================================================
// BAGIAN 1: PENGATURAN TAB HALAMAN & NAVIGASI (MESIN UTAMA)
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
        updateSidebarActive(i);
        updateButtonState();

        // 🔥 INIT EDITOR SAAT HALAMAN PROGRAM
        if (materiPages[i].querySelector('#code')) {
            setTimeout(() => {
                initPythonEditor();
                if(typeof editor !== 'undefined') editor.refresh(); // WAJIB
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
// BAGIAN 2: LOGIKA EDITOR PYTHON
// =========================================================
let editorInitialized = false;
let editor; 
let pyodideInstance;

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

    if (runBtn) runBtn.disabled = true;

    try {
        pyodideInstance = await loadPyodide({
            stdout: (t) => { if (outputDiv) outputDiv.innerText += t + "\n" },
            stderr: (t) => { if (outputDiv) outputDiv.innerText += t + "\n" }
        });
        if (runBtn) runBtn.disabled = false;
    } catch (err) {
        console.error("Gagal memuat Pyodide", err);
    }

    if (runBtn) {
        runBtn.onclick = async () => {
            outputDiv.innerText = "";
            runBtn.disabled = true;
            try {
                await pyodideInstance.runPythonAsync(editor.getValue());
            } finally {
                runBtn.disabled = false;
            }
        };
    }

    editorInitialized = true;
}

// =========================================================
// BAGIAN 3: SIMULASI MERGE SORT (FINAL BUG-FREE + NARASI)
// =========================================================

const IMG_PATH = window.IMG_PATH || '';

const initialData = [
    { id: 'b1', val: 8 },
    { id: 'b2', val: 3 },
    { id: 'b3', val: 9 },
    { id: 'b4', val: 4 },
    { id: 'b5', val: 6 }
];

let queue = [];
let currentTask = null;
let currentCardId = null;
let isProcessing = false;
let container = document.getElementById('simulation-container');

let mergeState = {
    leftArr: [], rightArr: [], resultArr: [],
    i: 0, j: 0, phase: 'COMPARE'
};

function resetSimulation() {
    container = document.getElementById('simulation-container');
    const finishMsg = document.getElementById('finish-message');
    
    if (container) container.innerHTML = '';
    if (finishMsg) finishMsg.style.display = 'none';

    queue = [];
    isProcessing = false;
    
    generateTasks([...initialData]); 
    processNextTask();               
}

function generateTasks(arr) {
    if (arr.length <= 1) return arr;
    
    const mid = Math.floor(arr.length / 2); //membagi 2 kiri kanan
    const left = arr.slice(0, mid);
    const right = arr.slice(mid);

    queue.push({ type: 'DIVIDE', left, right });

    const sortedLeft = generateTasks(left);// dipanggil secara rekursif
    const sortedRight = generateTasks(right);

    queue.push({ type: 'MERGE', left: sortedLeft, right: sortedRight });
    
    return [...sortedLeft, ...sortedRight].sort((a, b) => a.val - b.val);
}

function processNextTask() {
    if (queue.length === 0) {
        const lastCard = container ? container.lastElementChild : null;
        if (lastCard) {
            const btnArea = lastCard.querySelector('.action-buttons');
            if (btnArea) btnArea.remove(); 
        }

        const finishMsg = document.getElementById('finish-message');
        if (finishMsg) {
            finishMsg.style.display = 'block'; 
        }
        
        window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
        return;
    }

    currentTask = queue.shift();
    currentCardId = `card-${Date.now()}`;

    if (currentTask.type === 'DIVIDE') {
        renderDivideCard();
    } else {
        mergeState = { leftArr: currentTask.left, rightArr: currentTask.right, resultArr: [], i: 0, j: 0, phase: 'COMPARE' };
        renderMergeCard();
    }
}

// ===============================
// FASE 1: DIVIDE (MEMECAH)
// ===============================
function renderDivideCard() {
    const combinedArr = [...currentTask.left, ...currentTask.right];
    const totalKarung = combinedArr.length;
    
    const html = `
    <div class="sim-card fade-in" id="${currentCardId}">
        <div class="sim-header">
            <strong><span class="badge bg-primary">Fase Pemecahan (DIVIDE)</span></strong>
            <p id="exp-${currentCardId}" class="mt-2 mb-0" style="font-size: 0.95rem;">
                Sistem mendeteksi <strong>${totalKarung} karung beras</strong> yang masih tergabung.<br>
                Berdasarkan prinsip algoritma <em>Merge Sort</em> (Divide), tindakan apa yang wajib dieksekusi oleh sistem?
            </p>
        </div>
        <div class="sim-body">
            <div class="book-container" id="${currentCardId}-combined" style="display: flex; justify-content: center; margin-bottom: 20px;">
                <div class="group-box" style="border-color: #34495e; background: #f8f9fa;">
                    <div class="group-title" style="background: #34495e;">Blok Data Saat Ini</div>
                    ${renderBooksHTML(combinedArr)}
                </div>
            </div>

            <div class="book-container fade-in" id="${currentCardId}-visual" style="display: none; justify-content: center; gap: 30px;">
                <div class="group-box" style="border-color: #fca130; background: #fffaf0;">
                    <div class="group-title" style="background: #fca130;">Pecahan Kiri</div>
                    ${renderBooksHTML(currentTask.left)}
                </div>
                <div class="group-box" style="border-color: #fca130; background: #fffaf0;">
                    <div class="group-title" style="background: #fca130;">Pecahan Kanan</div>
                    ${renderBooksHTML(currentTask.right)}
                </div>
            </div>

            <div id="explanation-box-${currentCardId}" class="mt-4 mb-3 fade-in" style="display:none; font-size: 0.9rem; color: #333; background: #eafaf1; padding: 12px; border-radius: 6px; border-left: 4px solid #2ecc71; text-align: left;">
                <div id="explanation-text-${currentCardId}"></div>
            </div>

            <div class="action-buttons" id="action-btn-${currentCardId}">
                <button class="btn-sim" style="background: #3498db;" onclick="checkDivideAnswer(true, '${currentCardId}')"><i class="fa-solid fa-arrows-split-up-and-left me-1"></i> Membaginya jadi 2 sub-kelompok</button>
                <button class="btn-sim" style="background: #e67e22;" onclick="checkDivideAnswer(false, '${currentCardId}')"><i class="fa-solid fa-arrow-down-short-wide me-1"></i> Langsung mengurutkannya</button>
            </div>
        </div>
    </div>`;
    
    if (container) container.insertAdjacentHTML('beforeend', html);
    scrollToCard();
}

// ===============================
// FASE 2: MERGE (MENGGABUNGKAN)
// ===============================
function renderMergeCard() {
    const html = `
    <div class="sim-card fade-in" id="${currentCardId}">
        <div class="sim-header">
            <strong><span class="badge bg-warning text-dark">Fase Penggabungan (MERGE)</span></strong>
            <p class="exp-text mt-2 mb-0" style="font-size: 0.95rem;"></p>
        </div>
        <div class="sim-body">
            <div class="merge-board">
                <div class="source-row">
                    <div class="group-box" id="${currentCardId}-left"></div>
                    <div class="group-box" style="border-color: #9b59b6; background: #f9f0ff;" id="${currentCardId}-right"></div>
                </div>
                
                <i class="fa-solid fa-angles-down text-muted fs-4 my-1"></i>

                <div class="result-box" id="${currentCardId}-result"></div>
            </div>

            <div id="explanation-box-${currentCardId}" class="mt-4 mb-3 fade-in" style="display:none; font-size: 0.9rem; color: #333; background: #eafaf1; padding: 12px; border-radius: 6px; border-left: 4px solid #2ecc71; text-align: left;">
                <div class="fw-bold mb-1 border-bottom border-success pb-1" style="border-color: #2ecc71 !important;">Catatan Proses Penggabungan:</div>
                <div id="explanation-text-${currentCardId}" style="line-height: 1.6;"></div>
            </div>
            
            <div class="action-buttons" id="action-btn-${currentCardId}"></div>
        </div>
    </div>`;
    
    if (container) container.insertAdjacentHTML('beforeend', html);
    updateMergeVisuals();
    scrollToCard();
}

function updateMergeVisuals() {
    const leftBox   = document.getElementById(`${currentCardId}-left`);
    const rightBox  = document.getElementById(`${currentCardId}-right`);
    const resultBox = document.getElementById(`${currentCardId}-result`);
    const card      = document.getElementById(currentCardId);
    const exp       = card.querySelector('.exp-text');
    const btnArea   = card.querySelector('.action-buttons');

    resultBox.innerHTML = `<div class="result-title">KOTAK HASIL GABUNGAN</div>` + mergeState.resultArr.map(item => `
        <div class="book-img-wrap merged-item">
            <img src="${IMG_PATH}${item.val}.png" onerror="this.src='/img/karung_merah_error.png';">
            <span class="book-label">${item.val} kg</span>
        </div>
    `).join('');

    // JIKA PROSES PENGGABUNGAN SELESAI
    if (mergeState.i >= mergeState.leftArr.length && mergeState.j >= mergeState.rightArr.length) {
        leftBox.innerHTML = '<div class="group-title">Grup Kiri</div><span class="text-muted small mt-4">Habis</span>';
        rightBox.innerHTML = '<div class="group-title" style="background: #9b59b6;">Grup Kanan</div><span class="text-muted small mt-4">Habis</span>';
        
        exp.innerHTML = `<strong class="text-success"><i class="fa-solid fa-check-double"></i> PENGGABUNGAN SELESAI!</strong> Segmen ini telah terurut.`;
        btnArea.innerHTML = `<button class="btn-sim active" style="background:#2ecc71;" onclick="processNextTask()">Lanjut ke Segmen Berikutnya <i class="fa-solid fa-arrow-right ms-1"></i></button>`;
        
        // MUNCULKAN KOTAK PENJELASAN HANYA SAAT SUDAH SELESAI
        const expBox = document.getElementById(`explanation-box-${currentCardId}`);
        const expText = document.getElementById(`explanation-text-${currentCardId}`);
        if (expBox && expText) {
            expText.innerHTML += `<div class="mt-2 pt-2" style="border-top: 1px dashed #2ecc71;"><strong>Kesimpulan:</strong> Kedua grup asal (Kiri dan Kanan) telah habis dipindahkan. Karung pada segmen gabungan ini kini tersusun rapi dari yang paling ringan.</div>`;
            expBox.style.display = 'block'; // TAMPILKAN SEKARANG!
        }
        return; 
    }

    leftBox.innerHTML = `<div class="group-title">Grup Kiri</div>` + renderBooksWithIndex(mergeState.leftArr, mergeState.i, 'comparing', 'left');
    rightBox.innerHTML = `<div class="group-title" style="background: #9b59b6;">Grup Kanan</div>` + renderBooksWithIndex(mergeState.rightArr, mergeState.j, 'comparing', 'right');
    
    const leftVal  = mergeState.i < mergeState.leftArr.length ? mergeState.leftArr[mergeState.i].val : null;
    const rightVal = mergeState.j < mergeState.rightArr.length ? mergeState.rightArr[mergeState.j].val : null;

    if (leftVal !== null && rightVal !== null) {
        exp.innerHTML = `Bandingkan ujung Grup KIRI (<b>${leftVal} kg</b>) dengan KANAN (<b>${rightVal} kg</b>).<br>Berdasarkan urutan <em>ascending</em>, karung mana yang harus diturunkan ke HASIL?`;
        btnArea.innerHTML = `
            <button class="btn-sim btn-kiri" onclick="checkMergeAnswer('LEFT', ${leftVal}, ${rightVal})"><i class="fa-solid fa-arrow-down me-1"></i> Pilih Kiri (${leftVal} kg)</button>
            <button class="btn-sim btn-kanan" onclick="checkMergeAnswer('RIGHT', ${leftVal}, ${rightVal})"><i class="fa-solid fa-arrow-down me-1"></i> Pilih Kanan (${rightVal} kg)</button>
        `;
    } else if (leftVal === null) {
        exp.innerHTML = `Grup KIRI sudah habis. Apa yang harus dilakukan pada sisa Grup KANAN?`;
        btnArea.innerHTML = `<button class="btn-sim btn-auto" onclick="checkMergeAnswer('RIGHT', null, ${rightVal})"><i class="fa-solid fa-check-double me-1"></i> Turunkan Sisa Kanan (${rightVal} kg)</button>`;
    } else {
        exp.innerHTML = `Grup KANAN sudah habis. Apa yang harus dilakukan pada sisa Grup KIRI?`;
        btnArea.innerHTML = `<button class="btn-sim btn-auto" onclick="checkMergeAnswer('LEFT', ${leftVal}, null)"><i class="fa-solid fa-check-double me-1"></i> Turunkan Sisa Kiri (${leftVal} kg)</button>`;
    }
}

window.checkMergeAnswer = function(choice, leftVal, rightVal) {
    if (isProcessing) return;
    isProcessing = true; 

    try {
        let isCorrect = false;
        if (leftVal !== null && rightVal !== null) {
            let correctChoice = (leftVal <= rightVal) ? 'LEFT' : 'RIGHT'; // ini untuk menentukan membagi
            isCorrect = (choice === correctChoice);
        } else {
            isCorrect = true; 
        }

        if (isCorrect) {
            const actionBtn = document.getElementById(`action-btn-${currentCardId}`);
            if (actionBtn) {
                const btns = actionBtn.querySelectorAll('.btn-sim');
                btns.forEach(b => { b.disabled = true; b.style.opacity = '0.5'; });
            }

            const exp = document.getElementById(currentCardId).querySelector('.exp-text');
            let chosenVal = (choice === 'LEFT') ? leftVal : rightVal;
            
            exp.innerHTML = `<span class="text-success fw-bold"><i class="fa-solid fa-circle-check"></i> Analisis Tepat!</span> Karung <b>${chosenVal} kg</b> otomatis diturunkan ke Hasil...`;

            let reasonText = "";
            if (leftVal !== null && rightVal !== null) {
                reasonText = `Sesuai aturan ascending, karung <b>${chosenVal} kg</b> lebih ringan (atau sama) sehingga diturunkan.`;
            } else {
                reasonText = `Karena grup lain kosong, sisa karung <b>${chosenVal} kg</b> langsung digabungkan.`;
            }

            // SIMPAN PENJELASAN DIAM-DIAM (Tanpa Memunculkan Kotak)
            const expBox = document.getElementById(`explanation-box-${currentCardId}`);
            const expText = document.getElementById(`explanation-text-${currentCardId}`);
            if (expBox && expText) {
                expText.innerHTML += `<div><i class="fa-solid fa-caret-right text-success me-1"></i> ${reasonText}</div>`;
            }

            const activeItem = document.getElementById(choice === 'LEFT' ? 'current-left' : 'current-right');
            if (activeItem) {
                activeItem.classList.add('slide-down-anim'); 
            }

            setTimeout(() => {
                if (choice === 'LEFT') {
                    mergeState.resultArr.push(mergeState.leftArr[mergeState.i]);
                    mergeState.i++;
                } else {
                    mergeState.resultArr.push(mergeState.rightArr[mergeState.j]);
                    mergeState.j++;
                }
                
                isProcessing = false; 
                updateMergeVisuals(); 
            }, 600); // Animasi dipercepat sedikit

        } else {
            Swal.fire({
                icon: 'error', 
                title: 'Kurang Tepat', 
                text: 'Ingat! Dalam pengurutan ascending, karung yang beratnya LEBIH RINGAN harus diturunkan dan digabungkan terlebih dahulu.', 
                confirmButtonColor: '#e74c3c'
            }).then(() => {
                isProcessing = false; 
            });
        }
    } catch (error) {
        isProcessing = false; 
    }
}

// =========================================================
// GANTI 3 FUNGSI INI UNTUK MEMPERKAYA NARASI PENJELASAN
// =========================================================

window.checkDivideAnswer = function(isCorrect, cardId) {
    if (isProcessing) return;
    isProcessing = true; 

    try {
        if (isCorrect) {
            // ... (Bagian jawaban benar tetap sama seperti sebelumnya) ...
            const actionBtn = document.getElementById(`action-btn-${cardId}`);
            if (actionBtn) {
                const btns = actionBtn.querySelectorAll('.btn-sim');
                btns.forEach(b => { b.disabled = true; b.style.opacity = '0.5'; });
            }

            document.getElementById(`${cardId}-combined`).style.display = 'none';
            document.getElementById(`${cardId}-visual`).style.display = 'flex';
            
            document.getElementById(`exp-${cardId}`).innerHTML = `
                <span class="text-success fw-bold"><i class="fa-solid fa-circle-check"></i> Analisis Tepat!</span>
            `;
            
            const leftCount = currentTask.left.length;
            const rightCount = currentTask.right.length;
            const totalCount = leftCount + rightCount;
            if (actionBtn) {
                actionBtn.insertAdjacentHTML('afterend', `
                    <div class="mt-4 fade-in" style="font-size: 0.9rem; color: #333; background: #eafaf1; padding: 12px; border-radius: 6px; border-left: 4px solid #2ecc71; text-align: left; line-height: 1.5;">
                        <strong>Penjelasan:</strong> Sesuai prinsip <em>Divide</em> (Pecah), masalah yang besar harus dipecah menjadi bagian-bagian kecil. Blok yang tadinya berisi ${totalCount} karung ini dibagi dua tepat di tengah. Hal ini akan dilakukan terus-menerus secara rekursif hingga tersisa 1 karung per blok agar lebih mudah diurutkan. <br><br>Hasil pemecahan kali ini: <b>Pecahan Kiri (${leftCount} karung)</b> dan <b>Pecahan Kanan (${rightCount} karung)</b>.
                    </div>
                `);
            }
            
            setTimeout(() => {
                isProcessing = false;
                processNextTask();
            }, 2500);

        } else {
            // --- REVISI SWEETALERT SANGAT SINGKAT ---
            Swal.fire({
                icon: 'warning', 
                title: 'Kurang Tepat!', 
                html: `Ingat kembali prinsip dasar <b>Merge Sort</b>: Pecah (Divide) datanya terlebih dahulu!`,
                confirmButtonText: 'Oke!',
                confirmButtonColor: '#f39c12'
            }).then(() => {
                isProcessing = false; 
            });
        }
    } catch (error) {
        isProcessing = false; 
    }
}

function updateMergeVisuals() {
    const leftBox   = document.getElementById(`${currentCardId}-left`);
    const rightBox  = document.getElementById(`${currentCardId}-right`);
    const resultBox = document.getElementById(`${currentCardId}-result`);
    const card      = document.getElementById(currentCardId);
    const exp       = card.querySelector('.exp-text');
    const btnArea   = card.querySelector('.action-buttons');

    resultBox.innerHTML = `<div class="result-title">KOTAK HASIL GABUNGAN</div>` + mergeState.resultArr.map(item => `
        <div class="book-img-wrap merged-item">
            <img src="${IMG_PATH}${item.val}.png" onerror="this.src='/img/karung_merah_error.png';">
            <span class="book-label">${item.val} kg</span>
        </div>
    `).join('');

    if (mergeState.i >= mergeState.leftArr.length && mergeState.j >= mergeState.rightArr.length) {
        leftBox.innerHTML = '<div class="group-title">Grup Kiri</div><span class="text-muted small mt-4">Habis</span>';
        rightBox.innerHTML = '<div class="group-title" style="background: #9b59b6;">Grup Kanan</div><span class="text-muted small mt-4">Habis</span>';
        
        exp.innerHTML = `<strong class="text-success"><i class="fa-solid fa-check-double"></i> PENGGABUNGAN SELESAI!</strong> Segmen ini telah terurut.`;
        btnArea.innerHTML = `<button class="btn-sim active" style="background:#2ecc71;" onclick="processNextTask()">Lanjut ke Segmen Berikutnya <i class="fa-solid fa-arrow-right ms-1"></i></button>`;
        
        // --- REVISI NARASI KESIMPULAN MERGE ---
        const expBox = document.getElementById(`explanation-box-${currentCardId}`);
        const expText = document.getElementById(`explanation-text-${currentCardId}`);
        if (expBox && expText) {
            expText.innerHTML += `
                <div class="mt-3 pt-2" style="border-top: 1px dashed #2ecc71;">
                    <strong>Kesimpulan:</strong> Proses <em>Conquer & Merge</em> (Taklukkan & Gabung) pada segmen ini telah tuntas. Kedua grup asal (Kiri dan Kanan) telah habis dipindahkan. Karung-karung pada segmen gabungan ini kini bersatu dan 100% terurut rapi dari yang paling ringan (ascending).
                </div>`;
            expBox.style.display = 'block'; 
        }
        return; 
    }

    leftBox.innerHTML = `<div class="group-title">Grup Kiri</div>` + renderBooksWithIndex(mergeState.leftArr, mergeState.i, 'comparing', 'left');
    rightBox.innerHTML = `<div class="group-title" style="background: #9b59b6;">Grup Kanan</div>` + renderBooksWithIndex(mergeState.rightArr, mergeState.j, 'comparing', 'right');
    
    const leftVal  = mergeState.i < mergeState.leftArr.length ? mergeState.leftArr[mergeState.i].val : null;
    const rightVal = mergeState.j < mergeState.rightArr.length ? mergeState.rightArr[mergeState.j].val : null;

    if (leftVal !== null && rightVal !== null) {
        exp.innerHTML = `Bandingkan ujung Grup KIRI (<b>${leftVal} kg</b>) dengan KANAN (<b>${rightVal} kg</b>).<br>Berdasarkan urutan <em>ascending</em>, karung mana yang harus diturunkan ke HASIL?`;
        btnArea.innerHTML = `
            <button class="btn-sim btn-kiri" onclick="checkMergeAnswer('LEFT', ${leftVal}, ${rightVal})"><i class="fa-solid fa-arrow-down me-1"></i> Pilih Kiri (${leftVal} kg)</button>
            <button class="btn-sim btn-kanan" onclick="checkMergeAnswer('RIGHT', ${leftVal}, ${rightVal})"><i class="fa-solid fa-arrow-down me-1"></i> Pilih Kanan (${rightVal} kg)</button>
        `;
    } else if (leftVal === null) {
        exp.innerHTML = `Grup KIRI sudah habis terurut. Apa yang harus dilakukan pada sisa Grup KANAN?`;
        btnArea.innerHTML = `<button class="btn-sim btn-auto" onclick="checkMergeAnswer('RIGHT', null, ${rightVal})"><i class="fa-solid fa-check-double me-1"></i> Turunkan Sisa Kanan (${rightVal} kg)</button>`;
    } else {
        exp.innerHTML = `Grup KANAN sudah habis terurut. Apa yang harus dilakukan pada sisa Grup KIRI?`;
        btnArea.innerHTML = `<button class="btn-sim btn-auto" onclick="checkMergeAnswer('LEFT', ${leftVal}, null)"><i class="fa-solid fa-check-double me-1"></i> Turunkan Sisa Kiri (${leftVal} kg)</button>`;
    }
}

window.checkMergeAnswer = function(choice, leftVal, rightVal) {
    if (isProcessing) return;
    isProcessing = true; 

    try {
        let isCorrect = false;
        if (leftVal !== null && rightVal !== null) {
            let correctChoice = (leftVal <= rightVal) ? 'LEFT' : 'RIGHT';
            isCorrect = (choice === correctChoice);
        } else {
            isCorrect = true; 
        }

        if (isCorrect) {
            const actionBtn = document.getElementById(`action-btn-${currentCardId}`);
            if (actionBtn) {
                const btns = actionBtn.querySelectorAll('.btn-sim');
                btns.forEach(b => { b.disabled = true; b.style.opacity = '0.5'; });
            }

            const exp = document.getElementById(currentCardId).querySelector('.exp-text');
            let chosenVal = (choice === 'LEFT') ? leftVal : rightVal;
            
            exp.innerHTML = `<span class="text-success fw-bold"><i class="fa-solid fa-circle-check"></i> Analisis Tepat!</span> Karung <b>${chosenVal} kg</b> otomatis diturunkan ke Hasil...`;

            // --- REVISI NARASI LOG MERGE MENJADI LEBIH DINAMIS ---
            let reasonText = "";
            if (leftVal !== null && rightVal !== null) {
                let terpilih = choice === 'LEFT' ? leftVal : rightVal;
                let sumberTerpilih = choice === 'LEFT' ? 'Grup Kiri' : 'Grup Kanan';
                reasonText = `Membandingkan Kiri (<b>${leftVal} kg</b>) vs Kanan (<b>${rightVal} kg</b>). Karena <b>${terpilih} kg</b> dari ${sumberTerpilih} lebih ringan (atau sama), maka karung ini diturunkan terlebih dahulu.`;
            } else if (leftVal === null) {
                reasonText = `Grup Kiri telah habis. Maka, sisa elemen terdepan di Grup Kanan (<b>${rightVal} kg</b>) otomatis dipindahkan ke hasil tanpa perlu perbandingan lagi.`;
            } else if (rightVal === null) {
                reasonText = `Grup Kanan telah habis. Maka, sisa elemen terdepan di Grup Kiri (<b>${leftVal} kg</b>) otomatis dipindahkan ke hasil tanpa perlu perbandingan lagi.`;
            }

            const expBox = document.getElementById(`explanation-box-${currentCardId}`);
            const expText = document.getElementById(`explanation-text-${currentCardId}`);
            if (expBox && expText) {
                expText.innerHTML += `<div class="mb-1"><i class="fa-solid fa-caret-right text-success me-1"></i> ${reasonText}</div>`;
            }

            const activeItem = document.getElementById(choice === 'LEFT' ? 'current-left' : 'current-right');
            if (activeItem) {
                activeItem.classList.add('slide-down-anim'); 
            }

            setTimeout(() => {
                if (choice === 'LEFT') {
                    mergeState.resultArr.push(mergeState.leftArr[mergeState.i]); //logika penggabungan
                    mergeState.i++;
                } else {
                    mergeState.resultArr.push(mergeState.rightArr[mergeState.j]);
                    mergeState.j++;
                }
                
                isProcessing = false; 
                updateMergeVisuals(); 
            }, 600); 

        } else {
            Swal.fire({
                icon: 'error', 
                title: 'Kurang Tepat', 
                text: 'Ingat! Dalam pengurutan ascending, karung yang beratnya LEBIH RINGAN harus diturunkan dan digabungkan terlebih dahulu.', 
                confirmButtonColor: '#e74c3c'
            }).then(() => {
                isProcessing = false; 
            });
        }
    } catch (error) {
        isProcessing = false; 
    }
}

// ===============================
// HELPER VISUAL 
// ===============================
function renderBooksHTML(arr) {
    return arr.map(item => `
        <div class="book-img-wrap">
            <img src="${IMG_PATH}${item.val}.png" onerror="this.src='/img/karung_merah_error.png';">
            <span class="book-label">${item.val} kg</span>
        </div>
    `).join('');
}

function renderBooksWithIndex(arr, currentIndex, highlightClass, side) {
    if (currentIndex >= arr.length) return '';
    return arr
        .slice(currentIndex)
        .map((item, idx) => `
            <div class="book-img-wrap ${idx === 0 ? highlightClass : ''}" ${idx === 0 && side ? `id="current-${side}"` : ''}>
                <img src="${IMG_PATH}${item.val}.png" onerror="this.src='/img/karung_merah_error.png';">
                <span class="book-label">${item.val} kg</span>
            </div>
        `)
        .join('');
}

function scrollToCard() {
    setTimeout(() => { 
        if (document.getElementById(currentCardId)) {
            document.getElementById(currentCardId).scrollIntoView({ behavior: 'smooth', block: 'center' }); 
        }
    }, 150);
}

function showFinishMessage() {
    const finishMsg = document.getElementById('finish-message');
    if(finishMsg) finishMsg.style.display = 'block';
    window.scrollTo(0, document.body.scrollHeight);
}

// ===============================
// AUTO START
// ===============================
setTimeout(resetSimulation, 500);