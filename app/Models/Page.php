<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Muan\Admin\Models\Scopes\{
    SlugScope, ActiveScope
};
use Muan\Admin\Models\TargetSource\TargetSourceContract;
use Muan\Comments\Traits\Commentable;

/**
 * Class Page
 *
 * @package Muan\Admin\Models
 */
class Page extends Model implements TargetSourceContract
{
    use SlugScope, ActiveScope, Commentable;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
    ];

    /**
     * Relation to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * Get target source
     *
     * @return string
     */
    public function getTargetSource(): string
    {
        return route('admin.pages.edit', ['id' => $this->id]);
    }

}
