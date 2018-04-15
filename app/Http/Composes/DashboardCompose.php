<?php

namespace Muan\Admin\Http\Composes;

use Illuminate\View\View;
use Muan\Admin\Models\{
    Category, Post, Block, Page
};

/**
 * Class DashboardCompose
 *
 * @package Muan\Admin\Http\Composes
 */
class DashboardCompose
{

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $countUsers = app()->make(config('auth.providers.users.model'))->count();
        $countCategories = Category::count();
        $countPosts = Post::count();
        $countBlocks = Block::count();
        $countPages = Page::count();

        $view->with('countUsers', $countUsers);
        $view->with('countCategories', $countCategories);
        $view->with('countPosts', $countPosts);
        $view->with('countBlocks', $countBlocks);
        $view->with('countPages', $countPages);
    }

}

