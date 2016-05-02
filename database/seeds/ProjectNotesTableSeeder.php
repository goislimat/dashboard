<?php

use Illuminate\Database\Seeder;

class ProjectNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dashboard\Entities\ProjectNote::truncate();
        factory(Dashboard\Entities\ProjectNote::class, 100)->create();
    }
}
