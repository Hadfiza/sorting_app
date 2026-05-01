<?php

namespace App\Models;

use App\Models\JawabanMahasiswa;
use App\Models\Kelas;
use App\Models\PengumpulanPraktikum;
use App\Models\ProgresMahasiswa;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'id_user',
        'id_kelas',
        'nim',
        'angkatan',
        'foto',
    ];

    protected $appends = ['nilai_akhir'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanMahasiswa::class, 'id_mahasiswa');
    }

    public function pengumpulanPraktikum()
    {
        return $this->hasMany(PengumpulanPraktikum::class, 'id_mahasiswa');
    }

    public function progres()
    {
        return $this->hasMany(ProgresMahasiswa::class, 'id_mahasiswa');
    }

    /**
     * Mengambil Total Nilai Akhir (Kuis + Praktikum + Evaluasi)
     */
    public function getNilaiAkhirAttribute()
    {
        // 1. RATA-RATA KUIS (Hanya aktivitas dengan tipe 'quiz')
        $rataKuis = JawabanMahasiswa::where('id_mahasiswa', $this->id)
            ->whereHas('aktivitas', function ($query) {
                $query->where('tipe', 'quiz');
            })
            ->selectRaw('MAX(skor) as skor_maksimal')
            ->groupBy('id_aktivitas')
            ->get()
            ->avg('skor_maksimal') ?? 0;

        // 2. NILAI EVALUASI (Hanya aktivitas dengan tipe 'evaluasi')
        // Karena Evaluasi biasanya hanya 1 aktivitas, kita cukup ambil skor tertingginya langsung
        $nilaiEvaluasi = JawabanMahasiswa::where('id_mahasiswa', $this->id)
            ->whereHas('aktivitas', function ($query) {
                $query->where('tipe', 'evaluasi');
            })
            ->max('skor') ?? 0;

        // 3. RATA-RATA PRAKTIKUM
        $rataPraktikum = PengumpulanPraktikum::where('id_mahasiswa', $this->id)
            ->whereNotNull('nilai')
            ->avg('nilai') ?? 0;

        // 4. RUMUS NILAI AKHIR
        // Contoh Opsi 1: Rata-rata dari ketiganya (dibagi 3)
        $totalNilai = ($rataKuis + $rataPraktikum + $nilaiEvaluasi) / 3;

        // Contoh Opsi 2: Menggunakan persentase bobot 
        // Misal: Kuis 30%, Praktikum 30%, Evaluasi 40% (0.3 + 0.3 + 0.4 = 1.0)
        // $totalNilai = ($rataKuis * 0.3) + ($rataPraktikum * 0.3) + ($nilaiEvaluasi * 0.4);

        // Kembalikan nilai yang sudah dibulatkan
        return round($totalNilai);
    }
}
