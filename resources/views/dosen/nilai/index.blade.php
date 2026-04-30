@extends('layouts.hlmnd')

@section('title', 'Nilai')

@section('content')
<style>
    .card-panel { border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
    .table-rekap tbody tr:hover { background-color: #f8f9fa; transition: all 0.2s; }
    .th-header { text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; color: #6c757d; border-bottom-width: 2px; }
    .col-score { width: 50px; min-width: 50px; }
    
    /* Tambahan style untuk Accordion Kuis di dalam Modal */
    .accordion-button:not(.collapsed) { background-color: #f0fdf4; color: #0f5132; box-shadow: inset 0 -1px 0 rgba(0,0,0,.125); }
    .accordion-button:focus { box-shadow: none; border-color: rgba(0,0,0,.125); }
</style>

<div class="container-fluid py-4 px-4">

    <div class="card card-panel bg-white mb-4 border">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success mb-2 px-3 py-2 rounded-pill fw-semibold">
                        <i class="fa-solid fa-book me-1"></i> Buku Nilai Terpadu
                    </span>
                    <h2 class="fw-bold text-dark mb-1">Rekapitulasi Nilai Siswa</h2>
                    <p class="text-muted mb-0">Pantau perkembangan nilai Kuis, Praktikum, dan Evaluasi secara detail.</p>
                </div>
                
                <div class="mt-4 mt-md-0 d-flex gap-2">
                    <button class="btn btn-outline-secondary rounded-3 shadow-sm px-4 fw-medium">
                        <i class="fa-solid fa-print me-1"></i> Cetak
                    </button>
                    <button class="btn btn-success rounded-3 shadow-sm px-4 fw-medium">
                        <i class="fa-solid fa-file-excel me-1"></i> Export Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-panel bg-white mb-4 border">
        <div class="card-body p-3">
            <form action="" method="GET" class="row g-2 align-items-center">
                <div class="col-12 col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama mahasiswa..." value="{{ request('search') }}">
                </div>
                <div class="col-12 col-md-4">
                    <select name="kelas_id" class="form-select">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 fw-bold"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                    @if(request()->has('search') || request()->has('kelas_id'))
                        <a href="{{ url()->current() }}" class="btn btn-light border" title="Reset Filter"><i class="fa-solid fa-rotate-right"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card card-panel bg-white border">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-rekap table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 th-header fw-bold border-0 border-bottom border-end" rowspan="2" style="min-width: 220px;">Nama Siswa</th>
                            <th scope="col" class="px-3 py-3 th-header fw-bold text-center border-0 border-bottom border-end" rowspan="2" style="min-width: 100px;">Kelas</th>
                            
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end" colspan="5">Kuis (Modul)</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end" colspan="4">Praktikum</th>
                            <th scope="col" class="px-3 py-3 th-header fw-bold text-center border-0 border-bottom border-end" rowspan="2">Eval</th>
                            <th scope="col" class="px-3 py-3 th-header fw-bold text-center border-0 border-bottom border-end" rowspan="2">Rata</th>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center border-0 border-bottom" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score" title="Pendahuluan">Q1</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score" title="Bubble Sort">Q2</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score" title="Selection Sort">Q3</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score" title="Insertion Sort">Q4</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score" title="Merge Sort">Q5</th>
                            
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score text-primary" title="Bubble Praktikum">P1</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score text-primary" title="Selection Praktikum">P2</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score text-primary" title="Insertion Praktikum">P3</th>
                            <th scope="col" class="py-2 th-header fw-bold text-center border-0 border-bottom border-end col-score text-primary" title="Merge Praktikum">P4</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $mahasiswa)
                        
                        @php
                            // -------------------------------------------------------------
                            // ID DATABASE ANDA
                            // -------------------------------------------------------------
                            $id_k_pendahuluan = 3; $id_k_bubble = 7; $id_k_selection = 12; $id_k_insertion = 17; $id_k_merge = 22;
                            $id_p_bubble = 8; $id_p_selection = 13; $id_p_insertion = 18; $id_p_merge = 23;
                            $id_k_evaluasi = 24; 

                            $jawaban = $mahasiswa->jawaban;

                            // AMBIL NILAI KKM DARI DATABASE (Gunakan variabel $kkmSettings dari Controller)
                            $kkmKuis1 = $kkmSettings[3] ?? 75; 
                            $kkmKuis2 = $kkmSettings[7] ?? 75; 
                            $kkmKuis3 = $kkmSettings[12] ?? 75; 
                            $kkmKuis4 = $kkmSettings[17] ?? 75; 
                            $kkmKuis5 = $kkmSettings[22] ?? 75; 

                            $kkmPrak1 = $kkmSettings[8] ?? 75; 
                            $kkmPrak2 = $kkmSettings[13] ?? 75; 
                            $kkmPrak3 = $kkmSettings[18] ?? 75; 
                            $kkmPrak4 = $kkmSettings[23] ?? 75; 
                            
                            $kkmEvaluasi = $kkmSettings[24] ?? 75;
                            $kkmRataRata = 75; 
                        
                            $list_modul = [
                                ['id' => $id_k_pendahuluan, 'nama' => 'Q1 (Pendahuluan)', 'kkm' => $kkmKuis1],
                                ['id' => $id_k_bubble, 'nama' => 'Q2 (Bubble Sort)', 'kkm' => $kkmKuis2],
                                ['id' => $id_k_selection, 'nama' => 'Q3 (Selection Sort)', 'kkm' => $kkmKuis3],
                                ['id' => $id_k_insertion, 'nama' => 'Q4 (Insertion Sort)', 'kkm' => $kkmKuis4],
                                ['id' => $id_k_merge, 'nama' => 'Q5  (Merge Sort)', 'kkm' => $kkmKuis5],
                            ];

                            $detail_kuis_array = [];
                            $total_skor_kuis = 0;

                            foreach ($list_modul as $modul) {
                                $history = $jawaban->where('id_aktivitas', $modul['id'])->sortBy('created_at')->values();
                                $total_attempt = $history->count();
                                
                                $attempts_data = [];
                                
                                if ($total_attempt > 0) {
                                    foreach ($history as $idx => $attempt) {
                                        $waktu_mulai = '-'; $waktu_selesai = '-'; $durasi = '-';
                                        if ($attempt->waktu_mulai) $waktu_mulai = \Carbon\Carbon::parse($attempt->waktu_mulai)->format('d/m/y H:i');
                                        if ($attempt->waktu_selesai) $waktu_selesai = \Carbon\Carbon::parse($attempt->waktu_selesai)->format('d/m/y H:i');
                                        
                                        if ($attempt->waktu_mulai && $attempt->waktu_selesai) {
                                            $diff = \Carbon\Carbon::parse($attempt->waktu_mulai)->diffInSeconds(\Carbon\Carbon::parse($attempt->waktu_selesai));
                                            $m = floor($diff / 60); $s = $diff % 60;
                                            $durasi = $m > 0 ? "{$m}m {$s}s" : "{$s}s";
                                        }

                                        // --- PARSING JSON DETAIL JAWABAN (Dinamis) ---
                                        $raw_detail = json_decode($attempt->detail_jawaban, true) ?? [];
                                        $jawaban_status = []; // Gunakan array kosong

                                        foreach ($raw_detail as $key => $data) {
                                            $nomor = (int) str_replace('q', '', $key);
                                            
                                            // Ambil status is_correct dari struktur JSON baru yang kita buat di Controller
                                            if (is_array($data) && isset($data['is_correct'])) {
                                                $jawaban_status[$nomor] = $data['is_correct'];
                                            } else {
                                                $jawaban_status[$nomor] = null;
                                            }
                                        }
                                        // Sortir agar urutan nomor soal benar (1, 2, 3...)
                                        ksort($jawaban_status);

                                        $attempts_data[] = [
                                            'attempt' => $idx + 1,
                                            'mulai'   => $waktu_mulai,
                                            'selesai' => $waktu_selesai,
                                            'durasi'  => $durasi,
                                            'skor'    => $attempt->skor,
                                            'detail_soal' => $jawaban_status
                                        ];
                                    }
                                }

                                $skor_terakhir = $total_attempt > 0 ? $history->last()->skor : 0;
                                $total_skor_kuis += $skor_terakhir;

                                $detail_kuis_array[] = [
                                    'nama'          => $modul['nama'],
                                    'total_attempt' => $total_attempt,
                                    'skor_terakhir' => $skor_terakhir,
                                    'attempts'      => $attempts_data,
                                    'kkm'           => $modul['kkm']
                                ];
                            }
                            
                            $rataKuis = $total_skor_kuis / 5;

                            // PRAKTIKUM
                            $praktikum = $mahasiswa->pengumpulanPraktikum;
                            $p1 = $praktikum->where('id_praktikum', $id_p_bubble)->sortByDesc('created_at')->first()->nilai ?? 0;
                            $p2 = $praktikum->where('id_praktikum', $id_p_selection)->sortByDesc('created_at')->first()->nilai ?? 0;
                            $p3 = $praktikum->where('id_praktikum', $id_p_insertion)->sortByDesc('created_at')->first()->nilai ?? 0;
                            $p4 = $praktikum->where('id_praktikum', $id_p_merge)->sortByDesc('created_at')->first()->nilai ?? 0;
                            $rataPraktikum = ($p1 + $p2 + $p3 + $p4) / 4;

                            // EVALUASI
                            $evaluasi = $jawaban->where('id_aktivitas', $id_k_evaluasi)->sortByDesc('created_at')->first()->skor ?? 0; 
                            
                            // RATA-RATA
                            $rataAkhir = ($rataKuis + $rataPraktikum + $evaluasi) / 3;
                            $formatRata = number_format($rataAkhir, 1);
                        @endphp

                        <tr>
                            <td class="px-4 py-2 border-0 border-bottom border-end">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 40px; height: 40px; font-size: 1rem;">
                                        {{ strtoupper(substr($mahasiswa->user->nama ?? $mahasiswa->user->name ?? 'M', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $mahasiswa->user->nama ?? $mahasiswa->user->name ?? 'Nama Siswa' }}</div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">
                                            {{ $mahasiswa->nim }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-2 py-2 text-center border-0 border-bottom border-end">
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1">
                                    {{ $mahasiswa->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center border-0 border-bottom border-end"><span class="{{ $detail_kuis_array[0]['skor_terakhir'] >= $kkmKuis1 ? 'text-success' : 'text-danger' }} fw-bold">{{ $detail_kuis_array[0]['skor_terakhir'] }}</span></td>
                            <td class="text-center border-0 border-bottom border-end"><span class="{{ $detail_kuis_array[1]['skor_terakhir'] >= $kkmKuis2 ? 'text-success' : 'text-danger' }} fw-bold">{{ $detail_kuis_array[1]['skor_terakhir'] }}</span></td>
                            <td class="text-center border-0 border-bottom border-end"><span class="{{ $detail_kuis_array[2]['skor_terakhir'] >= $kkmKuis3 ? 'text-success' : 'text-danger' }} fw-bold">{{ $detail_kuis_array[2]['skor_terakhir'] }}</span></td>
                            <td class="text-center border-0 border-bottom border-end"><span class="{{ $detail_kuis_array[3]['skor_terakhir'] >= $kkmKuis4 ? 'text-success' : 'text-danger' }} fw-bold">{{ $detail_kuis_array[3]['skor_terakhir'] }}</span></td>
                            <td class="text-center border-0 border-bottom border-end bg-light"><span class="{{ $detail_kuis_array[4]['skor_terakhir'] >= $kkmKuis5 ? 'text-success' : 'text-danger' }} fw-bold">{{ $detail_kuis_array[4]['skor_terakhir'] }}</span></td>

                            <td class="text-center border-0 border-bottom border-end"><span class="{{ $p1 >= $kkmPrak1 ? 'text-primary' : 'text-secondary' }} fw-bold">{{ $p1 }}</span></td>
                            <td class="text-center border-0 border-bottom border-end"><span class="{{ $p2 >= $kkmPrak2 ? 'text-primary' : 'text-secondary' }} fw-bold">{{ $p2 }}</span></td>
                            <td class="text-center border-0 border-bottom border-end"><span class="{{ $p3 >= $kkmPrak3 ? 'text-primary' : 'text-secondary' }} fw-bold">{{ $p3 }}</span></td>
                            <td class="text-center border-0 border-bottom border-end bg-light"><span class="{{ $p4 >= $kkmPrak4 ? 'text-primary' : 'text-secondary' }} fw-bold">{{ $p4 }}</span></td>

                            <td class="text-center border-0 border-bottom border-end"><span class="fw-bold {{ $evaluasi >= $kkmEvaluasi ? 'text-success' : 'text-danger' }}">{{ $evaluasi }}</span></td>
                            <td class="text-center border-0 border-bottom border-end"><span class="badge {{ $rataAkhir >= $kkmRataRata ? 'bg-success' : 'bg-warning text-dark' }} fs-6 shadow-sm">{{ $formatRata }}</span></td>

                            <td class="text-center border-0 border-bottom">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-medium"
                                        data-nama="{{ $mahasiswa->user->nama ?? $mahasiswa->user->name ?? 'Siswa' }}"
                                        data-nim="{{ $mahasiswa->nim }}"
                                        data-kelas="{{ $mahasiswa->kelas->nama_kelas ?? '-' }}"
                                        data-evaluasi="{{ $evaluasi }}"
                                        data-kkm-evaluasi="{{ $kkmEvaluasi }}"
                                        data-kuis-detail="{{ json_encode($detail_kuis_array) }}"
                                        onclick="openDetailModal(this)" title="Lihat Rincian Attempt & Evaluasi">
                                    <i class="fa-solid fa-expand"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox fs-2 d-block mb-2 opacity-50"></i> Belum ada data siswa
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailNilaiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content shadow-lg border-0 rounded-4">
            
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Rincian Attempt Kuis & Evaluasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold fs-3 flex-shrink-0" style="width: 55px; height: 55px;" id="mdl_inisial">M</div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" id="mdl_nama">Nama Siswa</h5>
                        <div class="text-muted small"><span id="mdl_nim">NIM</span> &bull; <span class="text-primary fw-medium" id="mdl_kelas">Kelas</span></div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="fw-bold text-secondary small text-uppercase tracking-wide mb-2">Riwayat Percobaan & Detail Jawaban</label>
                    <div class="accordion" id="accordionKuisDetail"></div>
                </div>

                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="bg-secondary bg-opacity-10 border border-secondary border-opacity-25 rounded-4 p-3 text-center">
                            <small class="fw-bold text-secondary text-uppercase tracking-wide" id="lbl_kkm_evaluasi">Nilai Ujian Evaluasi Akhir</small><br>
                            <span class="fs-1 fw-bold text-dark" id="mdl_evaluasi">0</span>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="modal-footer border-top-0 pt-0 pb-4 justify-content-center">
                <button type="button" class="btn btn-light border px-5 rounded-pill fw-medium shadow-sm" data-bs-dismiss="modal">Tutup Detail</button>
            </div>
            
        </div>
    </div>
</div>

<script>
    function openDetailModal(btn) {
        const nama = btn.getAttribute('data-nama');
        document.getElementById('mdl_nama').innerText = nama;
        document.getElementById('mdl_nim').innerText = btn.getAttribute('data-nim');
        document.getElementById('mdl_kelas').innerText = btn.getAttribute('data-kelas');
        document.getElementById('mdl_inisial').innerText = nama ? nama.charAt(0).toUpperCase() : 'M';
        
        // PERBAIKAN: Ambil KKM Evaluasi 
        const kkmEvaluasi = parseInt(btn.getAttribute('data-kkm-evaluasi')) || 75;

        // UPDATE MODAL EVALUASI
        const nilaiEvaluasi = parseInt(btn.getAttribute('data-evaluasi')) || 0;
        const elEvaluasi = document.getElementById('mdl_evaluasi');
        elEvaluasi.innerText = nilaiEvaluasi;
        document.getElementById('lbl_kkm_evaluasi').innerText = `Nilai Ujian Evaluasi Akhir (KKM: ${kkmEvaluasi})`;

        if (nilaiEvaluasi >= kkmEvaluasi) {
            elEvaluasi.className = "fs-1 fw-bold text-success";
        } else {
            elEvaluasi.className = "fs-1 fw-bold text-danger";
        }

        const kuisData = JSON.parse(btn.getAttribute('data-kuis-detail'));
        const accordionContainer = document.getElementById('accordionKuisDetail');
        accordionContainer.innerHTML = ''; 

        kuisData.forEach((modul, index) => {
            // PERBAIKAN: Menggunakan modul.kkm 
            let badgeMainClass = modul.skor_terakhir >= modul.kkm ? 'success' : 'danger';
            let collapseId = `collapseKuis${index}`;
            let headingId = `headingKuis${index}`;

            let tableRows = '';
            let tableHeaderCols = '';
            let maxQuestions = 0;

            // Cari jumlah soal terbanyak dari attempt untuk membuat header kolom
            modul.attempts.forEach(att => {
                if (att.detail_soal.length > maxQuestions) maxQuestions = att.detail_soal.length;
            });

            // Jika data berbentuk objek (karena ksort di PHP), kita sesuaikan cara hitungnya
            // Atau lebih amannya, biarkan Javascript membuat kolom berdasarkan data yang ada
            if (modul.total_attempt > 0) {
                // Buat Header Angka (1, 2, 3, dst) secara dinamis
                // Kita asumsikan jumlah soal konsisten, ambil dari attempt pertama
                let sampleAttempt = modul.attempts[0].detail_soal;
                // Jika detail_soal adalah objek, kita hitung keys-nya
                let questionKeys = Object.keys(sampleAttempt); 
                
                questionKeys.forEach(num => {
                    tableHeaderCols += `<th class="text-center py-2 text-secondary" style="font-size: 0.75rem;">${num}</th>`;
                });

                modul.attempts.forEach(att => {
                    let attBadge = att.skor >= modul.kkm ? 'success' : 'danger';
                    let detailHtml = '';

                    // Tampilkan centang/silang secara dinamis
                    Object.keys(att.detail_soal).forEach(num => {
                        let status = att.detail_soal[num];
                        if (status === true) {
                            detailHtml += `<td class="text-center align-middle"><i class="fa-solid fa-check text-success fs-6"></i></td>`;
                        } else if (status === false) {
                            detailHtml += `<td class="text-center align-middle"><i class="fa-solid fa-xmark text-danger fs-6"></i></td>`;
                        } else {
                            detailHtml += `<td class="text-center align-middle text-muted">-</td>`;
                        }
                    });

                    tableRows += `
                        <tr>
                            <td class="text-center fw-bold text-secondary align-middle">Attempt ${att.attempt}</td>
                            <td class="text-center text-muted align-middle" style="font-size: 0.8rem;">${att.mulai}</td>
                            <td class="text-center text-muted align-middle" style="font-size: 0.8rem;">${att.selesai}</td>
                            <td class="text-center fw-medium align-middle" style="font-size: 0.85rem;"><i class="fa-regular fa-clock me-1"></i> ${att.durasi}</td>
                            <td class="text-center align-middle border-end"><span class="badge bg-${attBadge} px-2 py-1 fs-6">${att.skor}</span></td>
                            ${detailHtml}
                        </tr>
                    `;
                });

            } else {
                tableRows = `<tr><td colspan="15" class="text-center text-muted py-3">Siswa belum mengerjakan kuis ini.</td></tr>`;
            }

            let accordionItem = `
                <div class="accordion-item border-0 mb-2 rounded-3 shadow-sm" style="overflow: hidden;">
                    <h2 class="accordion-header" id="${headingId}">
                        <button class="accordion-button collapsed border px-3 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseId}">
                            <div class="d-flex justify-content-between align-items-center w-100 me-2">
                                <div>
                                    <span class="fw-bold text-dark">${modul.nama}</span>
                                    <span class="ms-2 badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25" style="font-size: 0.7rem;">KKM: ${modul.kkm}</span>
                                </div>
                                <div>
                                    <span class="badge bg-light text-secondary border me-1">${modul.total_attempt} Attempt</span>
                                    <span class="badge bg-${badgeMainClass}">Nilai Terakhir: ${modul.skor_terakhir}</span>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="${collapseId}" class="accordion-collapse collapse border border-top-0" data-bs-parent="#accordionKuisDetail">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center py-2 text-secondary" style="font-size: 0.75rem; text-transform: uppercase;">Attempt</th>
                                            <th class="text-center py-2 text-secondary" style="font-size: 0.75rem; text-transform: uppercase;">Mulai</th>
                                            <th class="text-center py-2 text-secondary" style="font-size: 0.75rem; text-transform: uppercase;">Selesai</th>
                                            <th class="text-center py-2 text-secondary" style="font-size: 0.75rem; text-transform: uppercase;">Waktu</th>
                                            <th class="text-center py-2 text-secondary border-end" style="font-size: 0.75rem; text-transform: uppercase;">Skor</th>
                                            ${tableHeaderCols}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${tableRows}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            accordionContainer.innerHTML += accordionItem;
        });

        var modalElement = document.getElementById('detailNilaiModal');
        var modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (!modalInstance) {
            modalInstance = new bootstrap.Modal(modalElement);
        }
        modalInstance.show();
    }
</script>
@endsection