<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class IncidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('incidences')->insert([
            'subject' => '¡Hay una gotera!',
            'message' => 'Hay una gotera en mi habitación y se está inundando el suelo.',
            'incidence_area_id' => 3,
            'residence_id' => 3,
            'user_id' => 1,
            'closed' => true,
            'read' => false,
            'created_at' => Carbon::now()->modify('-3 day')
        ]);

        DB::table('messages')->insert([
            'text' => 'Incidencia enviada al área indicada',
            'incidence_id' => 1,
            'sender' => 'residence',
            'created_at' => Carbon::now()->modify('-2 day')
        ]);

        DB::table('messages')->insert([
            'text' => '¡Gracias!',
            'incidence_id' => 1,
            'sender' => 'client',
            'created_at' => Carbon::now()->modify('-40 hour')
        ]);

        DB::table('messages')->insert([
            'text' => 'Mantenimiento comunica que la incidencia ha sido solucionada',
            'incidence_id' => 1,
            'sender' => 'residence',
            'created_at' => Carbon::now()->modify('-1 day')
        ]);

        DB::table('incidences')->insert([
            'subject' => 'No funciona un enchufe',
            'message' => 'Hay un enchufe en mi habitación que no funciona.',
            'incidence_area_id' => 3,
            'residence_id' => 2,
            'user_id' => 1,
            'read' => false,
            'created_at' => Carbon::now()->modify('-6 minute')
        ]);

        DB::table('messages')->insert([
            'text' => 'Incidencia enviada al área indicada',
            'incidence_id' => 2,
            'sender' => 'residence',
            'created_at' => Carbon::now()->modify('-2 minute')
        ]);
    }
}
