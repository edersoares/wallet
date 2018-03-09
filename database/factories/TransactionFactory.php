<?php

use Faker\Generator as Faker;

$factory->define(Wallet\Transaction::class, function (Faker $faker) {
    return [
        'user_uuid' => factory(Wallet\User::class)->create()->getKey(),
        'wallet_uuid' => function ($data) {
            return factory(Wallet\Wallet::class)->create([
                'user_uuid' => $data['user_uuid']
            ])->getKey();
        },
        'category_uuid' => factory(Wallet\Category::class)->create()->getKey(),
        'date' => $faker->date('Y-m-d'),
        'value' => $faker->randomFloat(2, 100, 10000),
    ];
});
