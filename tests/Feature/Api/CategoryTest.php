<?php

namespace Tests\Feature\Api;

use Tests\ApiTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Wallet\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase, ApiTestCase;

    /**
     * Return the model name.
     *
     * @return string
     */
    protected function model()
    {
        return Category::class;
    }
}
