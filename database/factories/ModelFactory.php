<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Dashboard\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Dashboard\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(Dashboard\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => Dashboard\Entities\User::all()->random()->id,
        'client_id' => Dashboard\Entities\Client::all()->random()->id,
        'name' => $faker->word,
        'description' => $faker->sentence(20, true),
        'progress' => $faker->numberBetween(0, 100),
        'status' => $faker->randomElement(array ('Projeto','Desenvolvimento','Produção')),
        'due_date' => $faker->date('Y-m-d'),
    ];
});

$factory->define(Dashboard\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => Dashboard\Entities\Project::all()->random()->id,
        'title' => $faker->word,
        'note' => $faker->paragraph,
    ];
});

$factory->define(Dashboard\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => Dashboard\Entities\Project::all()->random()->id,
        'name' => $faker->sentence(3, true),
        'start_date' => $faker->dateTimeBetween('-1 month', 'now'),
        'due_date' => $faker->dateTimeBetween('now', '+6 months'),
        'status' => $faker->randomElement(array('Registrada', 'Iniciada', 'Finalizada')),
    ];
});
