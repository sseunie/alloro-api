<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            'title' => 'Renovación de plaza para el próximo curso',
            'text' => 'Recuerda que el viernes 28 es el último día para solicitar la renovación de plaza en las Residencias Universitarias ULPGC para el próximo curso.',
            'url' => 'https://www.google.com/',
            'created_at' => Carbon::now()->modify('-3 week')
        ]);

        DB::table('notifications')->insert([
            'title' => 'Encuestas de evaluación',
            'text' => 'Hemos enviado a tu correo el enlace a la encuesta de evaluación de los servicios de las Residencias Universitarias ULPG, rogamos tu colaboración.',
            'url' => 'https://www.google.com/',
            'created_at' => Carbon::now()->modify('-1 week')
        ]);

        DB::table('notifications')->insert([
            'title' => 'Aviso de abandono',
            'text' => 'Si aún no lo has hecho, recuerda realizar tu aviso de abandono de las residencias antes del 28 de este mes a través del área privada.',
            'url' => 'https://www.google.com/',
            'created_at' => Carbon::now()->modify('-3 day')
        ]);
    }
}
