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

        return view("mahasiswa.$folder.quiz",[
            'soal' => $soal,
            'quiz' => $aktivitas
        ]);
    }

public function start($id)
{
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

        foreach ($aktivitas->butirSoal as $soal) {
            $key = 'q'.$soal->nomor;

            $user = strtolower(trim($jawabanUser[$key] ?? ''));
            $correctRaw = $soal->jawaban_benar;

            // cek apakah JSON (dragdrop)
            $decoded = json_decode($correctRaw, true);

            if (is_array($decoded) && isset($decoded['correct'])) {

                $correct = $decoded['correct']; // array

                $userArr = json_decode($jawabanUser[$key] ?? '[]', true);

                if ($userArr === $correct) {
                    $skor += $bobotPerSoal;
                }

            } else {

                $user = strtolower(trim($jawabanUser[$key] ?? ''));
                $correct = strtolower(trim($correctRaw));

                if ($user === $correct) {
                    $skor += $bobotPerSoal;
                }
            }
        }

        $skor = round($skor);
        // $statusLulus = $skor >= 60 ? 1 : 0;

        // 1. Cari tahu siapa Dosen dari Mahasiswa yang sedang mengerjakan kuis
        // (Asumsi relasi: Mahasiswa -> belongsTo Kelas -> belongsTo Dosen)
        $id_dosen = $mahasiswa->kelas->id_dosen;

        // 2. Ambil KKM dari tabel setting berdasarkan Dosen dan Kuis ini
        $settingKkm = Setting::where('id_dosen', $id_dosen) 
                        ->where('id_aktivitas', $id_aktivitas)
                        ->first();

        // 3. Jika dosen belum pernah mengatur KKM, gunakan default 75
        $kkmDosen = $settingKkm ? $settingKkm->kkm : 75;

        // 4. Tentukan status lulus berdasarkan KKM Dosen
        $statusLulus = $skor >= $kkmDosen ? 1 : 0;

        // ================= SIMPAN =================
        $start = session('quiz_start_'.$id_aktivitas);

        JawabanMahasiswa::create([
            'id_mahasiswa' => $mahasiswa->id,
            'id_aktivitas' => $id_aktivitas,
            'attempt' => $attemptBaru,
            'skor' => $skor,
            'status_lulus' => $statusLulus,
            'detail_jawaban' => json_encode($jawabanUser),
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
            'lulus' => $statusLulus == 1, // Opsional: Kirim balik status lulus ke AJAX view
            'kkm' => $kkmDosen // Opsional: Beritahu mahasiswa KKM-nya berapa
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
