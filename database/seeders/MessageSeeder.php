<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $salt = '15f545373c8a81a22851bdb1019bc50a'; // isti kao u user_connections
        // $passphrase = 'milosemil12#';

        // $encrypt = function ($text) use ($passphrase, $salt) {
        //     return base64_encode(openssl_encrypt(
        //         $text,
        //         'aes-256-cbc',
        //         hash('sha256', $passphrase . $salt, true),
        //         OPENSSL_RAW_DATA,
        //         substr(hash('sha256', $salt), 0, 16)
        //     ));
        // };


        // Prvi razgovor (user 1 <-> user 2)
        $start1 = Carbon::now()->subMinutes(10);

        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'conversation_id' => 12,
                'message' => 'U2FsdGVkX1/PGMuNS6S4LQ+0pyqY1qQVvCQA8Na6nrHkRuabCw969IkVTS3MeOMa',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start1->copy(),
                'updated_at' => $start1->copy(),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'conversation_id' => 12,
                'message' => 'U2FsdGVkX1/mkUjLZOX9PKHdtl7OiiYieRLAAlwfP1nzYmJmUrk38CyE+xifw0ew',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start1->copy()->addMinute(),
                'updated_at' => $start1->copy()->addMinute(),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'conversation_id' => 12,
                'message' => 'U2FsdGVkX19HVb3plFgBvKbjg8z62atRu8gHmToJRL932NAN3KDniW49WUEeo5e7',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start1->copy()->addMinutes(2),
                'updated_at' => $start1->copy()->addMinutes(2),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'conversation_id' => 12,
                'message' => 'U2FsdGVkX19zT/2QSCehHzzpUFXmWp2NK5Ysc2TnhbU=',
                'is_read' => 0,
                'seen' => null,
                'created_at' => $start1->copy()->addMinutes(3),
                'updated_at' => $start1->copy()->addMinutes(3),
            ],
          
        ]);

        // // Drugi razgovor (user 1 <-> user 1001)
        // $start2 = Carbon::now()->subMinutes(60);

        // DB::table('messages')->insert([
        //     [
        //         'sender_id' => 1,
        //         'receiver_id' => 1001,
        //         'conversation_id' => 13,
        //         'message' => $encrypt('Jel bi mogli da se vidimo?'),
        //         'is_read' => 1,
        //         'seen' => now(),
        //         'created_at' => $start2->copy(),
        //         'updated_at' => $start2->copy(),
        //     ],
        //     [
        //         'sender_id' => 1001,
        //         'receiver_id' => 1,
        //         'conversation_id' => 13,
        //         'message' => $encrypt('Ajde na Sodari za pola sata?'),
        //         'is_read' => 1,
        //         'seen' => now(),
        //         'created_at' => $start2->copy()->addMinute(),
        //         'updated_at' => $start2->copy()->addMinute(),
        //     ],
        //     [
        //         'sender_id' => 1,
        //         'receiver_id' => 1001,
        //         'conversation_id' => 13,
        //         'message' => $encrypt('Važi cimam kad sam tu.'),
        //         'is_read' => 1,
        //         'seen' => null,
        //         'created_at' => $start2->copy()->addMinutes(2),
        //         'updated_at' => $start2->copy()->addMinutes(2),
        //     ],
        //     [
        //         'sender_id' => 1,
        //         'receiver_id' => 1001,
        //         'conversation_id' => 13,
        //         'message' => $encrypt('Stigao?'),
        //         'is_read' => 1,
        //         'seen' => null,
        //         'created_at' => $start2->copy()->addMinutes(3),
        //         'updated_at' => $start2->copy()->addMinutes(3),
        //     ],
        //     [
        //         'sender_id' => 1001,
        //         'receiver_id' => 1,
        //         'conversation_id' => 13,
        //         'message' => $encrypt('Važi izlazim.'),
        //         'is_read' => 0,
        //         'seen' => null,
        //         'created_at' => $start2->copy()->addMinutes(5),
        //         'updated_at' => $start2->copy()->addMinutes(5),
        //     ],
        // ]);
    }
}
