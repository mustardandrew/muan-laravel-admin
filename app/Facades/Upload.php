<?php

namespace Muan\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use Muan\Admin\Services\UploadService;

/**
 * Class Upload
 *
 * @package Muan\Admin\Facades
 */
class Upload extends Facade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UploadService::class;
    }

}
