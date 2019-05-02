<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Muan\Tags\Traits\Taggable;
use Illuminate\Database\Eloquent\Model;
use Muan\Admin\Models\Scopes\{SlugScope, PublishedScope, ActiveScope};
use Muan\Admin\Models\TargetSource\TargetSourceContract;
use Muan\Comments\Traits\Commentable;

/**
 * Class Post
 *
 * @package Muan\Admin\Models
 *
 * @property int $id
 * @property int $category_id
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
class Post extends Model implements TargetSourceContract
{
    use SlugScope, PublishedScope, ActiveScope, Commentable, Taggable;

    /**
     * @var array
     */
    protected $fillable = [
        'category_id',
        'user_id',
        'slug',
        'title',
        'description',
        'is_active',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime'
    ];

    /**
     * Relation to category
     *
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

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
        return route('admin.posts.edit', ['id' => $this->id]);
    }

}
