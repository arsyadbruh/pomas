<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestOptioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_options')->insert([
            'name' => "Arsyad",
        ]);
        DB::table('test_options')->insert([
            'name' => "Yusa",
        ]);
        DB::table('test_options')->insert([
            'name' => "Naufal",
        ]);
    }
}
