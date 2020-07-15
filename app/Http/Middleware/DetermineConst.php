<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Constants\ConstantsValue;

class DetermineConst
{
    public function __construct() {}

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (request()->ip() == '31.173.26.137') {
            echo \App::getLocale() . '<br>';
        }

        $constants = ConstantsValue::where('lang', \App::getLocale())->with('constant')->get()->each(function ($item) {
            define($item->constant->name, $item->value);

            if (request()->ip() == '31.173.26.137') {
                echo $item->constant->name;
                echo '<br>';
                echo $item->value;
            }
        });

        if (request()->ip() == '31.173.26.137') {
            exit();
        }

        return $next($request);
    }
}
