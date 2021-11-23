<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert([
            'user_id' => 1,
        ]);
        DB::table('chats')->insert([
            'user_id' => 2,
        ]);

        DB::table('chat_messages')->insert([
            'text' => 'Bienvenido al chat con la Residencia.',
            'chat_id' => 1,
            'sender' => 'residence',
            'created_at' => Carbon::now()->modify('-40 hour')
        ]);

        DB::table('chat_messages')->insert([
            'text' => '¡Buenas tardes!',
            'chat_id' => 1,
            'sender' => 'client',
            'created_at' => Carbon::now()->modify('-38 hour')
        ]);

        DB::table('chat_messages')->insert([
            'text' => 'Bienvenido al chat con la Residencia.',
            'chat_id' => 2,
            'sender' => 'residence',
            'created_at' => Carbon::now()->modify('-40 hour')
        ]);
    }
}
