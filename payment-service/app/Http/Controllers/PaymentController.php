<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $payment = Payment::create([
            'reservation_id' => $request->reservation_id,
            'amount' => $request->amount,
            'method' => $request->method,
            'status' => 'paid',
        ]);

        return response()->json(['message' => 'Pago procesado', 'payment' => $payment]);
    }

    public function status($id)
    {
        return Payment::findOrFail($id);
    }

    public function refund($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'refunded';
        $payment->save();

        return response()->json(['message' => 'Pago reembolsado']);
    }
}
