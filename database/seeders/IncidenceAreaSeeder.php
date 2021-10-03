<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenceAreaSeeder extends Seeder
{
    const NAMES = [
        "Lavandería", "Comedor", "Recepción", "Mantenimiento", "Limpieza", "Comunicaciones",
        "Equipamiento/Infraestructuras", "Administración", "Ruidos"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::NAMES as $name) {
            DB::table('incidence_areas')->insert([
                'name' => $name
            ]);
        }
    }
}
