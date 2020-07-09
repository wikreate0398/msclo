<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Container;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        \View::share( 'lang', lang());
//        \View::share( 'page_data', \Pages::pageData());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }
}
