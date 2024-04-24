<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PerkuliahanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/perkuliahan')->group(function () {
    Route::get('/', [PerkuliahanController::class,'index']);
    Route::get('/{nim}', [PerkuliahanController::class,'selectNilaiBasedOnNim']);
    Route::post('/nilai', [PerkuliahanController::class,'addNewNilai']);
    Route::put('/nilai', [PerkuliahanController::class,'updateNilai']);
    Route::delete('/nilai/{nim}/{mk}', [PerkuliahanController::class,'destroy']);
});

Route::get('/all-mahasiswa',[MahasiswaController::class,'getAllMhs']);
Route::get('/all-matkul',[MataKuliahController::class,'getAllMatkul']);
