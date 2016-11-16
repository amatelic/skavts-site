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

//Go to tinker and write factory("App\User")->create();
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => 'test',
        'email' => 'test@gmail.com',
        'rights' => 'ADMIN',
        'password' => bcrypt('test'),
        'remember_token' => str_random(10),
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'body' => $faker->text,
        'image_dir' => date('Y') . '/' . $title
    ];
});

$factory->define(App\Notification::class, function (Faker\Generator $faker) {
    return [
      'title' => $faker->sentence,
      'body' => $faker->text,
      'will_be' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
