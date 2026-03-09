<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::orderBy('urutan')->get();
        return view('materi.index', compact('materi'));
    }

    /**
     * Menampilkan detail materi tanpa slug
     * Menggunakan ID sebagai pengganti slug
     */
    public function show($id)
    {
        // Cari data berdasarkan ID
        $materi = Materi::findOrFail($id);

        // Mengembalikan view berdasarkan nama folder yang tersimpan di DB
        // Contoh: resources/views/mahasiswa/nama_folder/index.blade.php
        return view('mahasiswa.' . $materi->folder . '.index', compact('materi'));
    }
}