<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dashboard\Entities\User::truncate();
        factory(Dashboard\Entities\User::class, 3)->create();
    }
}
