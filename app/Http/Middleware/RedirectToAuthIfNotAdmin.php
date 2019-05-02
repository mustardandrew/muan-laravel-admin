<?php

namespace Muan\Admin\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

/**
 *  Redirect to Auth If not Admin
 */
class RedirectToAuthIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
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
