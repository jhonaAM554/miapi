<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ReporteController;

// Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {

    // CRUD de personas
    //Route::apiResource('personas', PersonaController::class);
    Route::apiResource('reportes', ReporteController::class);

    // Obtener usuario autenticado
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});