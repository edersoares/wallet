<?php

namespace Wallet\Http\Controllers\Api;

use Wallet\Category;
use Wallet\Http\Controllers\ApiController;

class CategoryController extends ApiController
{
    /**
     * Return the model name.
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }
}
