<?php

namespace Wallet;

use Illuminate\Database\Eloquent\Model;
use Wallet\Support\UuidIdentifier;

class Wallet extends Model
{
    use UuidIdentifier;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active', 'user'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'active' => 'boolean',
        'user' => 'string',
    ];
}
