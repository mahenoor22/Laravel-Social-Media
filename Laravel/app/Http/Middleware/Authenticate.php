<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
        if ($request->expectsJson()) {
            return response('Unauthorized.', 401);
        }
        else {
            return redirect()->route('home');
        }
        }

    return $next($request);
    }
}
