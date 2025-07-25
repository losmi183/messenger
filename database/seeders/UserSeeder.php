<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => Hash::make('Secret123#'),
        ]);               
        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@mail.com',
            'password' => Hash::make('Secret123#'),
        ]);               
        DB::table('users')->insert([
            'name' => 'user3',
            'email' => 'user3@mail.com',
            'password' => Hash::make('Secret123#'),
        ]);               
        DB::table('users')->insert([
            'name' => 'user4',
            'email' => 'user4@mail.com',
            'password' => Hash::make('Secret123#'),
        ]);               
    }
}
