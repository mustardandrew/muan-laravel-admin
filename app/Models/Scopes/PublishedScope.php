<?php

namespace Muan\Admin\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * PublishedScope
 *
 * @package Muan\Admin\Models\Scopes
 */
trait PublishedScope
{

    /**
     * Published
     *
     * @param Builder $builder
     */
    public function scopePublished(Builder $builder)
    {
        $builder->where('active', true)->where(function($query) {
            $query->whereNull('posted_at');
            $query->orWhere('posted_at', '<=', new Carbon('now'));
        });
    }

    /**
     * Not published
     *
     * @param Builder $builder
     */
    public function scopeNotPublished(Builder $builder)
    {
        $builder->where('active', false)->orWhere('posted_at', '>=', new Carbon('now'));
    }

}
