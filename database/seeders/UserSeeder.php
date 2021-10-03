<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Stefany',
            'surname1' => 'Martin',
            'surname2' => 'Socas',
            'email' => 'stefany.ms@icloud.com',
            'phone_number' => '123456789',
            'building' => 'EI',
            'building_name' => 'Edificio inventado',
            'room' => '311',
            'residence_channel' => '1',
            'role' => 'CL',
            'password' => Hash::make('1234')
        ]);

        DB::table('users')->insert([
            'name' => 'Maria',
            'surname1' => 'Hernández',
            'surname2' => 'Cabrera',
            'email' => 'maria@gmail.com',
            'phone_number' => '987654321',
            'building' => 'EI',
            'building_name' => 'Edificio inventado',
            'room' => '218',
            'residence_channel' => '1',
            'role' => 'CL',
            'password' => Hash::make('4321')
        ]);
    }
}
