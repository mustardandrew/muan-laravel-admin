<?php

namespace Muan\Admin\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * ActiveScope
 *
 * @package Muan\Admin\Models\Scopes
 */
trait ActiveScope
{

    /**
     * Published
     *
     * @param Builder $builder
     */
    public function scopeIsActive(Builder $builder)
    {
        $builder->where('active', true);
    }

    /**
     * Not published
     *
     * @param Builder $builder
     */
    public function scopeIsNotActive(Builder $builder)
    {
        $builder->where('active', false);
    }

}
