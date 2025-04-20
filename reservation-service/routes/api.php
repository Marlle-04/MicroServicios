<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::post('/reservations', [ReservationController::class, 'store']);                    // Crear reserva
Route::put('/reservations/cancel/{id}', [ReservationController::class, 'cancel']);        // Cancelar
Route::get('/reservations/user/{userId}', [ReservationController::class, 'userReservations']); // Consultar por usuario
Route::put('/reservations/status/{id}', [ReservationController::class, 'updateStatus']);  // Actualizar estado
