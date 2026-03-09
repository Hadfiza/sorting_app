<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simulasi Bubble Sort</title>

<style>
body{
    font-family:'Segoe UI',Tahoma,Verdana,sans-serif;
    background:#f4f6f8;
    display:flex;
    flex-direction:column;
    align-items:center;
    padding:30px;
}

h1{margin-bottom:5px}
.sub-title{color:#7f8c8d;margin-bottom:25px}

.main-stage{
    width:760px;
    background:#fff;
    padding:30px;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
    position:relative;
}

.iteration-badge{
    position:absolute;
    top:20px;
    left:20px;
    background:#1f2d3d;
    color:#fff;
    padding:6px 18px;
    border-radius:20px;
    font-weight:600;
    font-size:14px;
}

.shelf-container{
    position:relative;
    height:260px;
    margin-top:45px;
    border-bottom:4px solid #bfc5ca;
}

/* ===============================
   WRAPPER (INI YANG DIGESER)
   =============================== */
.book-wrap{
    position:absolute;
    bottom:0;
    transition:left .6s cubic-bezier(.175,.885,.32,1.275);
}

/* GAMBAR BUKU */
.book-img{
    width:80px;
    height:170px;
    object-fit:cover;
    border-radius:10px;
    filter:drop-shadow(-4px 6px 6px rgba(0,0,0,.35));
    display:block;
}

/* LABEL BUKU */
.book-label{
    position:absolute;
    inset:0;
    display:flex;
    align-items:center;
    justify-content:center;
    writing-mode:vertical-rl;
    text-orientation:mixed;
    font-weight:700;
    color:#fff;
    text-shadow:0 1px 3px rgba(0,0,0,.4);
    pointer-events:none;
}

/* HIGHLIGHT */
.highlight-box{
    position:absolute;
    bottom:0;
    height:190px;
    border:3px dashed #2c3e50;
    border-radius:10px;
    background:rgba(0,0,0,.04);
    display:none;
    z-index:0;
}

.info-panel{
    text-align:center;
    margin-top:25px;
    min-height:95px;
}

.explanation{
    font-size:16px;
    line-height:1.6;
    margin-bottom:16px;
}

.btn-action{
    padding:14px 36px;
    font-size:16px;
    font-weight:700;
    border:none;
    border-radius:10px;
    cursor:pointer;
    color:#fff;
    min-width:220px;
    box-shadow:0 4px 0 rgba(0,0,0,.25);
}

.btn-start{background:#3498db}
.btn-check{background:#f39c12}
.btn-swap{background:#e74c3c}
.btn-stay{background:#27ae60}

.history-section{
    width:760px;
    margin-top:25px;
}

.history-row{
    background:#fff;
    padding:10px;
    border-radius:8px;
    margin-bottom:8px;
    display:flex;
    align-items:center;
    border-left:5px solid #34495e;
}

.history-row:first-child{
    background:#eef3f8;
    border-left:5px solid #3498db;
}


.mini-book-img{
    width:100px;         
    height:auto;
    margin-right:10px;
    filter: drop-shadow(-2px 3px 3px rgba(0,0,0,.25));
}
</style>
</head>

<body>

<h1>Simulasi Bubble Sort</h1>
<div class="sub-title">Studi Kasus: Pengurutan Nomor Edisi Buku</div>

<div class="main-stage">
    <div class="iteration-badge" id="iter-badge">Data Awal</div>

    <div class="shelf-container" id="shelf">
        <div class="highlight-box" id="highlight-box"></div>
    </div>

    <div class="info-panel">
        <div class="explanation" id="explanation">
            Klik tombol di bawah untuk memulai proses pengurutan.
        </div>
        <button class="btn-action btn-start" id="main-btn" onclick="nextAction()">
            Mulai Iterasi 1
        </button>
    </div>
</div>

<div class="history-section">
    <h4>Hasil Per Iterasi</h4>
    <div id="history-container"></div>
</div>

{{-- PATH GAMBAR (WAJIB lewat Laravel) --}}
<script>
const IMG_PATH = "{{ asset('images/buku') }}/";
</script>

<script>

const initialData=[4,2,5,1,3];
let arr=[...initialData];
let i=0,j=0,state='START';

const shelf=document.getElementById('shelf');
const highlightBox=document.getElementById('highlight-box');
const explanation=document.getElementById('explanation');
const mainBtn=document.getElementById('main-btn');
const iterBadge=document.getElementById('iter-badge');
const historyContainer=document.getElementById('history-container');

const startX=150;
const gap=95;

/* RENDER AWAL */
function renderBooks(){
    document.querySelectorAll('.book-wrap').forEach(e=>e.remove());

    arr.forEach((val,idx)=>{
        const wrap=document.createElement('div');
        wrap.className='book-wrap';
        wrap.style.left=(startX+idx*gap)+'px';

        const img=document.createElement('img');
        img.src=`${IMG_PATH}edisi${val}.png`;
        img.className='book-img';
        img.id=`book-${val}`;

  

        wrap.appendChild(img);
        shelf.appendChild(wrap);
    });
}

/* HIGHLIGHT */
function showHighlight(a,b){
    highlightBox.style.display='block';
    highlightBox.style.left=(startX+a*gap-12)+'px';
    highlightBox.style.width=(gap+90)+'px';
}

/* TOMBOL */
function setBtn(text,cls){
    mainBtn.innerText=text;
    mainBtn.className=`btn-action ${cls}`;
}

/* STATE MACHINE */
function nextAction(){
    const n=arr.length;

    if(state==='START'){
        state='COMPARE';
        i=0;j=0;
        iterBadge.innerText=`Iterasi ke-${i+1}`;
        setBtn('Cek Edisi','btn-check');
        explanation.innerHTML='Bandingkan dua buku pertama.';
        return;
    }

    if(state==='COMPARE'){
        showHighlight(j,j+1);
        const a=arr[j],b=arr[j+1];

        explanation.innerHTML=`
            Bandingkan <strong style="color:#e67e22">Edisi ${a}</strong>
            dan <strong style="color:#e67e22">Edisi ${b}</strong>.<br>
        `;

        if(a>b){
            explanation.innerHTML+=`
                Karena ${a} &gt; ${b}, maka posisi harus
                <strong style="color:#e74c3c">DITUKAR</strong>.
            `;
            setBtn('LAKUKAN TUKAR','btn-swap');
        }else{
            explanation.innerHTML+=`
                Karena ${a} &lt; ${b}, maka posisi
                <strong style="color:#27ae60">TETAP</strong>.
            `;
            setBtn('POSISI TETAP','btn-stay');
        }
        state='DECIDE';
        return;
    }

    if(state==='DECIDE'){
        const a=arr[j],b=arr[j+1];

        if(a>b){
            [arr[j],arr[j+1]]=[b,a];
            swapVisuals(a,b,j,j+1);
        }
        j++;

        if(j>=n-1-i){
            addHistoryRow(`Iterasi ${i+1}`,[...arr]);
            i++;j=0;
            highlightBox.style.display='none';

            if(i>=n-1){
                finish();
                return;
            }

            iterBadge.innerText=`Iterasi ke-${i+1}`;
            explanation.innerHTML='Iterasi sebelumnya selesai.';
            setBtn('Lanjut Iterasi','btn-start');
            state='COMPARE';
        }else{
            state='COMPARE';
            setBtn('Cek Berikutnya','btn-check');
        }
    }
}

/* ===== SWAP PALING SMOOTH ===== */
function swapVisuals(v1,v2,idx1,idx2){
    const el1=document.getElementById(`book-${v1}`).parentElement;
    const el2=document.getElementById(`book-${v2}`).parentElement;

    el1.style.left=(startX+idx2*gap)+'px';
    el2.style.left=(startX+idx1*gap)+'px';
}

/* HISTORY (UNIVERSAL) */
function addHistoryRow(label, arrSnapshot){
    const row = document.createElement('div');
    row.className = 'history-row';

    let html = `<strong>${label}</strong>&nbsp;`;

    arrSnapshot.forEach(v => {
        html += `<img src="${IMG_PATH}edisi${v}.png" class="mini-book-img">`;
    });

    row.innerHTML = html;
    historyContainer.appendChild(row);
}


renderBooks();
addHistoryRow('Data Awal', [...arr]);
</script>

</body>
</html>
