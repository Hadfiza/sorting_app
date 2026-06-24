<table>
    <thead>
        <tr>
            <th style="font-weight: bold; text-align: center;">Nama Siswa</th>
            <th style="font-weight: bold; text-align: center;">NIM</th>
            <th style="font-weight: bold; text-align: center;">Kelas</th>
            <th style="font-weight: bold; text-align: center;">K1 (Pendahuluan)</th>
            <th style="font-weight: bold; text-align: center;">K2 (Bubble)</th>
            <th style="font-weight: bold; text-align: center;">K3 (Selection)</th>
            <th style="font-weight: bold; text-align: center;">K4 (Insertion)</th>
            <th style="font-weight: bold; text-align: center;">K5 (Merge)</th>
            <th style="font-weight: bold; text-align: center;">P1 (Bubble)</th>
            <th style="font-weight: bold; text-align: center;">P2 (Selection)</th>
            <th style="font-weight: bold; text-align: center;">P3 (Insertion)</th>
            <th style="font-weight: bold; text-align: center;">P4 (Merge)</th>
            <th style="font-weight: bold; text-align: center;">Evaluasi</th>
            <th style="font-weight: bold; text-align: center;">Rata-rata Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswas as $mahasiswa)
            @php
                // --- SEMUA PERHITUNGAN HARUS ADA DI SINI (DI DALAM FOREACH) ---
                
                // ID DATABASE ANDA
                $id_k_pendahuluan = 3; $id_k_bubble = 7; $id_k_selection = 12; $id_k_insertion = 17; $id_k_merge = 22;
                $id_p_bubble = 1; $id_p_selection = 2; $id_p_insertion = 3; $id_p_merge = 4;
                $id_k_evaluasi = 24; 

                $jawaban = $mahasiswa->jawaban;

                // =========================================================
                // PENYESUAIAN: AMBIL TAHUN KELAS MAHASISWA & KKM SESUAI TAHUN
                // =========================================================
                $thn_mhs = $mahasiswa->kelas->tahun_ajaran ?? date('Y');
                // Mengambil nilai $kkmSettings yang telah dilempar dari controller RekapNilaiExport
                $kkmKelasIni = $kkmSettingsByYear[$thn_mhs] ?? [];

                // AMBIL NILAI KKM KHUSUS TAHUN TERSEBUT
                $kkmKuis1 = $kkmKelasIni[3] ?? 75; 
                $kkmKuis2 = $kkmKelasIni[7] ?? 75; 
                $kkmKuis3 = $kkmKelasIni[12] ?? 75; 
                $kkmKuis4 = $kkmKelasIni[17] ?? 75; 
                $kkmKuis5 = $kkmKelasIni[22] ?? 75; 

                $list_modul = [
                    ['id' => $id_k_pendahuluan, 'nama' => 'Q1', 'kkm' => $kkmKuis1],
                    ['id' => $id_k_bubble, 'nama' => 'Q2', 'kkm' => $kkmKuis2],
                    ['id' => $id_k_selection, 'nama' => 'Q3', 'kkm' => $kkmKuis3],
                    ['id' => $id_k_insertion, 'nama' => 'Q4', 'kkm' => $kkmKuis4],
                    ['id' => $id_k_merge, 'nama' => 'Q5', 'kkm' => $kkmKuis5],
                ];

                $detail_kuis_array = [];

                foreach ($list_modul as $modul) {
                    $history = $jawaban->where('id_aktivitas', $modul['id'])->sortBy('created_at')->values();
                    $total_attempt = $history->count();
                    $skor_terakhir = $total_attempt > 0 ? $history->last()->skor : 0;
                    
                    $detail_kuis_array[] = [
                        'skor_terakhir' => $skor_terakhir,
                    ];
                }

                $praktikum = $mahasiswa->pengumpulanPraktikum;
                $p1 = $praktikum->where('id_praktikum', $id_p_bubble)->sortByDesc('created_at')->first()->nilai ?? 0;
                $p2 = $praktikum->where('id_praktikum', $id_p_selection)->sortByDesc('created_at')->first()->nilai ?? 0;
                $p3 = $praktikum->where('id_praktikum', $id_p_insertion)->sortByDesc('created_at')->first()->nilai ?? 0;
                $p4 = $praktikum->where('id_praktikum', $id_p_merge)->sortByDesc('created_at')->first()->nilai ?? 0;

                $evaluasi = $jawaban->where('id_aktivitas', $id_k_evaluasi)->sortByDesc('created_at')->first()->skor ?? 0; 
                
                // MENGAMBIL NILAI DARI MODEL
                $rataAkhir = $mahasiswa->nilai_akhir;
            @endphp
            
            <tr>
                <td>{{ $mahasiswa->user->nama ?? $mahasiswa->user->name }}</td>
                <td>{{ $mahasiswa->nim }}</td>
                <td>{{ $mahasiswa->kelas->nama_kelas ?? '-' }}</td>
                
                <td style="text-align: center;">{{ $detail_kuis_array[0]['skor_terakhir'] ?? 0 }}</td>
                <td style="text-align: center;">{{ $detail_kuis_array[1]['skor_terakhir'] ?? 0 }}</td>
                <td style="text-align: center;">{{ $detail_kuis_array[2]['skor_terakhir'] ?? 0 }}</td>
                <td style="text-align: center;">{{ $detail_kuis_array[3]['skor_terakhir'] ?? 0 }}</td>
                <td style="text-align: center;">{{ $detail_kuis_array[4]['skor_terakhir'] ?? 0 }}</td>
                
                <td style="text-align: center;">{{ $p1 }}</td>
                <td style="text-align: center;">{{ $p2 }}</td>
                <td style="text-align: center;">{{ $p3 }}</td>
                <td style="text-align: center;">{{ $p4 }}</td>
                
                <td style="text-align: center;">{{ $evaluasi }}</td>
                <td style="text-align: center; font-weight: bold;">{{ $rataAkhir }}</td>
            </tr>
        @endforeach
    </tbody>
</table>