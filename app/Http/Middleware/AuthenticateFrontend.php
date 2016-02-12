<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateFrontend
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

        if(!logged_in())
            return redirect()->to('login');

        return $next($request);
    }
}
