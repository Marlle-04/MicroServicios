<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::post('/payments', [PaymentController::class, 'process']);          // Procesar pago
Route::get('/payments/{id}', [PaymentController::class, 'status']);       // Consultar estado
Route::post('/payments/refund/{id}', [PaymentController::class, 'refund']); // Reembolso
