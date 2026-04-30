/* =========================================
   GLOBAL PYTHON LIVE EDITOR (FINAL VERSION)
========================================= */

let editorInstance = null;
let pyodideInstance = null;
let editorInitialized = false;

document.addEventListener("DOMContentLoaded", async function () {

    const textarea = document.getElementById("code");
    const runBtn = document.getElementById("runBtn");
    const submitBtn = document.getElementById("submitBtn");
    const outputDiv = document.getElementById("output");
    const penjelasanInput = document.getElementById("penjelasanMahasiswa");

    // Kalau halaman ini tidak punya editor → STOP
    if (!textarea || !runBtn || !outputDiv) return;

    // Hindari init dua kali
    if (editorInitialized) return;

    /* =========================
       INIT CODEMIRROR
    ========================= */
    editorInstance = CodeMirror.fromTextArea(textarea, {
        mode: "python",
        theme: "dracula",
        lineNumbers: true,
        indentUnit: 4,
        smartIndent: true,
        matchBrackets: true
    });

    editorInstance.setSize(null, 400);

    /* =========================
       LOAD PYODIDE
    ========================= */
    pyodideInstance = await loadPyodide({
        stdout: (text) => {
            outputDiv.innerText += text + "\n";
        },
        stderr: (text) => {
            outputDiv.innerText += text + "\n";
        }
    });

    runBtn.disabled = false;

    /* =========================
       RUN BUTTON
    ========================= */
    runBtn.addEventListener("click", async function () {

        outputDiv.innerText = "";
        runBtn.disabled = true;

        try {
            await pyodideInstance.runPythonAsync(editorInstance.getValue());
        } catch (err) {
            outputDiv.innerText += err + "\n";
        }

        runBtn.disabled = false;
    });

    /* =========================
       SUBMIT BUTTON
    ========================= */
    if (submitBtn) {

        submitBtn.addEventListener("click", async function () {

            const kode = editorInstance.getValue();
            const output = outputDiv.innerText;
            const penjelasan = penjelasanInput ? penjelasanInput.value : "";

            // Validasi sederhana
            if (!kode.trim()) {
                alert("Kode tidak boleh kosong!");
                return;
            }

            if (!penjelasan.trim()) {
                alert("Penjelasan tidak boleh kosong!");
                return;
            }

            if (!output || !output.trim() || output.trim() === "") {
                alert("Output tidak boleh kosong! Klik RUN dulu sebelum submit.");
                return;
            }

            if (output.toLowerCase().includes("error")) {
                alert("Masih ada error pada program! Perbaiki dulu sebelum submit.");
                return;
            }

            if (!output.trim()) {
                alert("Output tidak boleh kosong! Jalankan kode dulu.");
                return;
            }

            if (typeof PRAKTIKUM_ID === "undefined") {
                alert("Praktikum ID tidak ditemukan!");
                return;
            }

            submitBtn.disabled = true;

            try {
                const response = await fetch(SUBMIT_URL, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        kode_program: kode,
                        output: output,
                        penjelasan: penjelasan,
                        praktikum_id: PRAKTIKUM_ID
                    })
                }); 

                const result = await response.json();

                if (result.success) {
                    alert("Berhasil disubmit!");
                    if (typeof AKTIVITAS_ID !== "undefined" && typeof TANDAI_SELESAI_URL !== "undefined") {
                        try {
                            const resProgres = await fetch(TANDAI_SELESAI_URL, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    "Accept": "application/json"
                                },
                                body: JSON.stringify({
                                    id_aktivitas: AKTIVITAS_ID
                                })
                            });
                            
                            const dataProgres = await resProgres.json();
                            if (dataProgres.success) {
                                // Refresh halaman otomatis agar UI "Lanjut" langsung terbuka
                                window.location.reload(); 
                            }
                        } catch (errProgres) {
                            console.error("Gagal mengupdate progres:", errProgres);
                        }
                    }
                } else {
                    alert("Gagal submit.");
                }

            } catch (err) {
                alert("Terjadi kesalahan server.");
                console.error(err);
            }

            submitBtn.disabled = false;
        });
    }

    editorInitialized = true;
});