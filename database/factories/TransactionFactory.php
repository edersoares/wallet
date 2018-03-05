<?php

use Faker\Generator as Faker;

$factory->define(Wallet\Transaction::class, function (Faker $faker) {
    return [
        'user' => factory(Wallet\User::class)->create()->getKey(),
        'wallet' => function ($data) {
            return factory(Wallet\Wallet::class)->create([
                'user' => $data['user']
            ])->getKey();
        },
        'date' => $faker->date('Y-m-d'),
        'value' => $faker->randomFloat(2, 100, 10000),
    ];
});
