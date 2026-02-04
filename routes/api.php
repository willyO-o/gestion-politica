<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ActividadController;
use App\Http\Controllers\Api\AsistenciaController;

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

// Rutas de autenticación JWT
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('api.login');
    Route::post('register', [AuthController::class, 'register'])->name('api.register');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('api.refresh');
        Route::get('me', [AuthController::class, 'me'])->name('api.me');
    });
});
// Rutas protegidas con autenticación JWT
Route::middleware('auth:api')->group(function () {

    // Rutas de Actividades
    Route::prefix('actividades')->group(function () {
        Route::get('/', [ActividadController::class, 'index'])->name('api.actividades.index');
        Route::get('/hoy', [ActividadController::class, 'actividadesHoy'])->name('api.actividades.hoy');
        Route::get('/{id}', [ActividadController::class, 'show'])->name('api.actividades.show');
        Route::post('/', [ActividadController::class, 'store'])->name('api.actividades.store');
        Route::put('/{id}', [ActividadController::class, 'update'])->name('api.actividades.update');
        Route::delete('/{id}', [ActividadController::class, 'destroy'])->name('api.actividades.destroy');
    });

    // Rutas de Asistencia
    Route::prefix('asistencia')->group(function () {
        // Registro de asistencia
        Route::post('/entrada', [AsistenciaController::class, 'registrarEntrada'])->name('api.asistencia.entrada');
        Route::post('/salida', [AsistenciaController::class, 'registrarSalida'])->name('api.asistencia.salida');
        Route::post('/permiso', [AsistenciaController::class, 'registrarPermiso'])->name('api.asistencia.permiso');

        // Consultas
        Route::get('/mi-registro-hoy', [AsistenciaController::class, 'miRegistroHoy'])->name('api.asistencia.mi-registro-hoy');
        Route::get('/historial', [AsistenciaController::class, 'historial'])->name('api.asistencia.historial');
        Route::get('/estadisticas', [AsistenciaController::class, 'estadisticas'])->name('api.asistencia.estadisticas');
        Route::get('/actividad/{id_actividad}', [AsistenciaController::class, 'asistenciasPorActividad'])->name('api.asistencia.por-actividad');
    });
});
