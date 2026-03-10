<?php

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\AuthController;
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
    });

    Route::get('/kodeku', function () {
        return view('kodeku');
    })->name('kodeku');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

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

    Route::post('/quiz/submit/{id_aktivitas}',
        [KategoriSoalController::class,'submit']
    )->name('quiz.submit');

    Route::get('/{folder}/{slug}',
        [AktivitasController::class,'show']
    )->name('aktivitas.show');


//     /* ===== MATERI UMUM ===== */
//     Route::get('/sorting', function () {
//         return view('mahasiswa.pendahuluan.sorting');
//     })->name('sorting');

//     Route::get('/quiz-test/{id}', 
//     [AktivitasController::class, 'showById']
//     )->name('quiz.test');


//     /* ===== PENDAHULUAN ===== */
//     Route::prefix('pendahuluan')->name('pendahuluan.')->group(function () {

//         // Route::get('/materi', function () {
//         //     return view('mahasiswa.pendahuluan.materi');
//         // })->name('materi');

//         Route::get('/sorting', function () {
//             return view('mahasiswa.pendahuluan.sorting');
//         })->name('sorting');


//         Route::get('/kompleksitas', function () {
//             return view('mahasiswa.pendahuluan.kompleksitas');
//         })->name('kompleksitas');

//         Route::get('/quiz', function () {
//             return view('mahasiswa.pendahuluan.quiz');
//         })->name('quiz');

//         // Route::get('/latihan', function () {
//         //     return view('mahasiswa.pendahuluan.latihan');
//         // })->name('latihan');
//     });


//     /* ===== BUBBLE SORT ===== */
//     Route::prefix('bubble')->name('bubble.')->group(function () {

//         Route::get('/materi', function () {
//             return view('mahasiswa.bubble.materi');
//         })->name('materi');

//         Route::get('/simulasi', function () {
//             return view('mahasiswa.bubble.simulasi');
//         })->name('simulasi');

//         Route::get('/program', function () {
//             return view('mahasiswa.bubble.program');
//         })->name('program');

//         Route::get('/quiz', function () {
//             return view('mahasiswa.bubble.quiz');
//         })->name('quiz');

//         Route::get('/praktikum', function () {
//             return view('mahasiswa.bubble.praktikum');
//         })->name('praktikum');

//         Route::get('/mahasiswa/praktikum/{id}', [PraktikumController::class, 'show']);
//         Route::post('/praktikum/submit',
//             [PraktikumController::class, 'submit']
//         )->name('praktikum.submit');


//     });


//     /* ===== SELECTION SORT ===== */
//     Route::prefix('selection')->name('selection.')->group(function () {

//         Route::get('/materi', function () {
//             return view('mahasiswa.selection.materi');
//         })->name('materi');

//         Route::get('/simulasi', function () {
//             return view('mahasiswa.selection.simulasi');
//         })->name('simulasi');

//         Route::get('/program', function () {
//             return view('mahasiswa.selection.program');
//         })->name('program');

//         Route::get('/quiz', function () {
//             return view('mahasiswa.selection.quiz');
//         })->name('quiz');

//         Route::get('/praktikum', function () {
//             return view('mahasiswa.selection.praktikum');
//         })->name('praktikum');
//     });


//     /* ===== INSERTION SORT ===== */
//     Route::prefix('insertion')->name('insertion.')->group(function () {

//         Route::get('/materi', function () {
//             return view('mahasiswa.insertion.materi');
//         })->name('materi');

//         Route::get('/simulasi', function () {
//             return view('mahasiswa.insertion.simulasi');
//         })->name('simulasi');

//         Route::get('/program', function () {
//             return view('mahasiswa.insertion.program');
//         })->name('program');

//         Route::get('/quiz', function () {
//             return view('mahasiswa.insertion.quiz');
//         })->name('quiz');

//         Route::get('/praktikum', function () {
//             return view('mahasiswa.insertion.praktikum');
//         })->name('praktikum');
//     });


//     /* ===== MERGE SORT ===== */
//     Route::prefix('merge')->name('merge.')->group(function () {

//         Route::get('/materi', function () {
//             return view('mahasiswa.merge.materi');
//         })->name('materi');

//                 Route::get('/simulasi', function () {
//             return view('mahasiswa.merge.simulasi');
//         })->name('simulasi');

//         Route::get('/program', function () {
//             return view('mahasiswa.merge.program');
//         })->name('program');

//         Route::get('/quiz', function () {
//             return view('mahasiswa.merge.quiz');
//         })->name('quiz');

//         Route::get('/praktikum', function () {
//             return view('mahasiswa.merge.praktikum');
//         })->name('praktikum');
//     });

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
