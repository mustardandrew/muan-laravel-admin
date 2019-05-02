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
 *
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $value
 * @property bool $is_active
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
