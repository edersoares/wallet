<?php

namespace Wallet;

use Illuminate\Database\Eloquent\Model;
use Nix\Eloquent\Uuid\Uuid;

class Wallet extends Model
{
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active', 'user_uuid'
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
