<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\ButirSoal;
use App\Models\JawabanMahasiswa;
use App\Models\ProgresMahasiswa;
use App\Models\Setting;
use Illuminate\Http\Request;

class KategoriSoalController extends Controller
{
    public function quiz($folder)
    {
        $aktivitas = Aktivitas::where('folder', $folder)
            ->where('slug', 'quiz')
            ->firstOrFail();

        $soal = ButirSoal::where('id_aktivitas', $aktivitas->id)
            ->orderBy('nomor')
            ->get();

        $mahasiswa = auth()->user()->mahasiswa;

        $can_take_quiz = true;
        $pesan_blokir = '';

        if ($aktivitas->tipe == 'evaluasi') {
            $riwayatAttempt = JawabanMahasiswa::where('id_mahasiswa', $mahasiswa->id)
                ->where('id_aktivitas', $aktivitas->id)
                ->get();

            $jumlahAttempt = $riwayatAttempt->count();
            $sudahLulus = $riwayatAttempt->where('status_lulus', 1)->count() > 0;

            if ($sudahLulus) {
                $can_take_quiz = false;
                $pesan_blokir = 'Anda sudah tuntas (mencapai KKM) pada Evaluasi ini di percobaan sebelumnya. Anda tidak diizinkan untuk mengulangnya kembali.';
            } elseif ($jumlahAttempt >= 3) {
                $can_take_quiz = false;
                $pesan_blokir = 'Anda telah mencapai batas maksimal pengerjaan Evaluasi (Maksimal 3 kali percobaan).';
            }
        }

        return view("mahasiswa.$folder.quiz", [
            'soal' => $soal,
            'quiz' => $aktivitas,
            'can_take_quiz' => $can_take_quiz,
            'pesan_blokir' => $pesan_blokir
        ]);
    }

    public function start($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $mahasiswa = auth()->user()->mahasiswa;

        if ($aktivitas->tipe == 'evaluasi') {
            $riwayatAttempt = JawabanMahasiswa::where('id_mahasiswa', $mahasiswa->id)
                ->where('id_aktivitas', $aktivitas->id)
                ->get();

            $jumlahAttempt = $riwayatAttempt->count();
            $sudahLulus = $riwayatAttempt->where('status_lulus', 1)->count() > 0;

            if ($sudahLulus || $jumlahAttempt >= 3) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akses ditolak: Anda sudah tuntas atau mencapai batas percobaan (3x).'
                ]);
            }
        }

        session([
            'quiz_start_' . $id => now()
        ]);

        return response()->json(['status' => 'started']);
    }

    public function submit(Request $request, $id_aktivitas)
    {
        $aktivitas = Aktivitas::with('butirSoal')->findOrFail($id_aktivitas);

        $jawabanUser = $request->json('jawaban') ?? [];
        if (!is_array($jawabanUser)) {
            $jawabanUser = [];
        }

        $mahasiswa = auth()->user()->mahasiswa;

        $last = JawabanMahasiswa::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_aktivitas', $id_aktivitas)
            ->orderByDesc('attempt')
            ->first();

        $attemptBaru = $last ? $last->attempt + 1 : 1;

        $totalSoal = $aktivitas->butirSoal->count();
        $bobotPerSoal = $totalSoal > 0 ? 100 / $totalSoal : 0;

        $skor = 0;
        $jumlahBenar = 0;
        $detailJawabanLengkap = [];

        foreach ($aktivitas->butirSoal as $soal) {
            /**
             * Penting:
             * Key harus memakai nomor soal asli.
             * Jadi di Blade quiz/evaluasi input-nya harus q{{ $soal->nomor }},
             * bukan q{{ $loop->iteration }}.
             */
            $key = 'q' . $soal->nomor;

            $jawabanMhs = $jawabanUser[$key] ?? '';
            $correctRaw = $soal->jawaban_benar;

            $isCorrect = false;

            $decoded = json_decode($correctRaw, true);

            if (is_array($decoded) && isset($decoded['correct'])) {
                $correctArr = $decoded['correct'];

                if (is_array($jawabanMhs)) {
                    $userArr = $jawabanMhs;
                } else {
                    $userArr = json_decode($jawabanMhs, true);
                }

                if ($userArr === $correctArr) {
                    $skor += $bobotPerSoal;
                    $isCorrect = true;
                }
            } else {
                $userStr = strtolower(preg_replace('/\s+/', '', trim((string) $jawabanMhs)));
                $correctStr = strtolower(preg_replace('/\s+/', '', trim((string) $correctRaw)));

                if ($userStr === $correctStr) {
                    $skor += $bobotPerSoal;
                    $isCorrect = true;
                }
            }

            if ($isCorrect) {
                $jumlahBenar++;
            }

            /**
             * SIMPAN SNAPSHOT SOAL.
             * Ini membuat riwayat tetap aman walaupun soal diedit setelah mahasiswa mengerjakan.
             */
            $detailJawabanLengkap[$key] = [
                'id_soal' => $soal->id,
                'nomor_soal' => $soal->nomor,

                'pertanyaan' => $soal->pertanyaan ?? $soal->soal ?? '-',
                'opsi_a' => $soal->opsi_a ?? $soal->pilihan_a ?? null,
                'opsi_b' => $soal->opsi_b ?? $soal->pilihan_b ?? null,
                'opsi_c' => $soal->opsi_c ?? $soal->pilihan_c ?? null,
                'opsi_d' => $soal->opsi_d ?? $soal->pilihan_d ?? null,
                'opsi_e' => $soal->opsi_e ?? $soal->pilihan_e ?? null,

                'jawaban' => $jawabanMhs,
                'jawaban_benar' => $soal->jawaban_benar,
                'is_correct' => $isCorrect,
            ];
        }

        $skor = round($skor);

        $tahunKelas = $mahasiswa->kelas->tahun_ajaran ?? date('Y');
        $id_dosen = $mahasiswa->kelas->id_dosen ?? null;

        $settingKkm = Setting::where('id_dosen', $id_dosen)
            ->where('id_aktivitas', $id_aktivitas)
            ->where('tahun', $tahunKelas)
            ->first();

        $kkmDosen = $settingKkm ? $settingKkm->kkm : 75;

        if ($attemptBaru > 1) {
            if ($skor > $kkmDosen) {
                $skor = $kkmDosen;
            }
        }

        $statusLulus = $skor >= $kkmDosen ? 1 : 0;

        $start = session('quiz_start_' . $id_aktivitas);

        JawabanMahasiswa::create([
            'id_mahasiswa' => $mahasiswa->id,
            'id_aktivitas' => $id_aktivitas,
            'attempt' => $attemptBaru,
            'skor' => $skor,
            'status_lulus' => $statusLulus,
            'detail_jawaban' => json_encode($detailJawabanLengkap, JSON_UNESCAPED_UNICODE),
            'waktu_mulai' => $start,
            'waktu_selesai' => now()
        ]);

        if ($statusLulus == 1) {
            ProgresMahasiswa::updateOrCreate(
                [
                    'id_mahasiswa' => $mahasiswa->id,
                    'id_aktivitas' => $id_aktivitas
                ],
                [
                    'status' => 'selesai'
                ]
            );
        }

        return response()->json([
            'skor' => $skor,
            'benar' => $jumlahBenar,
            'total_soal' => $totalSoal,
            'lulus' => $statusLulus == 1,
            'kkm' => $kkmDosen
        ]);
    }

    public function lihatHasil($id_aktivitas)
    {
        $mahasiswaId = auth()->user()->mahasiswa->id;

        $attemptTerakhir = JawabanMahasiswa::where('id_mahasiswa', $mahasiswaId)
            ->where('id_aktivitas', $id_aktivitas)
            ->latest()
            ->first();

        return view('quiz.hasil', compact('attemptTerakhir'));
    }
}