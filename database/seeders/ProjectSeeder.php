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
            'name' => 'project pertama laravel',
            'description' => 'Project membangun website dengan menggunakan framework laravel',
            'owner_id' => 1
        ]);

        DB::table('projects')->insert([
            'name' => 'project react native',
            'description' => 'Project membangun aplikasi mobile dengan react native',
            'owner_id' => 1
        ]);
    }
}
