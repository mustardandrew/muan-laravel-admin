<?php

namespace Muan\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use Muan\Admin\Services\BlockService;

/**
 * Class Blocks
 *
 * @package Muan\Admin\Facades
 */
class Blocks extends Facade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BlockService::class;
    }

}
