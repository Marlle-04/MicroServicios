<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Rutas para el CRUD del usuario
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

Route::put('/users/{id}/role', [UserController::class, 'updateRole']);
