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
// BAGIAN 3: SIMULASI MERGE SORT (FINAL PERBAIKAN BUG)
// =========================================================

const IMG_PATH = window.IMG_PATH || '';

const initialData = [
    { id: 'b1', val: 8 },
    { id: 'b2', val: 3 },
    { id: 'b3', val: 9 },
    { id: 'b4', val: 4 },
    { id: 'b5', val: 6 }
];

// ===============================
// GLOBAL & STATE
// ===============================
let queue = [];
let currentTask = null;
let currentCardId = null;
let isProcessing = false;
let container = document.getElementById('simulation-container');

let mergeState = {
    leftArr: [], rightArr: [], resultArr: [],
    i: 0, j: 0, phase: 'COMPARE'
};

// ===============================
// INISIALISASI & RESET
// ===============================
function resetSimulation() {
    container = document.getElementById('simulation-container');
    const finishMsg = document.getElementById('finish-message');
    
    container.innerHTML = '';
    if(finishMsg) finishMsg.style.display = 'none';

    queue = [];
    isProcessing = false;
    
    generateTasks([...initialData]); // Buat antrean rekursif
    processNextTask();               // Mulai jalankan
}

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
// PROSES KARTU BERIKUTNYA
// ===============================
function processNextTask() {
    if (queue.length === 0) {
        const lastCard = container.lastElementChild;
        if (lastCard) {
            const btnArea = lastCard.querySelector('.action-buttons');
            if (btnArea) btnArea.remove(); 
        }

        container.insertAdjacentHTML('beforeend', `
            <div class="sim-card fade-in" style="margin-top:30px; padding:30px; background:#eafaf1; border:2px solid #27ae60; border-radius:12px; text-align:center;">
                <h3 style="color:#1e8449;"><i class="fa fa-check-circle"></i> Pengurutan Merge Sort Selesai! Halaman akan otomatis beralih ke materi selanjutnya.</h3>
                <button class="btn-sim active mt-3" style="background:#27ae60;" onclick="resetSimulation()">Ulangi Simulasi</button>
            </div>
        `);
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
// FASE 1: DIVIDE (MEMECAH) - REVISI VISUAL GABUNG
// ===============================
function renderDivideCard() {
    // Gabungkan array kiri dan kanan sementara untuk ditampilkan utuh di awal
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

            <div class="action-buttons" id="action-btn-${currentCardId}">
                <button class="btn-sim" style="background: #3498db;" onclick="checkDivideAnswer(true, '${currentCardId}')"><i class="fa-solid fa-arrows-split-up-and-left me-1"></i> Membaginya jadi 2 sub-kelompok</button>
                <button class="btn-sim" style="background: #e67e22;" onclick="checkDivideAnswer(false, '${currentCardId}')"><i class="fa-solid fa-arrow-down-short-wide me-1"></i> Langsung mengurutkannya</button>
            </div>
        </div>
    </div>`;
    
    container.insertAdjacentHTML('beforeend', html);
    scrollToCard();
}

window.checkDivideAnswer = function(isCorrect, cardId) {
    if (isProcessing) return;
    isProcessing = true; 

    try {
        if (isCorrect) {
            // Matikan tombol
            const actionBtn = document.getElementById(`action-btn-${cardId}`);
            if (actionBtn) {
                const btns = actionBtn.querySelectorAll('.btn-sim');
                btns.forEach(b => { 
                    b.disabled = true; 
                    b.style.opacity = '0.5'; 
                });
            }

            // REVISI VISUAL: Sembunyikan kotak gabungan, Munculkan kotak pecahan!
            document.getElementById(`${cardId}-combined`).style.display = 'none';
            document.getElementById(`${cardId}-visual`).style.display = 'flex';
            
            document.getElementById(`exp-${cardId}`).innerHTML = `
                <div class="text-success fw-bold mb-1"><i class="fa-solid fa-circle-check"></i> Analisis Tepat!</div>
                Sesuai prinsip <em>Divide</em>, masalah yang besar dipecah menjadi 2 Grup (Kiri & Kanan) secara rekursif hingga mencapai ukuran terkecil.
            `;
            
            // Jeda sedikit lebih lama (1.2 detik) agar mahasiswa bisa melihat perubahannya memecah
            setTimeout(() => {
                isProcessing = false;
                processNextTask();
            }, 1200);

        } else {
            Swal.fire({
                icon: 'error', 
                title: 'Kurang Tepat', 
                text: 'Merge Sort tidak boleh langsung mengurutkan data mentah. Ia harus memecah (Divide) data tersebut menjadi bagian terkecil terlebih dahulu!', 
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
            
            <div class="action-buttons" id="action-btn-${currentCardId}"></div>
        </div>
    </div>`;
    
    container.insertAdjacentHTML('beforeend', html);
    updateMergeVisuals();
    scrollToCard();
}

// =========================================================
// GANTI FUNGSI INI SAJA (Perbaikan Bug Karung Terakhir Hilang)
// =========================================================
function updateMergeVisuals() {
    const leftBox   = document.getElementById(`${currentCardId}-left`);
    const rightBox  = document.getElementById(`${currentCardId}-right`);
    const resultBox = document.getElementById(`${currentCardId}-result`);
    const card      = document.getElementById(currentCardId);
    const exp       = card.querySelector('.exp-text');
    const btnArea   = card.querySelector('.action-buttons');

    // 1. REVISI KUNCI: Render Kotak Hasil DULUAN sebelum dicek selesai!
    resultBox.innerHTML = `<div class="result-title">KOTAK HASIL GABUNGAN</div>` + mergeState.resultArr.map(item => `
        <div class="book-img-wrap merged-item">
            <img src="${IMG_PATH}${item.val}.png" onerror="this.src='/img/karung_merah_error.png';">
            <span class="book-label">${item.val} kg</span>
        </div>
    `).join('');

    // 2. CEK SELESAI
    if (mergeState.i >= mergeState.leftArr.length && mergeState.j >= mergeState.rightArr.length) {
        leftBox.innerHTML = '<div class="group-title">Grup Kiri</div><span class="text-muted small mt-4">Habis</span>';
        rightBox.innerHTML = '<div class="group-title" style="background: #9b59b6;">Grup Kanan</div><span class="text-muted small mt-4">Habis</span>';
        exp.innerHTML = '<strong class="text-success"><i class="fa-solid fa-check-double"></i> PENGGABUNGAN SELESAI!</strong> Segmen ini telah terurut.';
        
        btnArea.innerHTML = `<button class="btn-sim active" style="background:#2ecc71;" onclick="processNextTask()">Lanjut ke Segmen Berikutnya <i class="fa-solid fa-arrow-right ms-1"></i></button>`;
        return; // Hentikan fungsi di sini jika sudah selesai
    }

    // 3. RENDER VISUAL KOTAK KIRI & KANAN (Jika Belum Selesai)
    leftBox.innerHTML = `<div class="group-title">Grup Kiri</div>` + renderBooksWithIndex(mergeState.leftArr, mergeState.i, 'comparing', 'left');
    rightBox.innerHTML = `<div class="group-title" style="background: #9b59b6;">Grup Kanan</div>` + renderBooksWithIndex(mergeState.rightArr, mergeState.j, 'comparing', 'right');
    
    // 4. RENDER PERTANYAAN PERBANDINGAN
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

// PENGECEKAN FASE MERGE (DENGAN REVISI ANIMASI & FREEZE)
window.checkMergeAnswer = function(choice, leftVal, rightVal) {
    if (isProcessing) return;
    isProcessing = true; // Kunci sistem untuk mencegah klik ganda

    try {
        let isCorrect = false;
        if (leftVal !== null && rightVal !== null) {
            let correctChoice = (leftVal <= rightVal) ? 'LEFT' : 'RIGHT';
            isCorrect = (choice === correctChoice);
        } else {
            isCorrect = true; // Langsung benar jika memindahkan sisa grup yang habis
        }

        if (isCorrect) {
            // Matikan tombol yang ditekan agar tidak di-spam
            const actionBtn = document.getElementById(`action-btn-${currentCardId}`);
            if (actionBtn) {
                const btns = actionBtn.querySelectorAll('.btn-sim');
                btns.forEach(b => { 
                    b.disabled = true; 
                    b.style.opacity = '0.5'; 
                });
            }

            // Tampilkan pesan berhasil secara instan
            const exp = document.getElementById(currentCardId).querySelector('.exp-text');
            let chosenVal = (choice === 'LEFT') ? leftVal : rightVal;
            exp.innerHTML = `<span class="text-success fw-bold"><i class="fa-solid fa-circle-check"></i> Analisis Tepat!</span> Karung <b>${chosenVal} kg</b> otomatis diturunkan ke Hasil...`;

            // REVISI ANIMASI BUG: Terapkan animasi turun ke elemen karung yang dipilih
            const activeItem = document.getElementById(choice === 'LEFT' ? 'current-left' : 'current-right');
            if (activeItem) {
                activeItem.classList.add('slide-down-anim'); // Tambahkan kelas animasi meluncur turun
            }

            // REVISI FREEZE BUG: Jeda animasi turun (0.6 detik), baru gabungkan datanya
            setTimeout(() => {
                if (choice === 'LEFT') {
                    mergeState.resultArr.push(mergeState.leftArr[mergeState.i]);
                    mergeState.i++;
                } else {
                    mergeState.resultArr.push(mergeState.rightArr[mergeState.j]);
                    mergeState.j++;
                }
                
                isProcessing = false; // Buka kunci sistem di akhir animasi
                updateMergeVisuals(); // Render data terbaru (siklus berulang otomatis)
            }, 600);

        } else {
            // Jika Salah
            Swal.fire({
                icon: 'error', 
                title: 'Kurang Tepat', 
                text: 'Ingat! Dalam pengurutan ascending, karung yang beratnya LEBIH RINGAN harus diturunkan dan digabungkan terlebih dahulu.', 
                confirmButtonColor: '#e74c3c'
            }).then(() => {
                isProcessing = false; // Buka kunci sistem jika salah
            });
        }
    } catch (error) {
        isProcessing = false; // Buka kunci sistem jika terjadi error tersembunyi
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

// REVISI: Fungsi ini sekarang menerima parameter 'side' untuk memberi ID khusus ke elemen pertama (yang akan turun)
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
        document.getElementById(currentCardId).scrollIntoView({ behavior: 'smooth', block: 'center' }); 
    }, 150);
}

// ===============================
// AUTO START
// ===============================
setTimeout(resetSimulation, 500);