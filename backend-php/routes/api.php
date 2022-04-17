<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\CursoController;
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

    Route::get('/carreras', [CarreraController::class, 'index']);

    Route::post('/crear-carrera', [CarreraController::class, 'store']);

    Route::post('/carrera/editar/{carrera}', [CarreraController::class, 'update']);

    Route::get('/cursos', [CursoController::class, 'index']);

    Route::post('/crear-curso', [CursoController::class, 'store']);

    Route::get('/ciclos', [CicloController::class, 'index']);

    Route::post('/crear-ciclo', [CicloController::class, 'store']);

    Route::get('/alumnos',[AlumnoController::class, 'index']);

    Route::post('/crear-alumno', [AlumnoController::class, 'store']);

    Route::post('/alumno/editar/{alumno}', [AlumnoController::class, 'update']);

    Route::get('/profesores', [ProfesorController::class, 'index']);

    Route::post('/crear-profesor', [ProfesorController::class, 'store']);
    
    Route::post('/profesor/editar/{profesor}', [ProfesorController::class, 'update']);

    Route::get('/usuarios', [UsuarioController::class, 'index']);

    Route::post('/crear-usuario', [UsuarioController::class, 'store']);

    Route::post('/usuario/editar/{usuario}', [UsuarioController::class, 'update']);


});
