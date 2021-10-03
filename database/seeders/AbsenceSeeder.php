<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absences')->insert([
            'observations' => 'Me voy de vacaciones',
            'start_date' => Carbon::now()->modify('+1 week'),
            'finish_date' => Carbon::now()->modify('+2 week'),
            'user_id' => 1,
            'created_at' => Carbon::now()
        ]);
    }
}
