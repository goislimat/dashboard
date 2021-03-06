<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dashboard\Entities\Client::truncate();
        factory(Dashboard\Entities\Client::class, 10)->create();
    }
}
