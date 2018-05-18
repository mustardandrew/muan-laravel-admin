<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Muan\Admin\Models\Scopes\{
    SlugScope, ActiveScope
};

/**
 * Class Category
 *
 * @package Muan\Admin\Models
 */
class Category extends Model
{
    use SlugScope, ActiveScope;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'id');
    }

    /**
     * Relation to posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
