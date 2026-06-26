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
        $aktivitas = Aktivitas::where('folder',$folder)
            ->where('slug','quiz')
            ->firstOrFail();

        $soal = ButirSoal::where('id_aktivitas',$aktivitas->id)
            ->orderBy('nomor')
            ->get();

        $mahasiswa = auth()->user()->mahasiswa;
        
        // --- LOGIKA UNTUK BLOKIR EVALUASI ---
        $can_take_quiz = true;
        $pesan_blokir = '';

        if ($aktivitas->tipe == 'evaluasi') {
            $riwayatAttempt = JawabanMahasiswa::where('id_mahasiswa', $mahasiswa->id)
                ->where('id_aktivitas', $aktivitas->id)
                ->get();
                
            $jumlahAttempt = $riwayatAttempt->count();
            $sudahLulus = $riwayatAttempt->where('status_lulus', 1)->count() > 0;
            
            // Aturan 1: Jika sudah pernah lulus, hentikan.
            if ($sudahLulus) {
                $can_take_quiz = false;
                $pesan_blokir = 'Anda sudah tuntas (mencapai KKM) pada Evaluasi ini di percobaan sebelumnya. Anda tidak diizinkan untuk mengulangnya kembali.';
            } 
            // Aturan 2: Jika sudah mencoba 3 kali namun gagal terus, hentikan.
            elseif ($jumlahAttempt >= 3) {
                $can_take_quiz = false;
                $pesan_blokir = 'Anda telah mencapai batas maksimal pengerjaan Evaluasi (Maksimal 3 kali percobaan).';
            }
        }
        // -----------------------------------------

        return view("mahasiswa.$folder.quiz",[
            'soal' => $soal,
            'quiz' => $aktivitas,
            'can_take_quiz' => $can_take_quiz, // Lempar status ke tampilan
            'pesan_blokir' => $pesan_blokir
        ]);
    }

    public function start($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $mahasiswa = auth()->user()->mahasiswa;

        // --- TAMENG KEDUA ---
        if ($aktivitas->tipe == 'evaluasi') {
            $riwayatAttempt = JawabanMahasiswa::where('id_mahasiswa', $mahasiswa->id)
                ->where('id_aktivitas', $aktivitas->id)
                ->get();
                
            $jumlahAttempt = $riwayatAttempt->count();
            $sudahLulus = $riwayatAttempt->where('status_lulus', 1)->count() > 0;
            
            if ($sudahLulus || $jumlahAttempt >= 3) {
                return response()->json(['status' => 'error', 'message' => 'Akses ditolak: Anda sudah tuntas atau mencapai batas percobaan (3x).']);
            }
        }
        // --------------------

        session([
            'quiz_start_'.$id => now()
        ]);

        return response()->json(['status' => 'started']);
    }

    public function submit(Request $request, $id_aktivitas)
    {
        $aktivitas = Aktivitas::with('butirSoal')->findOrFail($id_aktivitas);
        $jawabanUser = $request->json('jawaban') ?? [];

        $mahasiswa = auth()->user()->mahasiswa;

        // ================= HITUNG ATTEMPT =================
        $last = JawabanMahasiswa::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_aktivitas', $id_aktivitas)
            ->orderByDesc('attempt')
            ->first();

        $attemptBaru = $last ? $last->attempt + 1 : 1;

        // ================= HITUNG NILAI =================
        $totalSoal = $aktivitas->butirSoal->count();
        $bobotPerSoal = $totalSoal > 0 ? 100 / $totalSoal : 0;

        $skor = 0;
        $jumlahBenar = 0;

        // ARRAY: Untuk menyimpan jawaban user sekaligus status benar/salahnya
        $detailJawabanLengkap = [];

        foreach ($aktivitas->butirSoal as $soal) {
            $key = 'q'.$soal->nomor;

            $jawabanMhs = $jawabanUser[$key] ?? '';
            $correctRaw = $soal->jawaban_benar;
            
            $isCorrect = false; // Asumsi awal salah

            // Cek apakah jawaban merupakan JSON (dragdrop/array)
            $decoded = json_decode($correctRaw, true);

            if (is_array($decoded) && isset($decoded['correct'])) {
                $correctArr = $decoded['correct']; // array kunci jawaban
                $userArr = json_decode($jawabanMhs, true);

                if ($userArr === $correctArr) {
                    $skor += $bobotPerSoal;
                    $isCorrect = true;
                }
            } else {
                // Evaluasi pilihan ganda biasa
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

            // SIMPAN DATA LENGKAP KE ARRAY BARU
            $detailJawabanLengkap[$key] = [
                'jawaban'    => $jawabanMhs,
                'is_correct' => $isCorrect
            ];
        }

        $skor = round($skor);

        // 1. Ambil Tahun Ajaran dari Kelas yang diikuti mahasiswa saat ini
        $tahunKelas = $mahasiswa->kelas->tahun_ajaran; 

        // 2. Cari tahu siapa Dosen dari Mahasiswa yang sedang mengerjakan kuis
        $id_dosen = $mahasiswa->kelas->id_dosen;

        // 3. Cari KKM dari tabel setting berdasarkan Dosen, Kuis ini, dan TAHUN KELAS
        $settingKkm = Setting::where('id_dosen', $id_dosen) 
                        ->where('id_aktivitas', $id_aktivitas)
                        ->where('tahun', $tahunKelas) 
                        ->first();

        // 4. Jika dosen belum pernah mengatur KKM untuk tahun tersebut, gunakan default 75
        $kkmDosen = $settingKkm ? $settingKkm->kkm : 75;

        // ==========================================================
        // Jika ini adalah percobaan ke-2, ke-3, dst.
        if ($attemptBaru > 1) {
            // Jika nilai murni mahasiswa melebihi KKM, maka dibatasi menjadi KKM
            if ($skor > $kkmDosen) {
                $skor = $kkmDosen;
            }
        }
        // ==========================================================

        // 5. Tentukan status lulus berdasarkan KKM Dosen
        $statusLulus = $skor >= $kkmDosen ? 1 : 0;

        // ================= SIMPAN KE JAWABAN MAHASISWA =================
        $start = session('quiz_start_'.$id_aktivitas);

        JawabanMahasiswa::create([
            'id_mahasiswa' => $mahasiswa->id,
            'id_aktivitas' => $id_aktivitas,
            'attempt' => $attemptBaru,
            'skor' => $skor,
            'status_lulus' => $statusLulus,
            'detail_jawaban' => json_encode($detailJawabanLengkap),
            'waktu_mulai' => $start,
            'waktu_selesai' => now()
        ]);

        // ==========================================================
        // CATAT PROGRES JIKA LULUS KKM
        // ==========================================================
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
        // ==========================================================

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

        //ambil attempt terakhir
        $attemptTerakhir = JawabanMahasiswa::where('id_mahasiswa',$mahasiswaId)
            ->where('id_aktivitas',$id_aktivitas)
            ->latest()
            ->first();

        // //Attemp tertinggi
        // $attemptTerakhir = JawabanMahasiswa::where('id_mahasiswa',$mahasiswaId)
        //     ->where('id_aktivitas',$id_aktivitas)
        //     ->latest()
        //     ->first();

        return view('quiz.hasil',compact('attemptTerakhir'));
    }

}
