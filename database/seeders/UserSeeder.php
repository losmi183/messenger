<?php

namespace Database\Seeders;

use App\Enums\Role;
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
            'id' => 1,
            'name' => 'milos',
            'email' => 'milos@mail.com',
            'password' => Hash::make('milos'),
            'avatar' => '1.png',
            'role'=> Role::ADMIN->value
        ]);               
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'emil',
            'email' => 'emil@mail.com',
            'password' => Hash::make('emil'),
            'avatar' => '2.png'
        ]);               
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'simke',
            'email' => 'simke@mail.com',
            'password' => Hash::make('simke'),
            'avatar' => '3.png'
        ]);               
        DB::table('users')->insert([
            'id' => 4,
            'name' => 'lola',
            'email' => 'lola@mail.com',
            'password' => Hash::make('lola'),
            'avatar' => '4.png'
        ]);               
        DB::table('users')->insert([
            'id' => 5,
            'name' => 'vlada',
            'email' => 'vlada@mail.com',
            'password' => Hash::make('vlada'),
            'avatar' => '5.png'
        ]);               
        DB::table('users')->insert([
            'name' => 'beni',
            'email' => 'beni@mail.com',
            'password' => Hash::make('beni'),
        ]);               
        DB::table('users')->insert([
            'name' => 'milencuga',
            'email' => 'milencuga@mail.com',
            'password' => Hash::make('milencuga'),
        ]);               
        DB::table('users')->insert([
            'name' => 'djura',
            'email' => 'djura@mail.com',
            'password' => Hash::make('djura'),
        ]);       
        DB::table('users')->insert([
            'name' => 'edi',
            'email' => 'edi@mail.com',
            'password' => Hash::make('edi'),
        ]);      
        
        

        DB::table('users')->insert([
            'id' => 1001,
            'name' => 'nemac',
            'email' => 'nemac@mail.com',
            'password' => Hash::make('nemac'),
        ]); 
        DB::table('users')->insert([
            'id' => 1002,
            'name' => 'kinez',
            'email' => 'kinez@mail.com',
            'password' => Hash::make('kinez'),
        ]); 
        DB::table('users')->insert([
            'id' => 1003,
            'name' => 'lanmi',
            'email' => 'lanmi@mail.com',
            'password' => Hash::make('lanmi'),
        ]); 
        DB::table('users')->insert([
            'id' => 1004,
            'name' => 'boki',
            'email' => 'boki@mail.com',
            'password' => Hash::make('boki'),
        ]); 
    }
}
