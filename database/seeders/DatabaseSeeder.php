<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            [
                'username' => 'john.doe',
                'email' => 'john.doe@example.net',
                'password'=> bcrypt(12345),
                'first_name' => 'John',
                'last_name' => 'Doe',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'richard.roe',
                'email' => 'richard.roe@example.net',
                'password'=> bcrypt(12345),
                'first_name' => 'Richard',
                'last_name' => 'Roe',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'jane.poe',
                'email' => 'jane.poe@example.net',
                'password'=> bcrypt(12345),
                'first_name' => 'Jane',
                'last_name' => 'Poe',
                'remember_token' => Str::random(10),
            ],
        ]);
    }
}
