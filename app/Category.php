<?php

namespace Wallet;

use Illuminate\Database\Eloquent\Model;
use Nix\Eloquent\Uuid\Uuid;

class Category extends Model
{
    use Uuid;

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
