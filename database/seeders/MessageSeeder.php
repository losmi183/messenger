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
        // Prvi razgovor (user 1 <-> user 2)
        $start1 = Carbon::now()->subMinutes(10);

        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'conversation_id' => 12,
                'message' => 'Šta ima Emile?',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start1->copy(),
                'updated_at' => $start1->copy(),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'conversation_id' => 12,
                'message' => 'Ništa posebno, odmaram. A ti?',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start1->copy()->addMinute(),
                'updated_at' => $start1->copy()->addMinute(),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'conversation_id' => 12,
                'message' => 'Hoćeš da cimamo nešto?.',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start1->copy()->addMinutes(2),
                'updated_at' => $start1->copy()->addMinutes(2),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'conversation_id' => 12,
                'message' => 'Može cimaj Nemca, ima dobru robu.',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start1->copy()->addMinutes(3),
                'updated_at' => $start1->copy()->addMinutes(3),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'conversation_id' => 12,
                'message' => 'Ajde pa javljam',
                'is_read' => 0,
                'seen' => null,
                'created_at' => $start1->copy()->addMinutes(4),
                'updated_at' => $start1->copy()->addMinutes(4),
            ],          
        ]);

        // Drugi razgovor (user 1 <-> user 1001)
        $start2 = Carbon::now()->subMinutes(60);

        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'receiver_id' => 1001,
                'conversation_id' => 13,
                'message' => 'Jel bi mogli da se vidimo?',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start2->copy(),
                'updated_at' => $start2->copy(),
            ],
            [
                'sender_id' => 1001,
                'receiver_id' => 1,
                'conversation_id' => 13,
                'message' => 'Ajde na Sodari za pola sata?',
                'is_read' => 1,
                'seen' => now(),
                'created_at' => $start2->copy()->addMinute(),
                'updated_at' => $start2->copy()->addMinute(),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 1001,
                'conversation_id' => 13,
                'message' => 'Važi cimam kad sam tu.',
                'is_read' => 1,
                'seen' => null,
                'created_at' => $start2->copy()->addMinutes(2),
                'updated_at' => $start2->copy()->addMinutes(2),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 1001,
                'conversation_id' => 13,
                'message' => 'Stigao?',
                'is_read' => 1,
                'seen' => null,
                'created_at' => $start2->copy()->addMinutes(3),
                'updated_at' => $start2->copy()->addMinutes(3),
            ],
            [
                'sender_id' => 1001,
                'receiver_id' => 1,
                'conversation_id' => 13,
                'message' => 'Važi izlazim.',
                'is_read' => 0,
                'seen' => null,
                'created_at' => $start2->copy()->addMinutes(5),
                'updated_at' => $start2->copy()->addMinutes(5),
            ],
        ]);
    }
}
