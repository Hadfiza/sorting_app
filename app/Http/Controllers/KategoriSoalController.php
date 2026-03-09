<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\ButirSoal;
use App\Models\JawabanMahasiswa;
// use App\Models\KategoriSoal;
// use App\Models\Materi;
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

    public function submit(Request $request, $id_aktivitas)
    {
        $aktivitas = Aktivitas::with('butirSoal')->findOrFail($id_aktivitas);

        $jawabanUser = $request->json('jawaban') ?? [];

        $waktuMulai = \Carbon\Carbon::parse(
            $request->json('waktu_mulai')
        )->format('Y-m-d H:i:s');

        $totalSoal = $aktivitas->butirSoal->count();
        $bobotPerSoal = $totalSoal > 0 ? 100 / $totalSoal : 0;

        $skor = 0;

        foreach ($aktivitas->butirSoal as $soal) {

            $key = 'q'.$soal->nomor;

            $user = strtolower(trim($jawabanUser[$key] ?? ''));
            $correct = strtolower(trim($soal->jawaban_benar));

            if ($user === $correct) {
                $skor += $bobotPerSoal;
            }
        }

        $skor = round($skor);

        $mahasiswa = auth()->user()->mahasiswa;

        $attempt = JawabanMahasiswa::where('id_mahasiswa',$mahasiswa->id)
            ->where('id_aktivitas',$aktivitas->id)
            ->count() + 1;

        $statusLulus = $skor >= 60 ? 1 : 0;

        JawabanMahasiswa::create([
            'id_mahasiswa' => $mahasiswa->id,
            'id_aktivitas' => $aktivitas->id,
            'skor' => $skor,
            'attempt' => $attempt,
            'status_lulus' => $statusLulus,
            'detail_jawaban' => json_encode($jawabanUser),
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => now()
        ]);

        return response()->json([
            'skor' => $skor
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
