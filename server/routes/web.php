<?php

use App\Http\Controllers\DashboardAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemetaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Models\Pemetaan;
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

Route::get('/', [DashboardController::class, 'indexSiswa'])->middleware('auth');

Route::get('/auth/login', [DashboardAuthController::class, 'index'])->middleware('guest')->name('login');
Route::get('/auth/register', [DashboardAuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/login', [DashboardAuthController::class, 'authenticate'])->name('auth.login');
Route::post('/register', [DashboardAuthController::class, 'store'])->name('auth.register');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [DashboardAuthController::class, 'logout']);
    Route::get('/download-kartu-peserta', [DashboardController::class, 'downloadKartuPeserta'])->name('download.kartu-peserta');
    Route::get('/download-surat-resmi', [DashboardController::class, 'downloadSuratResmi'])->name('download.surat-resmi');
    Route::get('/download-kartu-peserta/{user}', [DashboardController::class, 'downloadKartuPesertaFromAdmin'])->name('download.kartu-peserta.admin');
    Route::get('/download-surat-resmi/{user}', [DashboardController::class, 'downloadSuratResmiFromAdmin'])->name('download.surat-resmi.admin');

    Route::get('/kartu-peserta-view', function () {
        $pemetaan = Pemetaan::where('user_id', auth()->user()->id)->first();
        return view('student.kartu-peserta', ['user' => auth()->user(), 'pemetaan' => $pemetaan, 'date' => null, 'time' => null]);
    });
    Route::get('/surat-resmi-view', function () {
        $pemetaan = Pemetaan::where('user_id', auth()->user()->id)->first();
        return view('student.surat-resmi', ['user' => auth()->user(), 'pemetaan' => $pemetaan]);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/student', [DashboardController::class, 'indexSiswa'])->name('dashboard.siswa');
        Route::post('/student/jalur', [DashboardController::class, 'jalurSiswa'])->name('dashboard.jalur.update');

        Route::get('/data-umum', [StudentDashboardController::class, 'dataUmum'])->name('dashboard.data-umum');
        Route::put('/data-umum/update', [StudentDashboardController::class, 'updateDataUmum'])->name('dashboard.data-umum.update');

        Route::get('/data-sekolah', [StudentDashboardController::class, 'dataSekolah'])->name('dashboard.data-sekolah');
        Route::put('/data-sekolah/update', [StudentDashboardController::class, 'updateDataSekolah'])->name('dashboard.data-sekolah.update');

        Route::get('/data-prestasi', [StudentDashboardController::class, 'dataPrestasi'])->name('dashboard.data-prestasi');
        Route::post('/data-prestasi/store', [StudentDashboardController::class, 'storeDataPrestasi'])->name('dashboard.data-prestasi.store');
        Route::delete('/data-prestasi/delete/{id}', [StudentDashboardController::class, 'deleteDataPrestasi'])->name('dashboard.data-prestasi.delete');
        Route::post('/data-prestasi/{prestasi}/update', [StudentDashboardController::class, 'updateDataPrestasi'])->name('dashboard.data-prestasi.update');

        Route::get('/data-ortu', [StudentDashboardController::class, 'dataOrtu'])->name('dashboard.data-ortu');
        Route::put('/data-ortu/update', [StudentDashboardController::class, 'updateDataOrtu'])->name('dashboard.data-ortu.update');

        Route::get('/data-berkas', [StudentDashboardController::class, 'dataBerkas'])->name('dashboard.data-berkas');
        Route::put('/data-berkas/update', [StudentDashboardController::class, 'updateDataBerkas'])->name('dashboard.data-berkas.update');

        Route::get('/data-alamat', [StudentDashboardController::class, 'dataAlamat'])->name('dashboard.data-alamat');
        Route::put('/data-alamat/update', [StudentDashboardController::class, 'updateDataAlamat'])->name('dashboard.data-alamat.update');


        Route::middleware(['admin'])->group(function () {
            Route::get('/export-to-excel', [DashboardController::class, 'export'])->name('dashboard.export.excel');
        });
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');
        Route::delete('/dashboard/students/{student}', [DashboardController::class, 'destroy'])->name('dashboard.data-siswa.delete');

        Route::get('/data-siswa', [ProfileController::class, 'index'])->name('dashboard.data-siswa');
        Route::get('/data-siswa/{user:email}', [ProfileController::class, 'show'])->name('dashboard.data-siswa.detail');
        Route::get('/data-siswa/{user:email}/edit', [ProfileController::class, 'edit'])->name('dashboard.data-siswa.edit');
        Route::put('/data-siswa/update/{user}', [ProfileController::class, 'update'])->name('dashboard.data-siswa.update');

        Route::get('/data-guru', [ProfileController::class, 'indexGuru'])->name('dashboard.data-guru');
        Route::post('/data-guru/store', [ProfileController::class, 'storeGuru'])->name('dashboard.data-guru.store');

        Route::get('/data-verifikasi', [ProfileController::class, 'indexVerifikasi'])->name('dashboard.verifikasi');
        Route::get('/data-verifikasi/{user:email}', [ProfileController::class, 'showVerifikasi'])->name('dashboard.verifikasi.detail');
        Route::get('/data-verifikasi/{prestasi}/sertifikat', [ProfileController::class, 'verifSertifikat'])->name('dashboard.verifikasi.sertifikat');
        Route::post('/data-verifikasi/{user}/verifikasi', [ProfileController::class, 'verifikasi'])->name('verifikasi');
        Route::post('/data-verifikasi/{user}/cancel-verifikasi', [ProfileController::class, 'inverifikasi'])->name('inverifikasi');

        Route::post('/reset-password/{user}', [ProfileController::class, 'resetPassword'])->name('dashboard.password-reset');

        Route::get('/data-pemetaan', [PemetaanController::class, 'index'])->name('dashboard.pemetaan');
    });
});
