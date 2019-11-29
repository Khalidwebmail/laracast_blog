<?php

use App\User;
use Faker\Generator as Faker;

/**
 * User factory
 */
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->freeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(50)
    ];
});
