<?php

use App\Channel;
use App\Reply;
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

/**
 * Thread factory
 */
$factory->define(Thread::class, function (Faker $faker) {
    $sentence = $faker->sentence;
    return [
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'channel_id' => function(){
            return factory(App\Channel::class)->create()->id;
        },
        'title' => $sentence,
        'slug'  => str_slug($sentence),
        'body' => $faker->paragraph,
    ];
});

/**
 * Reply factory
 */
$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'thread_id' => function(){
            return factory(App\Thread::class)->create()->id;
        },
        'body' => $faker->paragraph,
    ];
});

/**
 * Channel
 */
$factory->define(Channel::class, function (Faker $faker) {

    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => str_slug($name)
    ];
});