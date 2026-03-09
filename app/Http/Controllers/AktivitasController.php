<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\ButirSoal;
// use App\Models\ProgresMahasiswa;
// use Illuminate\Http\Request;

class AktivitasController extends Controller
{

    public function show($folder, $slug)
    {

        $aktivitas = Aktivitas::orderByRaw("
            FIELD(folder,'pendahuluan','bubble','selection','insertion','merge')
        ")
        ->orderBy('urutan')
        ->get()
        ->groupBy('folder');

        $item = Aktivitas::where('folder',$folder)
            ->where('slug',$slug)
            ->firstOrFail();

        return view("mahasiswa.$folder.$slug", compact(
            'item',
            'aktivitas'
        ));
    }

// public function show($folder, $slug)
    // {
    //     $aktivitas = Aktivitas::where('folder', $folder)
    //                         ->where('slug', $slug)
    //                         ->firstOrFail();

    //     // 🔒 Cek aktivitas sebelumnya (LOCK SYSTEM)
    //     $previous = Aktivitas::where('folder', $folder)
    //                         ->where('urutan', $aktivitas->urutan - 1)
    //                         ->first();

    //     if ($previous) {
    //         $completed = ProgresMahasiswa::where('id_mahasiswa', auth()->id())
    //             ->where('id_aktivitas', $previous->id)
    //             ->where('status', 'selesai')
    //             ->exists();

    //         if (!$completed) {
    //             abort(403, 'Selesaikan aktivitas sebelumnya dulu.');
    //         }
    //     }

    //     // 🔥 TAMBAHAN: Kalau quiz, ambil soal
    //     if ($aktivitas->tipe == 'quiz') {

    //         $soal = ButirSoal::where('id_aktivitas', $aktivitas->id)
    //                     ->orderBy('nomor')
    //                     ->get();

    //         return view("mahasiswa.$folder.$slug", compact('aktivitas','soal'));
    //     }

    //     // Kalau bukan quiz
    //     return view("mahasiswa.$folder.$slug", compact('aktivitas'));
    // }

    // public function selesai(Request $request)
    // {
    //     ProgresMahasiswa::updateOrCreate(
    //         [
    //             'id_mahasiswa' => auth()->id(),
    //             'id_aktivitas' => $request->id_aktivitas,
    //         ],
    //         [
    //             'status' => 'selesai'
    //         ]
    //     );

    //     return back()->with('success', 'Aktivitas selesai!');
    // }


    public function showById($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);

        if ($aktivitas->tipe == 'quiz') {

            $soal = ButirSoal::where('id_aktivitas', $id)
                        ->orderBy('nomor')
                        ->get();

            return view("mahasiswa.$aktivitas->folder.$aktivitas->slug",
                compact('aktivitas','soal')
            );
        }

        return view("mahasiswa.$aktivitas->folder.$aktivitas->slug",
            compact('aktivitas')
        );
    }

    public function latihanSorting()
    {
        $soal = ButirSoal::orderBy('nomor')->get();
        $aktivitas = Aktivitas::where('slug','latihan_sorting')->first();

        return view('mahasiswa.pendahuluan', compact('soal','aktivitas'));
    }
}