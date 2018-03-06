<?php

namespace Wallet\Support;

use Webpatser\Uuid\Uuid;

trait UuidIdentifier
{
    /**
     * Check if the model needs to be booted and if so, do it.
     *
     * @see \Illuminate\Database\Eloquent\Model::bootIfNotBooted()
     *
     * @return void
     */
    protected function bootIfNotBooted()
    {
        parent::bootIfNotBooted();

        $this->primaryKey = 'uuid';
        $this->keyType = 'string';
        $this->incrementing = false;
    }

    /**
     * Boot UUID trait.
     *
     * @return void
     */
    public static function bootUuidIdentifier()
    {
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
