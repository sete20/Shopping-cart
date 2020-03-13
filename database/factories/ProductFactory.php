<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(6),
        'price'=>$faker->numberBetween(50,300),
        'image'=>$faker->imageUrl($width = 640,$height=400,'technics'),

    ];
});
