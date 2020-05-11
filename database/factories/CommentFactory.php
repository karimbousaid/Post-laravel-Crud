<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Comment;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'post_id'=> function() {
            return  Post::all()->random();
        },
        'content' => $faker->sentence(),
    ];
});
