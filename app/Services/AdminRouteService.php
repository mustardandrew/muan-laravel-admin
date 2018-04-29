<?php

namespace Muan\Admin\Services;

use Illuminate\Support\Facades\Route;

/**
 * Class AdminRouteService
 *
 * @package Muan\Admin\Services
 */
class AdminRouteService
{

    //protected $namespace = 'Muan\Admin\Http\Controllers\Admin';

    /**
     * Prefix for admin panel
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function prefix()
    {
        return config('admin.slug', 'admin');
    }

    /**
     * Admin wrapper
     *
     * @param \Closure $closure
     */
    public function routes(\Closure $closure)
    {
        Route::prefix('/' . $this->prefix())
            ->middleware('web')
            ->group($closure);
    }

    /**
     * Auth routes
     *
     * @param \Closure $closure
     */
    public function authRoutes(\Closure $closure)
    {
        $this->routes(function() use (&$closure) {
            Route::middleware('admin')->group($closure);
        });
    }

    /**
     * Api routes
     *
     * @param \Closure $closure
     */
    public function apiRoutes(\Closure $closure)
    {
        $this->authRoutes(function() use (&$closure) {
            Route::prefix('api')->group($closure);
        });
    }

}
