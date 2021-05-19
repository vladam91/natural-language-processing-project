<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserBannedMiddleware
{
    /**
     * Proverava da li je korsinik banovan
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->isBanned()) {
            return $next($request);
        }

        return redirect('/banned');
    }
}
