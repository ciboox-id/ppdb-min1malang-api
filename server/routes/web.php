<?php

use App\Http\Controllers\DashboardAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/auth/login');

Route::get('/auth/login', [DashboardAuthController::class, 'index'])->middleware('guest')->name('login');
Route::get('/auth/register', [DashboardAuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/login', [DashboardAuthController::class, 'authenticate']);
Route::post('/register', [DashboardAuthController::class, 'store'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [DashboardAuthController::class, 'logout']);
    Route::get('/download-kartu-peserta', [DashboardController::class, 'downloadKartuPeserta'])->name('download.kartu-peserta');
    Route::get('/download-surat-resmi', [DashboardController::class, 'downloadSuratResmi'])->name('download.surat-resmi');

    // Route::get('/kartu-peserta-view', function () {
    //     return view('student.kartu-peserta', ['user' => auth()->user()]);
    // });
    Route::get('/surat-resmi-view', function () {
        return view('student.surat-resmi', ['user' => auth()->user()]);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/student', [DashboardController::class, 'indexSiswa'])->name('dashboard.siswa');

        Route::get('/data-umum', [StudentDashboardController::class, 'dataUmum'])->name('dashboard.data-umum');
        Route::put('/data-umum/update', [StudentDashboardController::class, 'updateDataUmum'])->name('dashboard.data-umum.update');

        Route::get('/data-sekolah', [StudentDashboardController::class, 'dataSekolah'])->name('dashboard.data-sekolah');
        Route::put('/data-sekolah/update', [StudentDashboardController::class, 'updateDataSekolah'])->name('dashboard.data-sekolah.update');

        Route::get('/data-prestasi', [StudentDashboardController::class, 'dataPrestasi'])->name('dashboard.data-prestasi');
        Route::post('/data-prestasi/store', [StudentDashboardController::class, 'storeDataPrestasi'])->name('dashboard.data-prestasi.update');
        Route::delete('/data-prestasi/delete/{id}', [StudentDashboardController::class, 'deleteDataPrestasi'])->name('dashboard.data-prestasi.delete');

        Route::get('/data-ortu', [StudentDashboardController::class, 'dataOrtu'])->name('dashboard.data-ortu');
        Route::put('/data-ortu/update', [StudentDashboardController::class, 'updateDataOrtu'])->name('dashboard.data-ortu.update');

        Route::get('/data-berkas', [StudentDashboardController::class, 'dataBerkas'])->name('dashboard.data-berkas');
        Route::put('/data-berkas/update', [StudentDashboardController::class, 'updateDataBerkas'])->name('dashboard.data-berkas.update');

        Route::get('/data-alamat', [StudentDashboardController::class, 'dataAlamat'])->name('dashboard.data-alamat');
        Route::put('/data-alamat/update', [StudentDashboardController::class, 'updateDataAlamat'])->name('dashboard.data-alamat.update');

    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');
        Route::post('/dashboard/students/{student}', [DashboardController::class, 'destroy']);

        Route::get('/data-profile', [ProfileController::class, 'index']);
        Route::get('/data-profile/{user:email}', [ProfileController::class, 'show']);

        Route::get('/hasil-akhir', [ResultController::class, 'index']);

        Route::post('/verifikasi-data/{user}', [ProfileController::class, 'verifikasi']);
        Route::post('/batal-verifikasi-data/{user}', [ProfileController::class, 'inverifikasi']);
    });
});
