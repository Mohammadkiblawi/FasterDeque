<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'fname' => "ahmad",
            'lname' => "awji",
            'email' => "ahmad@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'dob' => '1998-12-11',
            'remember_token' => Str::random(10),

        ]);
        DB::table('users')->insert([
            'id' => 2,
            'fname' => "mohammad",
            'lname' => "kiblawi",
            'email' => "kiblawi@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'dob' => '1999-12-11',
            'remember_token' => Str::random(10),

        ]);
    }
}
