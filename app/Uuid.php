<?php

namespace Wallet;

use Webpatser\Uuid\Uuid as UuidGenerator;

trait Uuid
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
    public static function bootUuid()
    {
        self::creating(function ($model) {
            $model->uuid = (string) UuidGenerator::generate(4);
        });
    }
}
