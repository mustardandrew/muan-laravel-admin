<?php

namespace Muan\Admin\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * ActiveScope
 *
 * @package Muan\Admin\Models\Scopes
 *
 * @method static Builder isActive()
 * @method static Builder isNotActive()
 */
trait ActiveScope
{

    /**
     * Published
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsActive(Builder $builder) : Builder
    {
        return $builder->where('is_active', true);
    }

    /**
     * Not published
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsNotActive(Builder $builder) : Builder
    {
        return $builder->where('is_active', false);
    }

}
