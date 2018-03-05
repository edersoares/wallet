<?php

namespace Tests\Feature\Api;

use Tests\ApiTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Wallet\Transaction;

class TransactionTest extends TestCase
{
    use RefreshDatabase, ApiTestCase;

    /**
     * Return the model name.
     *
     * @return string
     */
    protected function model()
    {
        return Transaction::class;
    }
}
