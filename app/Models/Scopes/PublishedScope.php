<?php

namespace Muan\Admin\Models\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * PublishedScope
 *
 * @package Muan\Admin\Models\Scopes
 *
 * @method static Builder published()
 * @method static Builder notPublished()
 */
trait PublishedScope
{

    /**
     * Published
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopePublished(Builder $builder) : Builder
    {
        return $builder->where('is_active', true)->where(function(Builder $query) {
            $query->whereNull('published_at');
            $query->orWhere('published_at', '<=', new Carbon('now'));
        });
    }

    /**
     * Not published
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeNotPublished(Builder $builder) : Builder
    {
        return $builder->where('is_active', false)
            ->orWhere('published_at', '>=', new Carbon('now'));
    }

}
