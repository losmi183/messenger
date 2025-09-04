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
            'name' => 'milos',
            'email' => 'milos@mail.com',
            'password' => Hash::make('milos'),
        ]);               
        DB::table('users')->insert([
            'name' => 'nesa',
            'email' => 'nesa@mail.com',
            'password' => Hash::make('nesa'),
        ]);               
        DB::table('users')->insert([
            'name' => 'deki',
            'email' => 'deki@mail.com',
            'password' => Hash::make('deki'),
        ]);               
        DB::table('users')->insert([
            'name' => 'dusan',
            'email' => 'dusan@mail.com',
            'password' => Hash::make('dusan'),
        ]);               
    }
}
