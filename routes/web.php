<?php

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ButirSoalController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\DosenDashboardController;
use App\Http\Controllers\KategoriSoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PraktikumController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/* =====================================================
   GUEST ONLY (BELUM LOGIN)
===================================================== */
Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return view('landing');
    })->name('home');

    Route::get('/kodeku', function () {
        return view('kodeku');
    })->name('kodeku');

    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    // Route Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    // === Route Register Dosen ===
    Route::get('/register-dosen', [AuthController::class, 'showRegisterDosen'])->name('register.dosen');
    Route::post('/register-dosen', [AuthController::class, 'registerDosen'])->name('register.dosen.process');

});


/* =====================================================
   LOGOUT (HARUS LOGIN)
===================================================== */
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/* =====================================================
   MAHASISWA
===================================================== */
Route::prefix('mahasiswa')
    ->name('mahasiswa.')
    ->middleware(['auth','role:mahasiswa'])
    ->group(function () {

    /* ===== DASHBOARD ===== */
    Route::get('/dashboard',
        [MahasiswaDashboardController::class, 'index']
    )->name('dashboard');

    Route::post('/praktikum/submit',
        [PraktikumController::class,'submit']
    )->name('praktikum.submit');

    Route::get('/{folder}/quiz',
        [KategoriSoalController::class,'quiz']
    )->name('quiz.show');

    Route::post('/quiz/{id}/start', [KategoriSoalController::class, 'start'])
    ->name('quiz.start');

    Route::post('/quiz/submit/{id_aktivitas}',
        [KategoriSoalController::class,'submit']
    )->name('quiz.submit');

    Route::get('/{folder}/{slug}',
        [AktivitasController::class,'show'])
    ->name('aktivitas.show');


    Route::post('/aktivitas/tandai-selesai', 
        [AktivitasController::class, 'tandaiSelesai'])
    ->name('aktivitas.tandai_selesai');

});


    /* =====================================================
    DOSEN
    ===================================================== */
    Route::prefix('dosen')
        ->name('dosen.')
        ->middleware(['auth','role:dosen'])
        ->group(function(){

    Route::get('/dashboard', [DosenDashboardController::class,'index'])
        ->name('dashboard');

    // ---------------------------------------------------------
    // ROUTE MANAJEMEN PRAKTIKUM
    // ---------------------------------------------------------
    Route::get('/praktikum', [PraktikumController::class, 'index'])
    ->name('praktikum.index');
    Route::get('/praktikum/{id}', [PraktikumController::class, 'dosenShow'])
        ->name('praktikum.show');
    Route::put('/praktikum/update/{id}', [PraktikumController::class, 'update']);
    Route::post('/dosen/praktikum/nilai', [PraktikumController::class, 'beriNilai']);

    // ---------------------------------------------------------
    // ROUTE MANAJEMEN KELAS
    // ---------------------------------------------------------
    Route::get('/kelas', [KelasController::class, 'index'])
        ->name('kelas.index');
    Route::post('/kelas', [KelasController::class, 'store'])
        ->name('kelas.store');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])
    ->name('dosen.kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])
    ->name('kelas.destroy');

    // ---------------------------------------------------------
    // ROUTE MANAJEMEN MAHASISWA
    // ---------------------------------------------------------
    Route::get('/datamahasiswa', [DataMahasiswaController::class, 'index'])->name('datamahasiswa.index');
    Route::put('/datamahasiswa/{id}', [DataMahasiswaController::class, 'update'])->name('datamahasiswa.update');
    Route::delete('/datamahasiswa/{id}', [DataMahasiswaController::class, 'destroy'])->name('datamahasiswa.destroy');

    // ---------------------------------------------------------
    // ROUTE MANAJEMEN MAHASISWA
    // ---------------------------------------------------------
    Route::get('/soal', [ButirSoalController::class, 'index'])->name('soal.index');
    Route::post('/soal', [ButirSoalController::class, 'store'])->name('soal.store');
    Route::put('/soal/{id}', [ButirSoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/{id}', [ButirSoalController::class, 'destroy'])->name('soal.destroy');


    Route::get('/pengaturan-kkm', [SettingController::class, 'index'])->name('kkm.index');
    Route::post('/pengaturan-kkm', [SettingController::class, 'update'])->name('kkm.update');

    Route::get('/rekap-nilai', [NilaiController::class, 'index'])
    ->name('nilai.index');

    Route::post('/set-kkm', [DosenDashboardController::class, 'setKkm'])
    ->name('setKkm');

    Route::get('/setting', [SettingController::class,'index'])
        ->name('setting');



});





































// Route::get('/bubble-sort', function () {
//     return view('bubble-sort');
// });


// Route::get('/visualisasi', function () {
//     return view('student.visualisasi');
// });

// Route::get('/kuis', function () {
//     return view('student.kuis');
// });

// Route::get('/latihan', function () {
//     return view('student.latihan');
// });

// Route::prefix('siswa')->group(function () {
//     Route::view('/materi','student.materi');
//     Route::view('/visualisasi','student.visualisasi');
//     Route::view('/kuis','student.kuis');
//     Route::view('/latihan','student.latihan');
// });
