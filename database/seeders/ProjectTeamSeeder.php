<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_teams')->insert([
            'project_id' => 1,
            'user_id' => 1,
            'role' => 'owner'
        ]);

        DB::table('project_teams')->insert([
            'project_id' => 2,
            'user_id' => 1,
            'role' => 'owner'
        ]);

        DB::table('project_teams')->insert([
            'project_id' => 1,
            'user_id' => 2,
            'role' => 'member'
        ]);
    }
}
