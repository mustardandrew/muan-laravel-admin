<?php

namespace Muan\Admin\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * SlugScope
 *
 * @package Muan\Admin\Models\Scopes
 */
trait SlugScope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $slug
     * @return void
     */
    public function scopeSlug(Builder $builder, string $slug)
    {
        $builder->where('slug', $slug);
    }
}
