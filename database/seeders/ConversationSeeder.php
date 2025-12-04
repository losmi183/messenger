<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversations')->insert([
        [
            'id' => 1,
            'type' => 'private'
        ],
        [
            'id' => 2,
            'type' => 'private'
        ],
        [
            'id' => 3,
            'type' => 'group'
        ]]);

        DB::table('conversation_user')->insert([
        [
            'conversation_id' => 1,
            'user_id' =>1,
            'joined_at' => now()
        ],
        [
            'conversation_id' => 1,
            'user_id' =>2,
            'joined_at' => now()
        ],


        [
            'conversation_id' => 2,
            'user_id' =>1,
            'joined_at' => now()
        ],
        [
            'conversation_id' => 2,
            'user_id' =>1001,
            'joined_at' => now()
        ],


        [
            'conversation_id' => 3,
            'user_id' =>1,
            'joined_at' => now()
        ],
        [
            'conversation_id' => 3,
            'user_id' =>1001,
            'joined_at' => now()
        ],
        [
            'conversation_id' => 3,
            'user_id' =>2,
            'joined_at' => now()
        ]]);
    }
}
