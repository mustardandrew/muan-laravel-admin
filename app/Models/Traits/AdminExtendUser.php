<?php

namespace Muan\Admin\Models\Traits;

use Muan\Admin\Models\{
    Page, Category, Post
};

/**
 * AdminExtendUser
 *
 * @package Muan\Admin\Models\Traits
 */
trait AdminExtendUser
{

    /**
     * Relation to pages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Relation to posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
