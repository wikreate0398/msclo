<?php

namespace App\Utils\Facades\Cart;

use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}