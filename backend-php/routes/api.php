<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\LoggoutController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProfesorController;

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

//Rutas que no necesitan autentificacion
Route::prefix('LME')->group(function () {
    Route::post('/login/user', [UsuarioController::class, 'login']);

    Route::post('/login/profesor', [ProfesorController::class, 'login']);

    Route::post('/login/alumno', [AlumnoController::class, 'login']);
});
Route::middleware('auth:sanctum')->prefix('LME')->group(function () {

    Route::delete('/logout', [LoggoutController::class, 'logout']);

    Route::post('/crear-carrera', [CarreraController::class, 'store']);

    Route::get('/carreras', [CarreraController::class, 'index']);
});
