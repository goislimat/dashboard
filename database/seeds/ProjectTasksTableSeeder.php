<?php

use Illuminate\Database\Seeder;
use Dashboard\Entities\ProjectTask;

class ProjectTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectTask::truncate();
        
        factory(ProjectTask::class, 100)->create();
    }
}
