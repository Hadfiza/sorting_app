<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\ButirSoal;
use Illuminate\Http\Request;

class ButirSoalController extends Controller
{
// Menampilkan halaman manajemen soal
    public function index(Request $request)
    {
        // PERBAIKAN: Hanya ambil aktivitas yang tipenya 'kuis' atau 'evaluasi'
        $aktivitasList = Aktivitas::whereIn('tipe', ['quiz', 'evaluasi'])->orderBy('urutan')->get();

        // Query dasar mengambil butir soal beserta relasi aktivitasnya
        $query = ButirSoal::with('aktivitas');

        // Jika dosen memfilter berdasarkan kuis/evaluasi tertentu
        if ($request->filled('id_aktivitas')) {
            $query->where('id_aktivitas', $request->id_aktivitas);
        }

        // Urutkan berdasarkan aktivitas lalu nomor soal
        $soals = $query->orderBy('id_aktivitas')->orderBy('nomor')->get();

        return view('dosen.soal.index', compact('aktivitasList', 'soals'));
    }

    // Menyimpan soal baru
    public function store(Request $request)
    {
        $request->validate([
            'id_aktivitas'  => 'required|exists:aktivitas,id',
            'tipe'          => 'required|in:pilgan,essay,truefalse,dragdrop',
            'nomor'         => 'required|integer',
            'pertanyaan'    => 'required',
            'jawaban_benar' => 'required'
        ]);

        ButirSoal::create($request->all());

        return back()->with('success', 'Soal berhasil ditambahkan!');
    }

    // Mengupdate soal yang sudah ada
    public function update(Request $request, $id)
    {
        $soal = ButirSoal::findOrFail($id);

        $request->validate([
            'id_aktivitas'  => 'required|exists:aktivitas,id',
            'tipe'          => 'required|in:pilgan,essay,truefalse,dragdrop',
            'nomor'         => 'required|integer',
            'pertanyaan'    => 'required',
            'jawaban_benar' => 'required'
        ]);

        $soal->update($request->all());

        return back()->with('success', 'Soal berhasil diperbarui!');
    }

    // Menghapus soal
    public function destroy($id)
    {
        $soal = ButirSoal::findOrFail($id);
        $soal->delete();

        return back()->with('success', 'Soal berhasil dihapus!');
    }
}