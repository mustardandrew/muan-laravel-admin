<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Muan\Admin\Models\Scopes\SlugScope;

/**
 * Class Property
 *
 * @package Muan\Admin\Models
 */
class Property extends Model
{
    use SlugScope;

    /**
     * @var array
     */
    protected $fillable = [
        'group_id',
        'slug',
        'title',
        'description',
        'type',
        'value',
    ];

    /**
     * Relation to group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
