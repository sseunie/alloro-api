<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResidenceSeeder extends Seeder
{
    const NAMES = ["Residencia Campus de Tafira", "Apartamentos Campus de Tafira", "Residencia Las Palmas", "Bungalows"];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::NAMES as $name) {
            DB::table('residences')->insert([
                'name' => $name
            ]);
        }
    }
}
