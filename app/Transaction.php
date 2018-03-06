<?php

namespace Wallet;

use Illuminate\Database\Eloquent\Model;
use Wallet\Support\UuidIdentifier;

class Transaction extends Model
{
    use UuidIdentifier;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'wallet', 'date', 'value'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'float',
    ];
}
