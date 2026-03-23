// =========================================================
// BAGIAN 2: LOGIKA SIMULASI INSERTION SORT (KARTU NAMA)
// =========================================================

const IMG_PATH = window.IMG_PATH || '';
const initialData = ['Sinta', 'Budi', 'Yahya', 'Akmal', 'Fitri'];

let arr = [...initialData];
let i = 1;              // Indeks target sisip
let j = 0;              // Indeks pembanding
let keyVal = '';        // Nama kartu yang diangkat
let holeIdx = 1;        // Posisi ruang kosong
let isProcessing = false;

let container = document.getElementById('simulation-container');

function resetSimulation() {
    container = document.getElementById('simulation-container');
    const finishMsg = document.getElementById('finish-message');
    
    container.innerHTML = '';
    if(finishMsg) finishMsg.style.display = 'none';

    arr = [...initialData];
    i = 1;
    j = 0;
    keyVal = arr[1];
    holeIdx = 1;
    isProcessing = false;

    nextStep();
}

function nextStep() {
    if(!container) container = document.getElementById('simulation-container');
    
    if (i >= arr.length) {
        showFinishMessage();
        return;
    }

    let valSorted = arr[j]; 
    let cardIdSuffix = `${i}-${j}`;

    let explanationText = `
        <div class="mb-2"><span class="badge bg-primary">Iterasi ke-${i}</span></div>
        Bandingkan <strong>${keyVal}</strong> dengan <strong>${valSorted}</strong>.<br>
        Pilih langkah yang paling tepat sesuai algoritma insertion sort (ascending).
    `;

    let btn1HTML = `<button class="btn-sim btn-tukar fw-bold" onclick="checkAnswer(true, '${keyVal}', '${valSorted}', '${cardIdSuffix}', event)"><i class="fa-solid fa-arrow-right me-1"></i> Ya, Perlu Digeser</button>`;
    let btn2HTML = `<button class="btn-sim btn-stay fw-bold" onclick="checkAnswer(false, '${keyVal}', '${valSorted}', '${cardIdSuffix}', event)"><i class="fa-solid fa-thumbtack me-1"></i> Tidak, Sisipkan</button>`;

    const cardHTML = `
    <div class="sim-card fade-in">
        <div class="sim-header" style="font-size: 0.95rem; line-height: 1.5;">${explanationText}</div>
        <div class="sim-body">

            <div class="file-container" id="container-${cardIdSuffix}">
                ${renderFilesHTML([...arr], holeIdx, j, keyVal, cardIdSuffix)}
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
        if (lastCard) lastCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
}

function checkAnswer(userChoice, key, valSort, cardIdSuffix, event) {
    if (isProcessing) return;
    isProcessing = true;

    // Logika Insertion Sort
    let correctAnswer = (valSort > key); 
    let expectedAction = correctAnswer ? 'GESER' : 'SISIP';
    let chosenAction = userChoice ? 'GESER' : 'SISIP';

    const actionContainer = document.getElementById(`action-btn-${cardIdSuffix}`);
    const explanationBox = document.getElementById(`explanation-${cardIdSuffix}`);

    if (chosenAction === expectedAction) {
        const btnLanjut = event.currentTarget;
        const allBtns = actionContainer.querySelectorAll('.btn-sim');
        allBtns.forEach(btn => {
            btn.disabled = true;
            btn.style.opacity = '0.6';
            btn.style.cursor = 'not-allowed';
            if (btn !== btnLanjut) btn.style.display = 'none'; 
        });

        let explText = "";
        if (expectedAction === 'GESER') {
            explText = `
                <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Tepat!</div>
                <div class="text-dark" style="font-size: 0.9rem;">
                    Secara alfabetis, abjad awal <strong>${valSort}</strong> lebih akhir daripada <strong>${key}</strong> (${valSort} > ${key}). 
                    Oleh karena itu, Kartu ${valSort} wajib digeser ke kanan untuk memberikan ruang untuk menyisipkan kartu nama  ${key}.
                </div>`;
        } else {
            explText = `
                <div class="text-success fw-bold mb-2"><i class="fa-solid fa-circle-check fs-5 me-1 align-middle"></i> Analisis Tepat!</div>
                <div class="text-dark" style="font-size: 0.9rem;">
                    Secara alfabetis, abjad awal <strong>${valSort}</strong> lebih awal atau sama dengan <strong>${key}</strong>. 
                    Pencarian posisi selesai. Kartu target (${key}) akan langsung disisipkan di sebelah kanannya.
                </div>`;
        }

        explText += `
            <div class="mt-3 text-end">
                <button class="btn btn-sm btn-success px-4 rounded-pill fw-bold" onclick="proceedAnimation('${expectedAction}', '${cardIdSuffix}', event)">
                    Jalankan Animasi <i class="fa-solid fa-play ms-1"></i>
                </button>
            </div>
        `;

        explanationBox.innerHTML = explText;
        explanationBox.style.display = 'block';
        isProcessing = false;

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Kurang Tepat',
            text: 'Perhatikan urutan alfabetnya. Jika abjad nama di area hijau lebih akhir dari target (Misal S > B), maka ia wajib digeser ke kanan.',
            confirmButtonColor: '#e74c3c'
        }).then(() => {
            isProcessing = false;
        });
    }
}

function proceedAnimation(action, cardIdSuffix, event) {
    if (isProcessing) return;
    isProcessing = true;

    const btnLanjut = event.currentTarget;
    btnLanjut.disabled = true;
    btnLanjut.style.opacity = '0.6';
    btnLanjut.style.cursor = 'not-allowed';

    let startX = 20;  // Posisi mulai dari kiri dalam kontainer 670px
    let gap = 130;    // Jarak lebar antar kartu

    if (action === 'GESER') {
        let elToShift = document.getElementById(`file-${cardIdSuffix}-${j}`);
        let elKey = document.getElementById(`file-${cardIdSuffix}-key`);

        if (elToShift) elToShift.style.left = `${(holeIdx * gap) + startX}px`;
        if (elKey) elKey.style.left = `${(j * gap) + startX}px`;

        setTimeout(() => {
            arr[holeIdx] = arr[j]; 
            holeIdx = j;           
            j--;

            if (j < 0) {
                arr[holeIdx] = keyVal;
                container.insertAdjacentHTML('beforeend', `<div class="text-center text-muted my-3" style="font-size:0.85rem; font-style:italic;">--- Kartu Nama ${keyVal} disisipkan di awal. Iterasi ${i} Selesai ---</div>`);
                i++;
                if(i < arr.length) { keyVal = arr[i]; holeIdx = i; j = i - 1; }
            }
            isProcessing = false;
            nextStep();
        }, 600); 
    } 
    else if (action === 'SISIP') {
        let elKey = document.getElementById(`file-${cardIdSuffix}-key`);
        
        if (elKey) {
            elKey.classList.remove('is-key');
            elKey.classList.add('is-sorted');
        }

        setTimeout(() => {
            arr[holeIdx] = keyVal; 
            container.insertAdjacentHTML('beforeend', `<div class="text-center text-muted my-3" style="font-size:0.85rem; font-style:italic;">--- Kartu Nama ${keyVal} disisipkan. Iterasi ${i} Selesai ---</div>`);
            
            i++;
            if(i < arr.length) { keyVal = arr[i]; holeIdx = i; j = i - 1; }
            
            isProcessing = false;
            nextStep();
        }, 600);
    }
}

// --- RENDER HTML (KEMBALI KE VERSI BERSIH TANPA JS WRAPPER) ---
function renderFilesHTML(arrData, currentHole, compareIdx, keyString, suffix) {
    let html = '';
    let startX = 20; 
    let gap = 130; 

    arrData.forEach((val, idx) => {
        let leftPos = startX + (idx * gap);
        
        if (idx === currentHole) {
            html += `
            <div class="file-wrap is-key" id="file-${suffix}-key" style="left: ${leftPos}px;">
                <img src="${IMG_PATH}${keyString.toLowerCase()}.png" alt="${keyString}">
                <div class="file-label text-primary">${keyString}</div>
            </div>`;
        } else {
            let cls = '';
            if (idx === compareIdx) cls = 'comparing';
            else if (idx < i) cls = 'is-sorted'; 

            html += `
            <div class="file-wrap ${cls}" id="file-${suffix}-${idx}" style="left: ${leftPos}px;">
                <img src="${IMG_PATH}${val.toLowerCase()}.png" alt="${val}">
                <div class="file-label">${val}</div>
            </div>`;
        }
    });

    return html;
}

function showFinishMessage() {
    const finishMsg = document.getElementById('finish-message');
    if(finishMsg) finishMsg.style.display = 'block';
    window.scrollTo(0, document.body.scrollHeight);
}

// --- AUTO START ---
resetSimulation();