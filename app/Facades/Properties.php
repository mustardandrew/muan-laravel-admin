<?php

namespace Muan\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use Muan\Admin\Services\PropertyService;

/**
 * Class Properties
 *
 * @package Muan\Admin\Facades
 */
class Properties extends Facade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PropertyService::class;
    }

}
