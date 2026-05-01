<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\ButirSoal;
use App\Models\ProgresMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{

    public function show($folder, $slug)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $aktivitas = Aktivitas::orderByRaw("
            FIELD(folder,'pendahuluan','bubble','selection','insertion','merge', 'evaluasi')
        ")
        ->orderBy('urutan')
        ->get()
        ->groupBy('folder');

        $item = Aktivitas::where('folder',$folder)
            ->where('slug',$slug)
            ->firstOrFail();

        // 1. Ambil daftar ID aktivitas yang sudah diselesaikan mahasiswa ini
        $progresSelesai = ProgresMahasiswa::where('id_mahasiswa', $mahasiswa->id)
            ->where('status', 'selesai')
            ->pluck('id_aktivitas')
            ->toArray(); // mengirimkan data progres menggunakan variabel $progresSelesai, yang bentuknya adalah Array berisi kumpulan ID aktivitas (pluck('id_aktivitas')->toArray()).

        $isSelesai = in_array($item->id, $progresSelesai);
            
        return view("mahasiswa.$folder.$slug", compact(
            'item',
            'aktivitas',
            'progresSelesai', // 2. Kirim data ini ke tampilan (View)
            'isSelesai'
        ));
    }

    // Fungsi untuk mencatat bahwa mahasiswa telah menyelesaikan aktivitas
    public function tandaiSelesai(Request $request)
    {
        $request->validate([
            'id_aktivitas' => 'required|exists:aktivitas,id',
            'next_route' => 'nullable' // Nullable karena AJAX tidak butuh URL redirect
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        // Simpan atau perbarui progres menjadi 'selesai'
        ProgresMahasiswa::updateOrCreate(
            [
                'id_mahasiswa' => $mahasiswa->id,
                'id_aktivitas' => $request->id_aktivitas,
            ],
            [
                'status' => 'selesai' // Sesuai dengan kolom enum di database 
            ]
        );

        // Jika request datang dari JavaScript (AJAX) seperti di halaman Simulasi
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true, 
                // 'message' => 'Progres berhasil disimpan!'
            ]);
        }

        // Jika request datang dari tombol biasa (Form HTML) seperti di halaman Materi
        return redirect($request->next_route)->with('success', 'Materi selesai, lanjut ke tahap berikutnya!');
    }

    public function showById($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);

        if ($aktivitas->tipe == 'quiz') {

            $soal = ButirSoal::where('id_aktivitas', $id)
                        ->orderBy('nomor')
                        ->get();

        } elseif ($aktivitas->tipe == 'evaluasi') {

            $soal = ButirSoal::where('id_aktivitas', $id)
                        ->inRandomOrder()
                        ->get();

        } else {
            $soal = collect(); // kosong kalau bukan soal
        }

        return view("mahasiswa.$aktivitas->folder.$aktivitas->slug",
            compact('aktivitas','soal')
        );
    }

    public function updateDurasi(Request $request, $id)
    {
        $request->validate([
            'durasi' => 'required|integer|min:1'
        ]);

        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->update([
            'durasi' => $request->durasi
        ]);

        return back()->with('success', 'Durasi kuis ' . $aktivitas->judul . ' berhasil diatur menjadi ' . $request->durasi . ' menit!');
    }

    public function latihanSorting()
    {
        $soal = ButirSoal::orderBy('nomor')->get();
        $aktivitas = Aktivitas::where('slug','latihan_sorting')->first();

        return view('mahasiswa.pendahuluan', compact('soal','aktivitas'));
    }
}