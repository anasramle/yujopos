<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_first_login) {
            if (!$request->routeIs('password.force.update', 'logout')) {
                view()->share('forcePasswordChange', true);
            }
        }

        return $next($request);
    }
}
