<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_rooms')->insert([
            'name' => 'pádel',
            'duration' => 60,
            'capacity' => 3,
            'info' => 'Elige cualquiera de las canchas disponibles a la hora de tu reserva.'
        ]);
        DB::table('reservation_rooms')->insert([
            'name' => 'baloncesto',
            'duration' => 60,
            'capacity' => 1,
            'info' => 'Recuerda no pasarte de la hora reservada.'
        ]);
        DB::table('reservation_rooms')->insert([
            'name' => 'sala común',
            'duration' => 60,
            'capacity' => 1,
            'info' => 'Recuerda que el salón es para disfrute de todos, se cuidadoso con el mobiliario.'
        ]);
        DB::table('reservation_rooms')->insert([
            'name' => 'comedor',
            'duration' => 30,
            'capacity' => 60,
            'info' => 'Recuerda que no podrás acceder a la cocina a otra hora aunque hayan plazas libres.'
        ]);
    }
}
