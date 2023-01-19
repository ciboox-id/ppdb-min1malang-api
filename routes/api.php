<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FatherController;
use App\Http\Controllers\API\MotherController;
use App\Http\Controllers\API\PrestasiController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Route::apiResource('students', StudentController::class);
    Route::apiResource('fathers', FatherController::class);
    Route::apiResource('mothers', MotherController::class);
    Route::apiResource('prestasi', PrestasiController::class);


    // Route::post('/fathers/{father}', [FatherController::class, 'update']);
    // Route::post('/mothers/{mother}', [MotherController::class, 'update']);
    Route::post('/students/{student}', [StudentController::class, 'update']);
});
