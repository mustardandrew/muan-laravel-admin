<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Admin\Http\Controllers\Controller;

/**
 * Class FallbackController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class FallbackController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin::admin.errors.404', [], 404);
    }
}
