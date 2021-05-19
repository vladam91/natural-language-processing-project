<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Proverava da li je korisnik Administrator
     *
     * Ukoliko jeste dozvoljava da zahtev prodje
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        return redirect('home');
    }
}
