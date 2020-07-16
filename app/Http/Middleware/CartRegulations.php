<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;

class CartRegulations
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!isAuth() or !cart()->has()) {
            return redirect()->route('view_cart', ['lang' => lang()]);
        }

        return $next($request);
    }
}
