<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check', [\App\Http\Controllers\ApiController::class, 'check'])->name('check');
Route::get('/getMos', [\App\Http\Controllers\ApiController::class, 'getMos'])->name('getMos');
Route::get('/getMosShahr', [\App\Http\Controllers\ApiController::class, 'getMosShahr'])->name('getMosShahr');
Route::get('/deleteRep', [\App\Http\Controllers\ApiController::class, 'deleteRep'])->name('deleteRep');
Route::get('/checkPeyk', [\App\Http\Controllers\ApiController::class, 'checkPeyk'])->name('checkPeyk');
