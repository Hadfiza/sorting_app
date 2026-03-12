@extends('layouts.hlmns')

@section('title','Merge Sort Tree Visualizer')

@section('css')
<link rel="stylesheet" href="{{ asset('css/merge.css') }}">

<style>
    .sim-visual-container {
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        padding: 25px;
        margin: 20px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        text-align: center;
        overflow-x: auto;
    }

    .stats-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: #58a6ff;
        margin-bottom: 25px;
    }

    .tree-root {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 30px;
        min-height: 250px;
        padding: 10px;
    }

    .tree-level {
        display: flex;
        justify-content: center;
        gap: 40px;
        width: 100%;
    }

    .array-node {
        display: flex;
        gap: 2px;
        border: 1px solid #30363d;
        padding: 3px;
        border-radius: 6px;
        background: #0d1117;
        transition: all 0.4s ease;
    }

    .data-element {
        background: #8b949e;
        color: white;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.85rem;
        border-radius: 4px;
    }

    .array-node.splitting {
        border-color: #f1c40f;
        box-shadow: 0 0 10px rgba(241, 196, 15, 0.3);
    }

    .array-node.splitting .data-element {
        background: #f1c40f;
    }

    .array-node.merging {
        border-color: #ffffff;
    }

    .array-node.merging .data-element {
        background: #ffffff;
        color: black;
    }

    .array-node.is-sorted .data-element {
        background: #3fb950;
    }

    .legend-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 25px;
        font-size: 0.8rem;
        color: #8b949e;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .color-box {
        width: 14px;
        height: 14px;
        border-radius: 3px;
    }

    .controls-row {
        margin-top: 25px;
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn-visual {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid #30363d;
    }

    .btn-start-v {
        background: #238636;
        color: white;
        border: none;
    }

    .btn-reset-v {
        background: #21262d;
        color: white;
    }
</style>
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card title-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="title-icon me-3">
                <i class="fas fa-layer-group"></i>
            </div>
            <div>
                <h3 class="mb-0">Algoritma Merge Sort</h3>
            </div>
        </div>
    </div>
</div>

<div class="materi-page">

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <h5 class="card-title">Tujuan Pembelajaran</h5>
            <p>Setelah menyelesaikan materi pada bab ini, mahasiswa diharapkan mampu:</p>
            <ul>
                <li>menjelaskan prinsip Divide, Conquer, and Combine pada proses pengurutan data berbasis rekursif.</li>
                <li>mensimulasikan tahap pembagian dan penggabungan data secara sistematis.</li>
                <li>merancang algoritma Merge Sort kedalam bahasa pemrograman.</li>
            </ul>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-book-open"></i>
                <span class="materi-badge">Pengertian Merge Sort</span>
            </div>
            <p class="card-text text-justify">
                Merge Sort adalah algoritma pengurutan berbasis strategi Divide and Conquer (membagi dan menaklukkan) yang dirancang untuk meningkatkan efisiensi algoritma pengurutan sederhana seperti Bubble Sort, Selection Sort, dan Insertion Sort. Algoritma ini bekerja dengan cara memecah daftar data menjadi dua bagian yang lebih kecil, kemudian mengurutkan masing-masing bagian secara rekursif, dan akhirnya menggabungkannya kembali (merge) menjadi satu daftar baru yang terurut.</br></br>

                Pada tahap awal, jika sebuah daftar kosong atau hanya memiliki satu elemen, daftar tersebut dianggap sudah berada dalam keadaan terurut. Namun, jika jumlah elemennya lebih dari satu, daftar akan dipecah menjadi dua sublist. Kedua sublist tersebut kemudian diurutkan kembali menggunakan prosedur yang sama secara rekursif. Setelah kedua sublist berada dalam kondisi terurut, dilakukan proses penggabungan, yaitu menggabungkan dua daftar terurut tersebut menjadi satu urutan baru yang terurut sepenuhnya. <br> <br>

                Disebut Merge Sort karena operasi utamanya adalah proses penggabungan dua sublist terurut menjadi satu urutan yang juga terurut. Dengan pendekatan divide and conquer ini, Merge Sort termasuk algoritma pengurutan yang stabil, rekursif, dan sangat efisien, dengan kompleksitas waktu rata-rata dan terburuk O(n log n). Namun, algoritma ini memerlukan memori tambahan untuk menyimpan hasil penggabungan, sehingga lebih boros ruang dibandingkan algoritma in-place seperti Quick Sort.
            </p>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-solid fa-play-circle"></i>
                <span class="materi-badge">Ilustrasi Visualisasi (Divide & Conquer)</span>
            </div>

            <div class="sim-visual-container">
                <div class="stats-row">
                    <span>Complexity: O(n log n)</span>
                    <span>Space Complexity: O(n)</span>
                </div>

                <div id="tree-container" class="tree-root"></div>

                <div class="legend-row">
                    <div class="legend-item">
                        <div class="color-box" style="background:#f1c40f;"></div>
                        Proses Membagi
                    </div>
                    <div class="legend-item">
                        <div class="color-box" style="background:#ffffff;border:1px solid #8b949e;"></div>
                        Proses Menggabung
                    </div>
                    <div class="legend-item">
                        <div class="color-box" style="background:#3fb950;"></div>
                        Bagian Terurut
                    </div>
                </div>

                <div class="controls-row">
                    <button id="mResetBtn" class="btn-visual btn-reset-v" onclick="initM()">
                        Acak Data
                    </button>
                    <button id="mStartBtn" class="btn-visual btn-start-v" onclick="startM()">
                        Mulai Visualisasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 materi-box">
        <div class="card-body materi-text">
            <div class="materi-header">
                <i class="fa-sharp-duotone fa-solid fa-shuffle"></i>
                <span class="materi-badge">Cara Kerja</span>
            </div>
            <p class="card-text text-justify">
                Algoritma Merge Sort bekerja dengan membagi daftar data menjadi dua bagian yang lebih kecil, mengurutkan masing-masing bagian tersebut, lalu menggabungkannya kembali menjadi satu daftar yang terurut. Proses ini menggunakan pendekatan rekursif, di mana fungsi memanggil dirinya sendiri untuk menangani sublist yang lebih kecil. <br><br> Tahapan prosesnya adalah sebagai berikut:
            </p>
            <ul class="card-text">
                <li>Membagi (Divide): daftar data dibagi menjadi dua bagian dengan ukuran hampir sama.</li>
                <li>Mengurutkan (Conguer): setiap bagian diurutkan kembali secara rekursif hingga hanya tersisa satu elemen di tiap sublist.</li>
                <li>Menggabungkan (Merge): dua sublist yang sudah terurut digabungkan menjadi satu daftar baru dengan membandingkan elemen-elemen terkecil dari masing-masing sublist, lalu menyusunnya ke dalam urutan yang benar.</li>
            </ul>
            <p class="card-text text-justify">
                Langkah-langkah di atas akan terus berulang sampai seluruh data tergabung kembali menjadi satu daftar lengkap yang sudah terurut sempurna. Dengan cara ini, Merge Sort dapat mengurutkan data secara efisien karena proses pengurutan dilakukan selama proses penggabungan (merging), bukan setelahnya.
            </p>
        </div>
    </div>

</div>

<div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
    <a href="#" class="btn btn-outline-secondary">Sebelumnya</a>
    <a href="{{ route('mahasiswa.aktivitas.show',['merge','simulasi']) }}" class="btn btn-primary">Selanjutnya</a>
</div>

<script>
    let currentData = [];
    const treeCont = document.getElementById("tree-container");
    const mStartBtn = document.getElementById("mStartBtn");
    const mResetBtn = document.getElementById("mResetBtn");

    function initM() {
        currentData = Array.from({ length: 8 }, () => Math.floor(Math.random() * 80) + 10);
        treeCont.innerHTML = "";
        createNode(currentData, 0);
        mStartBtn.disabled = false;
        mResetBtn.disabled = false;
    }

    function createNode(arr, level, nodeId = "") {
        let levelDiv = document.getElementById("level-" + level);
        if (!levelDiv) {
            levelDiv = document.createElement("div");
            levelDiv.id = "level-" + level;
            levelDiv.className = "tree-level";
            treeCont.appendChild(levelDiv);
        }

        const node = document.createElement("div");
        node.className = "array-node";
        if (nodeId) node.id = nodeId;

        arr.forEach(val => {
            const el = document.createElement("div");
            el.className = "data-element";
            el.innerText = val;
            node.appendChild(el);
        });

        levelDiv.appendChild(node);
        return node;
    }

    const sleepM = (ms) => new Promise(res => setTimeout(res, ms));

    async function combine(nodeId, start, mid, end) {
        let left = currentData.slice(start, mid + 1);
        let right = currentData.slice(mid + 1, end + 1);
        let merged = [];
        let i = 0;
        let j = 0;

        while (i < left.length && j < right.length) {
            if (left[i] <= right[j]) merged.push(left[i++]);
            else merged.push(right[j++]);
        }

        while (i < left.length) merged.push(left[i++]);
        while (j < right.length) merged.push(right[j++]);

        for (let x = 0; x < merged.length; x++) {
            currentData[start + x] = merged[x];
        }

        const node = document.getElementById(nodeId);
        node.classList.remove("splitting");
        node.classList.add("merging");

        await sleepM(800);
        node.innerHTML = "";

        merged.forEach(val => {
            const el = document.createElement("div");
            el.className = "data-element";
            el.innerText = val;
            node.appendChild(el);
        });

        node.classList.remove("merging");
        node.classList.add("is-sorted");
        await sleepM(600);
    }

    async function divide(level, start, end, nodeId) {
        if (start < end) {
            let mid = Math.floor((start + end) / 2);
            let leftArr = currentData.slice(start, mid + 1);
            let rightArr = currentData.slice(mid + 1, end + 1);

            const parent = document.getElementById(nodeId);
            parent.classList.add("splitting");
            await sleepM(600);

            let leftId = "node-" + level + "-" + start;
            let rightId = "node-" + level + "-" + end;

            createNode(leftArr, level + 1, leftId);
            await sleepM(600);

            createNode(rightArr, level + 1, rightId);
            await sleepM(800);

            await divide(level + 1, start, mid, leftId);
            await divide(level + 1, mid + 1, end, rightId);

            await combine(nodeId, start, mid, end);
        } else {
            const node = document.getElementById(nodeId);
            node.classList.add("is-sorted");
            await sleepM(400);
        }
    }

    async function startM() {
        mStartBtn.disabled = true;
        mResetBtn.disabled = true;

        const rootNodeId = "root-node";
        document.querySelector("#level-0 .array-node").id = rootNodeId;

        await divide(0, 0, currentData.length - 1, rootNodeId);

        mResetBtn.disabled = false;

        Swal.fire({
            title: 'Selesai!',
            text: 'Merge Sort berhasil divisualisasikan.',
            icon: 'success',
            timer: 2000
        });
    }

    document.addEventListener("DOMContentLoaded", initM);
</script>

@endsection