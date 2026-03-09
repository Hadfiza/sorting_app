<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // sementara dummy dulu
        $kelas = $user->kelas ?? 'Belum Ada Kelas';
        $nilai = 0; 
        $progress = 0;

        return view('siswa.dashboard', compact('kelas','nilai','progress'));
    }
}