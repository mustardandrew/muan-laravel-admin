<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 *
 * @package Muan\Admin\Models
 */
class Group extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
    ];

    /**
     * Relation to properties
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

}
