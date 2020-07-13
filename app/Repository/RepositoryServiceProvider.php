<?php

namespace App\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Interfaces\CatalogRepositoryInterface',
            'App\Repository\CatalogRepository'
        );

        $this->app->bind(
            'App\Repository\Interfaces\CartRepositoryInterface',
            'App\Repository\CartRepository'
        );
    }
}