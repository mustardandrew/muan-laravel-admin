<?php

namespace Muan\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 *  Redirect to Auth If not Admin
 */
class RedirectToAuthIfNotAdmin
{
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
        if (! Auth::guard($guard)->check()) {
            return redirect()->route('admin.login');
        }

        if (! Auth::user()->hasRole('developer', 'admin')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
