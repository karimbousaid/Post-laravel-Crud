<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [

    	'user_id'=> function() {
            return  User::all()->random();
        },
        'title' => $faker->title(),
        'content' => $faker->sentence(),
        'slug' => $faker->sentence(),
        'active' => $faker->boolean(),
    ];
});
