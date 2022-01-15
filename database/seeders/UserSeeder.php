<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'username' => 'beta',
            'email' => 'beta@pomas.com',
            'password' => bcrypt('pomas1234')
        ]);

        DB::table('users')->insert([
            'username' => 'alpha',
            'email' => 'alpha@pomas.com',
            'password' => bcrypt('pomas1234')
        ]);
    }
}
