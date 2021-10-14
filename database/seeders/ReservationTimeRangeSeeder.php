<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationTimeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_time_ranges')->insert([
            'room' => 'pádel',
            'from' => '9:00',
            'to' => '19:00'
        ]);
        DB::table('reservation_time_ranges')->insert([
            'room' => 'sala común',
            'from' => '9:00',
            'to' => '21:00'
        ]);
        DB::table('reservation_time_ranges')->insert([
            'room' => 'baloncesto',
            'from' => '9:00',
            'to' => '19:00'
        ]);
        DB::table('reservation_time_ranges')->insert([
            'room' => 'comedor',
            'from' => '7:00',
            'to' => '10:00',
            'name' => 'Desayuno'
        ]);
        DB::table('reservation_time_ranges')->insert([
            'room' => 'comedor',
            'from' => '12:00',
            'to' => '16:00',
            'name' => 'Almuerzo'
        ]);
        DB::table('reservation_time_ranges')->insert([
            'room' => 'comedor',
            'from' => '18:00',
            'to' => '18:30',
            'name' => 'Merienda'
        ]);
        DB::table('reservation_time_ranges')->insert([
            'room' => 'comedor',
            'from' => '20:00',
            'to' => '21:30',
            'name' => 'Cena'
        ]);
    }
}
