<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Validación y posible consulta a event-service aquí
        $reservation = Reservation::create($request->all());
        return response()->json($reservation, 201);
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();

        return response()->json(['message' => 'Reserva cancelada']);
    }

    public function userReservations($userId)
    {
        return Reservation::where('user_id', $userId)->get();
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        return response()->json(['message' => 'Estado actualizado']);
    }
}
