<?php

namespace App\Utils\Facades\Catalog;

use Illuminate\Support\Facades\Facade;

class CatalogCrudFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'catalogCrud';
    }
}