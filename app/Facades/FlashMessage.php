<?php

namespace Muan\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use Muan\Admin\Services\FlashMessageService;

/**
 * Class FlashMessage
 *
 * @package Muan\Admin\Facades
 */
class FlashMessage extends Facade
{

    /**
    * Get the binding in the IoC container
    *
    * @return string
    */
    protected static function getFacadeAccessor()
    {
        return FlashMessageService::class;
    }

}
