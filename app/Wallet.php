<?php

namespace Wallet;

use Wallet\Support\UuidModel;

class Wallet extends UuidModel
{
    protected $fillable = [
        'name', 'active', 'user'
    ];

    protected $casts = [
        'name' => 'string',
        'active' => 'boolean',
        'user' => 'string',
    ];
}
