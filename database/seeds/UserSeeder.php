<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            ],
            [
            'name' => 'testuser',
            'username' => 'testuser',
            'password' => Hash::make('123456'),
            'role' => 'user',
            ],
            [
            'name' => 'testdev',
            'username' => 'testdev',
            'password' => Hash::make('123456'),
            'role' => 'developer',
            ],
        ]
    );
    }
}
