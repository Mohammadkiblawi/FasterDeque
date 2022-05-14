<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => "espresso"
        ]);
        DB::table('categories')->insert([
            'name' => "macchaito"
        ]);
        DB::table('categories')->insert([
            'name' => "mocha"
        ]);
        DB::table('categories')->insert([
            'name' => "latte"
        ]);
    }
}
