<?php

use App\Http\Controllers\DashboardAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
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

Route::redirect('/', '/dashboard');

Route::get('/auth/login', [DashboardAuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [DashboardAuthController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [DashboardAuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/dashboard/students/{student}', [DashboardController::class, 'destroy']);

    Route::get('/data-profile', [ProfileController::class, 'index']);
    Route::get('/data-profile/{user:email}', [ProfileController::class, 'show']);

    Route::get('/hasil-akhir', [ResultController::class, 'index']);
});
