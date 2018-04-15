<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Block
 *
 * @package Muan\Admin\Models
 */
class Block extends Model
{

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
