<?php

namespace Muan\Admin\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * SlugScope
 *
 * @package Muan\Admin\Models\Scopes
 *
 * @method static Builder slug(string $slug)
 */
trait SlugScope
{
    /**
     * Find by slug
     *
     * @param Builder $builder
     * @param string $slug
     * @return Builder
     */
    public function scopeSlug(Builder $builder, string $slug) : Builder
    {
        return $builder->where('slug', $slug);
    }
}
