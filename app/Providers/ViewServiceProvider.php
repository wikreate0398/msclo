<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['layouts.public', 'public.*', 'profile.*'],
            'App\Http\View\Composers\PublicComposer'
        );

        View::composer('profile.layout', 'App\Http\View\Composers\ProfileComposer');
    }
}
