<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\NotificacionController;

// Públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('reportes', [ReporteController::class, 'index']);
Route::get('reportes/{reporte}', [ReporteController::class, 'show']);
Route::post('/google-login',[AuthController::class, 'googleLogin']);
 Route::get( 'prueba-push', [AuthController::class, 'pruebaPush']);

// Protegidas
Route::middleware('auth:sanctum')->group(function () {

    

    Route::post('change-password',[AuthController::class, 'cambiarPassword']);
    Route::post('update-profile',[AuthController::class, 'actualizarPerfil']);
    Route::post('reportes', [ReporteController::class, 'store']);
    Route::post('guardar-fcm-token', [AuthController::class, 'guardarFcmToken']);
   
    
    Route::put('reportes/{reporte}', [ReporteController::class, 'update']);
    Route::delete('reportes/{reporte}', [ReporteController::class, 'destroy']);

    Route::apiResource('comentarios', ComentarioController::class);

    Route::apiResource('notificaciones', NotificacionController::class);

    Route::get('user', function (Request $request) {
        return $request->user();
    });
});