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
        return $builder->where('active', true)->where(function(Builder $query) {
            $query->whereNull('posted_at');
            $query->orWhere('posted_at', '<=', new Carbon('now'));
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
        return $builder->where('active', false)
            ->orWhere('posted_at', '>=', new Carbon('now'));
    }

}
