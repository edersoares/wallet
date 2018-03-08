<?php

namespace Wallet;

use Illuminate\Database\Eloquent\Model;
use Wallet\Support\UuidIdentifier;

class Category extends Model
{
    use UuidIdentifier;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];
}
