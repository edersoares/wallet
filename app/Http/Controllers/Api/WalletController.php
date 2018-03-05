<?php

namespace Wallet\Http\Controllers\Api;

use Wallet\Http\Controllers\ApiController;
use Wallet\Wallet;

class WalletController extends ApiController
{
    /**
     * Return the model name.
     *
     * @return string
     */
    public function model()
    {
        return Wallet::class;
    }
}
