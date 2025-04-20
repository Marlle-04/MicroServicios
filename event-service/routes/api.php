<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/events', [EventController::class, 'index']);            // Listar todos
Route::get('/events/{id}', [EventController::class, 'show']);        // Detalle
Route::post('/events', [EventController::class, 'store']);           // Crear
Route::put('/events/{id}', [EventController::class, 'update']);      // Actualizar
Route::delete('/events/{id}', [EventController::class, 'destroy']);  // Eliminar
