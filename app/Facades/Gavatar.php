<?php

namespace Muan\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use Muan\Admin\Services\GavatarService;

/**
 * Class Gavatar
 *
 * @package Muan\Admin\Facades
 */
class Gavatar extends Facade
{

    /**
    * Get the binding in the IoC container
    *
    * @return string
    */
    protected static function getFacadeAccessor()
    {
        return GavatarService::class;
    }

}
