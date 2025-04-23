<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

// Crear una nueva reserva
Route::post('/reservations', [ReservationController::class, 'store']);

// Cancelar una reserva por ID
Route::put('/reservations/cancel/{id}', [ReservationController::class, 'cancel']);

// Obtener todas las reservas de un usuario
Route::get('/reservations/user/{userId}', [ReservationController::class, 'userReservations']);

// Actualizar el estado de una reserva
Route::put('/reservations/status/{id}', [ReservationController::class, 'updateStatus']);
