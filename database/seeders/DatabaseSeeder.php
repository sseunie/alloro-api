<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ResidenceSeeder::class,
            IncidenceAreaSeeder::class,
            IncidenceSeeder::class,
            AbsenceSeeder::class,
            NotificationSeeder::class,
            ReservationRoomSeeder::class,
            ReservationTimeRangeSeeder::class,
            ChatSeeder::class
        ]);
    }
}
