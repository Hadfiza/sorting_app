@extends('layouts.landing_layouts')

@section('title', 'Kodeku - SortLearn')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">

    <style>
        /* Penyesuaian agar konten tidak tertutup Navbar Fixed */
        body {
            background-color: #f8f9fa; /* Abu-abu terang agar kontras dengan editor */
            padding-top: 80px;
        }

        /* --- STYLING EDITOR PYTHON --- */
        .editor-container {
            display: flex;
            justify-content: center;
            padding-bottom: 50px;
        }

        .app-wrapper {
            width: 100%;
            max-width: 1000px; /* Lebar maksimal editor */
            height: 600px;     /* Tinggi Tetap */
            background: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Header Editor */
        .editor-header {
            padding: 15px 20px;
            background: #2d2d2d;
            border-bottom: 1px solid #444;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            height: 60px;          /* Tambahkan sedikit tinggi agar tidak sesak */
        }

        .editor-header h2 { margin: 0 0 0 10px; font-size: 1.1rem; font-weight: bold; line-height: 1;}

        /* Container Split Kiri-Kanan */
        .split-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* Panel Kiri (Input) */
        .panel-left {
            flex: 6; /* 60% */
            border-right: 1px solid #444;
            display: flex;
            flex-direction: column;
            text-align: left; /* Reset text align bootstrap */
        }

        /* Panel Kanan (Output) */
        .panel-right {
            flex: 4; /* 40% */
            display: flex;
            flex-direction: column;
            background: #101010;
            text-align: left;
        }

        .panel-label {
            background: #333;
            color: #ccc;
            padding: 5px 15px;
            font-size: 0.8rem;
            text-transform: uppercase;
            border-bottom: 1px solid #444;
        }

        /* CodeMirror Override */
        .CodeMirror {
            flex-grow: 1;
            height: 100%;
            font-size: 14px;
        }

        /* Output Area */
        #output {
            padding: 15px;
            color: #00ff00;
            font-family: monospace;
            white-space: pre-wrap;
            overflow-y: auto;
            flex-grow: 1;
            font-size: 14px;
        }

        /* Tombol Run */
        .btn-run {
            padding: 8px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-run:hover { background: #218838; color: white; }
        .btn-run:disabled { background: #555; cursor: not-allowed; }
        
        #status { color: #aaa; font-size: 0.9rem; margin-right: 10px; }

        .editor-logo {
            height: 30px;          /* Tinggi tetap agar proporsional */
            width: auto;           /* Lebar mengikuti proporsi asli gambar */
            display: block;
            object-fit: contain;    /* Mencegah gambar terpotong */
            flex-shrink: 0;         /* Mencegah logo mengecil jika ruang sempit */
        }

        /* Pastikan pembungkus logo dan teks menggunakan flexbox */
        .editor-header .flex.items-center {
            display: flex;
            align-items: center; /* Menjaga logo dan teks sejajar vertikal */
        }

        @media (max-width: 768px){
            body{
                padding-top: 0px;
            }
            
            .app-wrapper{
                height: auto;        /* 🔥 hilangkan fixed height */
            }

            .split-container{
                flex-direction: column; /* 🔥 jadi atas-bawah */
            }

            .panel-left,
            .panel-right{
                flex: none;
                width: 100%;
            }

            .panel-left{
                height: 250px; /* editor */
            }

            .panel-right{
                height: 200px; /* output */
            }

            .editor-header{
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                height: auto;
            }

            .btn-run{
                width: 100%;
            }

            #output{
                font-size: 12px;
                padding: 10px;
            }

            .CodeMirror{
                font-size: 12px;
            }

            .btn-run{
                width: auto;               /* 🔥 jangan full */
                font-size: 12px;
                padding: 6px 12px;
            }
    
}
    </style>
@endsection

@section('content')
<section class="container mt-4 mb-5">
    <div class="row text-center mb-4">
        <div class="col-12">
            <h2 class="fw-bold">Latihan Python</h2>
            <p class="text-muted">Tulis dan jalankan kode Python-mu langsung di sini.</p>
        </div>
    </div>

    <div class="editor-container">
        <div class="app-wrapper">
            
            <header class="editor-header">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/LOGO.png') }}" alt="Logo"  class="editor-logo">
                    <h2 class="text-white font-bold ml-2">Python Editor</h2>
                </div>

                <div>
                    <span id="status">Loading Pyodide...</span>
                    <button id="runBtn" class="btn-run" disabled>▶ Run Code</button>
                </div>
            </header>
    
            <div class="split-container">
                <div class="panel-left">
                    <div class="panel-label">Input Code</div>
<textarea id="code">
def segitiga(n):
    for i in range(1, n + 1):
        print("*" * i)

print("Membuat pola segitiga:")
segitiga(5)

print("\nMenghitung angka:")
total = 0
for x in [10, 20, 30]:
    total += x
print(f"Total penjumlahan: {total}")
</textarea>
                </div>
    
                <div class="panel-right">
                    <div class="panel-label">Console Output</div>
                    <div id="output"></div>
                </div>
            </div>
    
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
    <script src="https://cdn.jsdelivr.net/pyodide/v0.23.4/full/pyodide.js"></script>

    <script>
        // 1. Konfigurasi CodeMirror (Editor)
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            mode: {name: "python", version: 3},
            theme: "dracula",
            lineNumbers: true,
            indentUnit: 4,
            smartIndent: true
        });

        // 2. Konfigurasi Pyodide (Runner)
        const outputDiv = document.getElementById("output");
        const runBtn = document.getElementById("runBtn");
        const statusSpan = document.getElementById("status");
        let pyodideInstance = null;

        // Fungsi menambahkan teks ke panel output kanan
        function addToOutput(text) {
            outputDiv.innerText += text + "\n";
            outputDiv.scrollTop = outputDiv.scrollHeight; // Auto scroll ke bawah
        }

        // Fungsi Utama Loading Pyodide
        async function main() {
            try {
                pyodideInstance = await loadPyodide({
                    stdout: (text) => addToOutput(text),
                    stderr: (text) => addToOutput(text)
                });
                
                // Jika berhasil load
                runBtn.disabled = false;
                statusSpan.innerText = "";
                
            } catch (err) {
                statusSpan.innerText = "Error Loading Pyodide";
                console.error(err);
            }
        }

        // Event Listener Tombol Run
        runBtn.addEventListener('click', async () => {
            outputDiv.innerText = ""; // Bersihkan output lama
            const code = editor.getValue(); // Ambil kode dari editor
            
            try {
                runBtn.disabled = true;
                statusSpan.innerText = "Running...";
                
                await pyodideInstance.runPythonAsync(code);
                
                statusSpan.innerText = "";
            } catch (err) {
                addToOutput(err); // Tampilkan error di output panel
            } finally {
                runBtn.disabled = false;
            }
        });

        // Jalankan inisialisasi
        main();
    </script>
@endsection