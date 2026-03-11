@extends('layouts.hlmnd')

@section('content')
<style>
    .card-panel {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }
    .table-rekap tbody tr:hover {
        background-color: #f8f9fa;
        transition: all 0.2s;
    }
    .score-box {
        font-weight: 700;
        font-size: 1rem;
        display: inline-block;
        min-width: 45px;
        text-align: center;
    }
    .attempt-badge {
        font-size: 0.7rem;
        padding: 0.25em 0.5em;
        border-radius: 4px;
        margin-left: 5px;
        vertical-align: middle;
    }
    .th-header {
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom-width: 2px;
    }
</style>

<div class="container py-4">
    <div class="card card-panel bg-white mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success mb-2 px-3 py-2 rounded-pill fw-semibold">
                        <i class="bi bi-journal-bookmark-fill me-1"></i> Buku Nilai Terpadu
                    </span>
                    <h2 class="fw-bold text-dark mb-1">Rekapitulasi Nilai Mahasiswa</h2>
                    <p class="text-muted mb-0">Pantau perkembangan nilai Kuis, Praktikum, dan Evaluasi dari kelas Anda.</p>
                </div>
                <div class="mt-4 mt-md-0 d-flex gap-2">
                    <button class="btn btn-outline-secondary rounded-3 shadow-sm px-4">
                        <i class="bi bi-printer me-1"></i> Cetak
                    </button>
                    <button class="btn btn-primary rounded-3 shadow-sm px-4">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-panel bg-white mb-4 border">
        <div class="card-body p-3 p-md-4">
            <form action="" method="GET" class="row g-3 align-items-center">
                
                <div class="col-12 col-md-5">
                    <label class="form-label small fw-bold text-muted mb-1">Cari Mahasiswa</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Ketik nama mahasiswa..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Filter Kelas</label>
                    <select name="kelas_id" class="form-select">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 col-md-3 d-flex gap-2 align-items-end" style="margin-top: auto;">
                    <button type="submit" class="btn btn-primary flex-grow-1 fw-medium shadow-sm">
                        <i class="bi bi-funnel"></i> Terapkan
                    </button>
                    @if(request()->has('search') || request()->has('kelas_id'))
                        <a href="{{ url()->current() }}" class="btn btn-light border fw-medium" title="Reset Filter">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    @endif
                </div>
                
            </form>
        </div>
    </div>

    <div class="card card-panel bg-white border">
        <div class="card-body p-0 p-md-4">
            <div class="table-responsive rounded-4">
                <table class="table table-rekap align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 th-header fw-bold">Mahasiswa / Kelas</th>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center border-start">Nilai Kuis (Attempts)</th>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center border-start">Nilai Praktikum</th>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center border-start">Nilai Evaluasi</th>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center border-start">Rata-rata</th>
                            <th scope="col" class="px-4 py-3 th-header fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>
<tbody>
                        @forelse($mahasiswas as $mahasiswa)
                        
                        @php
                            // 1. Nilai Kuis (Ambil skor kuis dari relasi jawaban)
                            $kuis = $mahasiswa->jawaban->last(); 
                            $nilaiKuis = $kuis ? $kuis->skor : 0;

                            // 2. Rata-rata Nilai Praktikum
                            $kumpulanNilaiPraktikum = $mahasiswa->pengumpulanPraktikum->pluck('nilai')->filter(function ($val) {
                                return !is_null($val);
                            });
                            $avgPraktikum = $kumpulanNilaiPraktikum->count() > 0 ? $kumpulanNilaiPraktikum->avg() : 0;

                            // 3. Nilai Evaluasi (Asumsi jika belum ada tabelnya, diset 0 dulu)
                            // Jika ada relasinya, ganti menjadi misal: $mahasiswa->evaluasi->first()->skor ?? 0;
                            $nilaiEvaluasi = 0; 

                            // 4. Hitung Rata-Rata Akhir (Dibagi 3 komponen: Kuis, Praktikum, Evaluasi)
                            $rataRataAkhir = ($nilaiKuis + $avgPraktikum + $nilaiEvaluasi) / 3;
                            
                            // Format angka desimal agar rapi (misal: 85.5)
                            $rataRataFormat = number_format($rataRataAkhir, 1);
                        @endphp

                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px; font-size: 1.2rem;">
                                        {{ strtoupper(substr($mahasiswa->user->name ?? 'M', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark fs-6">{{ $mahasiswa->user->name ?? 'Nama Mahasiswa' }}</div>
                                        <div class="text-muted small">
                                            <i class="bi bi-person-badge"></i> {{ $mahasiswa->nim }} &bull; 
                                            <span class="text-primary fw-medium">{{ $mahasiswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                @if($mahasiswa->jawaban->count() > 0)
                                    @php
                                        // Ambil jawaban terakhir (terbaru) sebagai nilai utama yang tampil
                                        $kuisUtama = $mahasiswa->jawaban->last(); 
                                        
                                        // Siapkan data riwayat untuk dikirim ke Javascript
                                        $riwayatKuis = $mahasiswa->jawaban->map(function($j) {
                                            // Hitung durasi pengerjaan jika waktu mulai dan selesai tersedia
                                            $durasi = '-';
                                            if ($j->waktu_mulai && $j->waktu_selesai) {
                                                $mulai = \Carbon\Carbon::parse($j->waktu_mulai);
                                                $selesai = \Carbon\Carbon::parse($j->waktu_selesai);
                                                
                                                // Format durasi: "X m Y s" atau hanya "X s" jika kurang dari semenit
                                                $diffInSeconds = $mulai->diffInSeconds($selesai);
                                                $minutes = floor($diffInSeconds / 60);
                                                $seconds = $diffInSeconds % 60;
                                                
                                                if ($minutes > 0) {
                                                    $durasi = "{$minutes}m {$seconds}s";
                                                } else {
                                                    $durasi = "{$seconds}s";
                                                }
                                            }

                                            return [
                                                'attempt' => $j->attempt,
                                                'skor' => $j->skor,
                                                'tanggal' => \Carbon\Carbon::parse($j->created_at)->translatedFormat('d M Y, H:i'),
                                                'durasi' => $durasi // <--- Tambahkan variabel durasi ini
                                            ];
                                        })->values()->toJson();
                                    @endphp

                                    <span class="score-box text-{{ $kuisUtama->skor >= 70 ? 'success' : 'danger' }} me-1">
                                        {{ $kuisUtama->skor }}
                                    </span>
                                    
                                <button type="button" class="btn btn-sm btn-light border py-0 px-2 rounded-pill text-primary" 
                                        data-nama="{{ $mahasiswa->user->name ?? 'Mahasiswa' }}"
                                        data-riwayat="{{ $riwayatKuis }}"
                                        onclick="lihatDetailKuis(this)"
                                        title="Lihat Riwayat Percobaan Kuis">
                                    <i class="bi bi-clock-history"></i> {{ $mahasiswa->jawaban->count() }} Att
                                </button>
                                @else
                                    <span class="text-muted small">0</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                @if($kumpulanNilaiPraktikum->count() > 0)
                                    <span class="score-box text-{{ $avgPraktikum >= 70 ? 'success' : 'danger' }}">
                                        {{ number_format($avgPraktikum, 1) }}
                                    </span>
                                    <span class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                                        Dari {{ $kumpulanNilaiPraktikum->count() }} Tugas
                                    </span>
                                @else
                                    <span class="text-muted small">0</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                <span class="text-muted small">{{ $nilaiEvaluasi }}</span>
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                <div class="badge {{ $rataRataAkhir >= 70 ? 'bg-success bg-opacity-10 text-success border-success' : 'bg-danger bg-opacity-10 text-danger border-danger' }} border px-3 py-2 fs-6 border-opacity-25">
                                    {{ $rataRataFormat }}
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center border-start">
                                <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-medium">
                                    Detail <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-people fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                <h6 class="fw-bold text-muted">Belum ada mahasiswa di kelas Anda</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="quizDetailModal" tabindex="-1" aria-labelledby="quizDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="quizDetailModalLabel">
                    <i class="bi bi-journal-text text-primary me-2"></i> Riwayat Kuis
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted small mb-3">Menampilkan riwayat percobaan kuis untuk <strong id="namaMahasiswaKuis" class="text-dark">Nama</strong></p>
                
                <div class="table-responsive border rounded-3">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th class="text-secondary fw-semibold py-2">Percobaan</th>
                                <th class="text-secondary fw-semibold py-2">Waktu Submit</th>
                                <th class="text-secondary fw-semibold py-2">Lama Pengerjaan</th> 
                                <th class="text-secondary fw-semibold py-2">Skor</th>
                            </tr>
                        </thead>
                        <tbody id="quizHistoryBody">
                            </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk memunculkan Modal Riwayat Kuis
    function lihatDetailKuis(buttonElement) {
        // 1. Ambil data dari atribut tombol yang diklik
        const nama = buttonElement.getAttribute('data-nama');
        // Parse string JSON kembali menjadi Object Javascript
        const riwayat = JSON.parse(buttonElement.getAttribute('data-riwayat'));
        
        // 2. Ubah nama di dalam modal
        document.getElementById('namaMahasiswaKuis').innerText = nama;
        
        // 3. Kosongkan isi tabel sebelumnya
        const tbody = document.getElementById('quizHistoryBody');
        tbody.innerHTML = '';

// 4. Looping data riwayat
        riwayat.forEach(item => {
            // Tentukan warna badge skor (Hijau jika lulus >= 70, Merah jika gagal)
            let badgeColor = item.skor >= 70 ? 'success' : 'danger';
            
            // Masukkan baris data ke tabel html (Ditambahkan 1 kolom untuk durasi)
            tbody.innerHTML += `
                <tr>
                    <td class="fw-bold text-secondary">Att ${item.attempt}</td>
                    <td class="small text-muted">${item.tanggal}</td>
                    <td class="small text-secondary fw-medium">
                        <i class="bi bi-stopwatch me-1"></i> ${item.durasi}
                    </td>
                    <td>
                        <span class="badge bg-${badgeColor} bg-opacity-10 text-${badgeColor} border border-${badgeColor} border-opacity-25 px-2 py-1 fs-6">
                            ${item.skor}
                        </span>
                    </td>
                </tr>
            `;
        });

        // 5. Tampilkan Modal Bootstrap
        var kuisModal = new bootstrap.Modal(document.getElementById('quizDetailModal'));
        kuisModal.show();
    }
</script>
@endsection