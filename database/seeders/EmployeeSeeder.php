<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'id' => 1122,
            'password' => Hash::make('123123'), // secret

        ]);

        DB::table('employees')->insert([
            'id' => 1133,
            'password' => Hash::make('456456'), // secret

        ]);
    }
}
