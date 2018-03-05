<?php

namespace Wallet\Http\Controllers\Api;

use Wallet\Http\Controllers\ApiController;
use Wallet\Transaction;

class TransactionController extends ApiController
{
    /**
     * Return the model name.
     *
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }
}
