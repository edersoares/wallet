<?php

use Faker\Generator as Faker;

$factory->define(Wallet\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'active' => $faker->boolean,
    ];
});
