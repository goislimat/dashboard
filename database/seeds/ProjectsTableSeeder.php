<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dashboard\Entities\Project::truncate();
        factory(Dashboard\Entities\Project::class, 20)->create();
    }
}
