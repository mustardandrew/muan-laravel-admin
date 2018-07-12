<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Muan\Admin\Models\Scopes\{
    SlugScope, ActiveScope
};
use Muan\Comments\Traits\Commentable;

/**
 * Class Block
 *
 * @package Muan\Admin\Models
 */
class Block extends Model
{
    use SlugScope, ActiveScope, Commentable;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'value',
        'is_active',
    ];

}
