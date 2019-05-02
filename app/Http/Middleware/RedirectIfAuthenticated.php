<?php

namespace Muan\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

/**
 * Class RedirectIfAuthenticated
 *
 * @package Muan\Admin\Http\Middleware
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->hasRole('developer', 'admin')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
