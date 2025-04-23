<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use App\Models\Reservation;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Obtener o crear el primer usuario
        $user = User::firstOrCreate(
            ['email' => 'prueba@eventos.com'],
            [
                'name' => 'Usuario de prueba',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ]
        );

        // Insertar varias reservas para el primer usuario
        Reservation::create([
            'user_id' => $user->id,
            'reservation_date' => now()->addDays(1),
            'status' => 'confirmed',
        ]);

        Reservation::create([
            'user_id' => $user->id,
            'reservation_date' => now()->addDays(3),
            'status' => 'pending',
        ]);

        Reservation::create([
            'user_id' => $user->id,
            'reservation_date' => now()->addDays(5),
            'status' => 'cancelled',
        ]);

        // Obtener o crear un segundo usuario
        $user2 = User::firstOrCreate(
            ['email' => 'carlos@eventos.com'],
            [
                'name' => 'Carlos Lopez',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ]
        );

        Reservation::create([
            'user_id' => $user2->id,
            'reservation_date' => now()->addDays(7),
            'status' => 'confirmed',
        ]);

        Reservation::create([
            'user_id' => $user2->id,
            'reservation_date' => now()->addDays(10),
            'status' => 'pending',
        ]);
    }
}
