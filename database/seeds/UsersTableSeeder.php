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
                
        factory(Dashboard\Entities\User::class)->create([
            'name' => 'teste',
            'email' => 'teste@email.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
        
        factory(Dashboard\Entities\User::class, 3)->create();
    }
}
