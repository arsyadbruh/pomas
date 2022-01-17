<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            'name' => "Belajar HTML",
            'status_test' => 1,
            'option_id' => 1
        ]);
        DB::table('tests')->insert([
            'name' => "Belajar PHP",
        ]);
        DB::table('tests')->insert([
            'name' => "Belajar Tailwind",
        ]);
    }
}
