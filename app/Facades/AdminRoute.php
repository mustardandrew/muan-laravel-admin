<?php

namespace Muan\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use Muan\Admin\Services\AdminRouteService;


/**
 * Class AdminRoute
 *
 * @package Muan\Admin\Facades
 */
class AdminRoute extends Facade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AdminRouteService::class;
    }

}
