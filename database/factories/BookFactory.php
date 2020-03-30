<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'author' => $faker->userName,
        'description' => $faker->text,
        'featured' => $faker->boolean,
        //'image' => $faker->image('public/storage/images',640,480, null, false),
        'category_id' => factory(\App\Category::class)->create()
    ];
});
