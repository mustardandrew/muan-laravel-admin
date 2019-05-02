<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Muan\Admin\Models\Scopes\{
    SlugScope, ActiveScope
};
use Muan\Admin\Models\TargetSource\TargetSourceContract;
use Muan\Comments\Traits\Commentable;

/**
 * Class Page
 *
 * @package Muan\Admin\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property bool $is_active
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $meta_robots
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
     * @return BelongsTo
     */
    public function user() : BelongsTo
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
