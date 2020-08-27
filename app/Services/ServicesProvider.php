<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerCatalogService();
    }

    private function registerCatalogService()
    {
        $this->app->bind('App\Services\CatalogService', function ($app) {
            return new CatalogService(request());
        });
    }
}