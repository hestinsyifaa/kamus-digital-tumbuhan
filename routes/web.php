<?php

use Illuminate\Support\Facades\Route;

/* =========================
   CONTROLLERS
========================= */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TumbuhanController as AdminTumbuhanController;
use App\Http\Controllers\Admin\HasilKlasifikasiController;
use App\Http\Controllers\Admin\ValidasiKlasifikasiController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\User\TumbuhanController as UserTumbuhanController;

/* =========================
   AUTH ROUTE
========================= */

Route::get('/login', [
    AuthController::class,
    'loginPage'
])->name('login');

Route::post('/login', [
    AuthController::class,
    'login'
]);

Route::get('/logout', [
    AuthController::class,
    'logout'
]);

/* =========================
   USER ROUTE
========================= */

Route::get('/', fn () => view('user.splash'));

Route::get('/home', fn () => view('user.home'));

/* =========================
   KAMUS TUMBUHAN USER
========================= */

Route::prefix('tumbuhan')->group(function () {

    Route::get('/', [
        UserTumbuhanController::class,
        'index'
    ]);

    Route::post('/', [
        UserTumbuhanController::class,
        'store'
    ]);

    Route::get('/{id}', [
        UserTumbuhanController::class,
        'show'
    ]);

});

/* =========================
   KLASIFIKASI USER
========================= */

Route::prefix('klasifikasi')->group(function () {

    // halaman utama
    Route::get('/', function () {
        return view('user.klasifikasi.index');
    });

    // halaman klasifikasi teks
    Route::get('/teks', function () {
        return view('user.klasifikasi.teks');
    });

    // halaman klasifikasi citra
    Route::get('/citra', function () {
        return view('user.klasifikasi.citra');
    });

    // proses klasifikasi teks
    Route::post('/proses-teks', [
        UserTumbuhanController::class,
        'prosesTeks'
    ]);

    // proses klasifikasi citra
    Route::post('/proses-citra', [
        UserTumbuhanController::class,
        'prosesCitra'
    ]);
});

/* =========================
   ADMIN ROUTE
========================= */

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard', [DashboardController::class, 'index']);

    /* =========================
       CRUD TUMBUHAN
    ========================= */

    Route::prefix('tumbuhan')->group(function () {

        Route::get('/', [AdminTumbuhanController::class, 'index']);
        Route::get('/create', [AdminTumbuhanController::class, 'create']);
        Route::post('/', [AdminTumbuhanController::class, 'store']);
        Route::get('/{id}', [AdminTumbuhanController::class, 'show']);
        Route::get('/{id}/edit', [AdminTumbuhanController::class, 'edit']);
        Route::put('/{id}', [AdminTumbuhanController::class, 'update']);
        Route::delete('/{id}', [AdminTumbuhanController::class, 'destroy']);

    });

    /* =========================
       HASIL KLASIFIKASI
    ========================= */

    Route::get('/klasifikasi', [HasilKlasifikasiController::class, 'index']);

    /* =========================
       VALIDASI
    ========================= */

    Route::prefix('validasi')->group(function () {

        Route::get('/', [ValidasiKlasifikasiController::class, 'index']);

        Route::post('/{id}', [ValidasiKlasifikasiController::class, 'updateStatus']);

        // ✅ EXPORT PDF (INI YANG BENAR)
        Route::get('/export-pdf', [ValidasiKlasifikasiController::class, 'exportPdf']);

    });

    /* MODEL */
    Route::get('/models', [ModelController::class, 'index']);

    /* =========================
       LOG AKTIVITAS
    ========================= */

    Route::prefix('log')->group(function () {

        Route::get('/', [LogAktivitasController::class, 'index']);
        Route::post('/', [LogAktivitasController::class, 'store']);
        Route::get('/{id}', [LogAktivitasController::class, 'show']);

    });

});
