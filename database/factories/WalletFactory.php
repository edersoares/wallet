<?php

use Faker\Generator as Faker;

$factory->define(Wallet\Wallet::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'active' => $faker->boolean,
        'user_uuid' => factory(Wallet\User::class)->create()->getKey(),
    ];
});
