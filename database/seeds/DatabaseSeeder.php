<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('set foreign_key_checks = 0');
        
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(ProjectNotesTableSeeder::class);
        $this->call(ProjectsMembersTableSeeder::class);
        $this->call(OAuthClientTableSeeder::class);
        
        DB::statement('set foreign_key_checks = 1');
    }
}
