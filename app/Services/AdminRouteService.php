<?php

namespace Muan\Admin\Services;

use Route;
use Closure;

/**
 * Class AdminRouteService
 *
 * @package Muan\Admin\Services
 */
class AdminRouteService
{

    /**
     * Prefix for admin panel
     *
     * @return string
     */
    public function prefix() : string
    {
        return config('admin.slug', 'admin');
    }

    /**
     * Admin wrapper
     *
     * @param Closure $closure
     */
    public function routes(Closure $closure)
    {
        Route::prefix('/' . $this->prefix())
            ->middleware('web')
            ->group($closure);
    }

    /**
     * Auth routes
     *
     * @param Closure $closure
     */
    public function authRoutes(Closure $closure)
    {
        $this->routes(function() use (&$closure) {
            Route::middleware('admin')->group($closure);
        });
    }

    /**
     * Api routes
     *
     * @param Closure $closure
     */
    public function apiRoutes(Closure $closure)
    {
        $this->authRoutes(function() use (&$closure) {
            Route::prefix('api')->group($closure);
        });
    }

}
