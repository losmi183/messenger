<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_connections')->insert([
            'initiator_id' => 1,
            'recipient_id' => 2,
            'accepted_at' => now(),
            'salt' => '8f9c180a5e48746fb8ab4bd196ad4e4b'
        ]);
        DB::table('user_connections')->insert([
            'initiator_id' => 1,
            'recipient_id' => 3,
        ]);
        DB::table('user_connections')->insert([
            'initiator_id' => 4,
            'recipient_id' => 1,
        ]);
        DB::table('user_connections')->insert([
            'initiator_id' => 5,
            'recipient_id' => 1,
        ]);
        DB::table('user_connections')->insert([
            'initiator_id' => 6,
            'recipient_id' => 1,
        ]);
        DB::table('user_connections')->insert([
            'initiator_id' => 7,
            'recipient_id' => 1,
        ]);
        DB::table('user_connections')->insert([
            'initiator_id' => 1,
            'recipient_id' => 1001,
            'accepted_at' => now(),
            'salt' => '8f9c180a5e48746fb8ab4bd196ad4e4b'
        ]);
    }
}
