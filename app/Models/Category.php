<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Muan\Admin\Models\Scopes\{
    SlugScope, ActiveScope
};
use Muan\Admin\Models\TargetSource\TargetSourceContract;
use Muan\Comments\Traits\Commentable;

/**
 * Class Category
 *
 * @package Muan\Admin\Models
 *
 * @property int $id
 * @property int $parent_category_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property bool $is_active
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $meta_robots
 */
class Category extends Model implements TargetSourceContract
{
    use SlugScope, ActiveScope, Commentable;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_category_id',
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
     * Relation to category
     *
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'id');
    }

    /**
     * Relation to posts
     *
     * @return HasMany
     */
    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get target source
     *
     * @return string
     */
    public function getTargetSource(): string
    {
        return route('admin.categories.edit', ['id' => $this->id]);
    }

}
