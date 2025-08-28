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
                'message' => 'Ćao, šta se radi?',
                'is_read' => 1,
                'created_at' => $start1->copy(),
                'updated_at' => $start1->copy(),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'message' => 'Ništa posebno, odmaram. A ti?',
                'is_read' => 1,
                'created_at' => $start1->copy()->addMinute(),
                'updated_at' => $start1->copy()->addMinute(),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'message' => 'Isto tako, gledam neki film.',
                'is_read' => 1,
                'created_at' => $start1->copy()->addMinutes(2),
                'updated_at' => $start1->copy()->addMinutes(2),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'message' => 'Koji film gledaš?',
                'is_read' => 1,
                'created_at' => $start1->copy()->addMinutes(3),
                'updated_at' => $start1->copy()->addMinutes(3),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'message' => 'Neki akcioni, baš je dobar.',
                'is_read' => 0,
                'created_at' => $start1->copy()->addMinutes(4),
                'updated_at' => $start1->copy()->addMinutes(4),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'message' => 'Super, možda i ja pogledam kasnije.',
                'is_read' => 0,
                'created_at' => $start1->copy()->addMinutes(5),
                'updated_at' => $start1->copy()->addMinutes(5),
            ],
        ]);

        // Drugi razgovor (user 1 <-> user 3)
        $start2 = Carbon::now()->subMinutes(60);

        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'receiver_id' => 3,
                'message' => 'Hej, jesi slobodan večeras?',
                'is_read' => 1,
                'created_at' => $start2->copy(),
                'updated_at' => $start2->copy(),
            ],
            [
                'sender_id' => 3,
                'receiver_id' => 1,
                'message' => 'Ćao, da, što pitaš?',
                'is_read' => 1,
                'created_at' => $start2->copy()->addMinute(),
                'updated_at' => $start2->copy()->addMinute(),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 3,
                'message' => 'Razmišljam da izađemo na piće.',
                'is_read' => 1,
                'created_at' => $start2->copy()->addMinutes(2),
                'updated_at' => $start2->copy()->addMinutes(2),
            ],
            [
                'sender_id' => 3,
                'receiver_id' => 1,
                'message' => 'Može, gde si mislio?',
                'is_read' => 1,
                'created_at' => $start2->copy()->addMinutes(3),
                'updated_at' => $start2->copy()->addMinutes(3),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 3,
                'message' => 'Kod onog kafića u centru.',
                'is_read' => 0,
                'created_at' => $start2->copy()->addMinutes(4),
                'updated_at' => $start2->copy()->addMinutes(4),
            ],
            [
                'sender_id' => 3,
                'receiver_id' => 1,
                'message' => 'Dogovoreno, vidimo se kasnije!',
                'is_read' => 0,
                'created_at' => $start2->copy()->addMinutes(5),
                'updated_at' => $start2->copy()->addMinutes(5),
            ],
        ]);
    }
}
