<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;
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

    Route::get('/profesores', [ProfesorController::class, 'index']);

    Route::get('/ciclos', [CicloController::class, 'index']);

    Route::post('/crear-ciclo', [CicloController::class, 'store']);

    Route::post('/ciclo/editar/{ciclo}', [CicloController::class, 'update']);

    Route::get('/grupos/curso/{codigo_curso}', [GrupoController::class, 'gruposCurso']);

    Route::get('/grupos/profesor/{cedula_profesor}', [GrupoController::class, 'gruposProfesor']);

    Route::post('/crear-grupo', [GrupoController::class, 'store']);

    Route::post('/grupos/editar/{grupo}', [GrupoController::class, 'update']);
});
