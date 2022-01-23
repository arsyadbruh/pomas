<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'Website SISFO with Laravel',
            'description' => 'Project membangun website dengan menggunakan framework laravel'
        ]);

        DB::table('projects')->insert([
            'name' => 'Mobile Apps with React Native',
            'description' => 'Project membangun aplikasi mobile dengan react native',
        ]);

        DB::table('projects')->insert([
            'name' => 'Pembuatan Pembangkit Listrik Tenaga',
            'description' => 'Project membangun sebuah pembangkit listrik ramah lingkungan',
        ]);
    }
}
