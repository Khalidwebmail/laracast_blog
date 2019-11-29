<?php

use App\Channel;
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

/*Thread factory*/
$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'channel_id' => function(){
            return factory(App\Channel::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});