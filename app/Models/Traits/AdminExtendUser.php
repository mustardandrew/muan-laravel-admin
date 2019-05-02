<?php

namespace Muan\Admin\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Muan\Admin\Models\{Page, Post};

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
     * @return HasMany
     */
    public function pages() : HasMany
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Relation to posts
     *
     * @return HasMany
     */
    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

}
