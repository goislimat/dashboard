<?php

use Illuminate\Database\Seeder;

use Dashboard\Entities\User;
use Dashboard\Entities\Project;

class ProjectsMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects_members')->truncate();
        
        for($i = 0; $i < 20; $i++)
        {
            $user = User::all()->random();
            $user->jobs()->attach(Project::all()->random()->id);
        }
    }
}
