<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package Muan\Admin\Models
 */
class Post extends Model
{

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

}
