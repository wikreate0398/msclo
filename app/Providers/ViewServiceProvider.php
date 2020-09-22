<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Menu;
use App\Repository\Interfaces\CatalogRepositoryInterface;
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
    public function boot(CatalogRepositoryInterface $repository)
    {
        View::composer(
            ['layouts.public', 'public.*', 'profile.*'], 'App\Http\View\Composers\PublicComposer'
        );

        View::composer(['profile.dashboard_layout'], function ($view) use($repository) {
            $view->with([
                'productsNumber' => 123123213123,
                'ordersNumber'   => 122,
            ]);
        });
    }
}