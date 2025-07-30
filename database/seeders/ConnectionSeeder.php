<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'is_accepted' => true,
            'accepted_at' => now()
        ]);
        DB::table('user_connections')->insert([
            'initiator_id' => 1,
            'recipient_id' => 3,
        ]);
    }
}
