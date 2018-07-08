<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Muan\Admin\Models\Scopes\SlugScope;

/**
 * Class Group
 *
 * @package Muan\Admin\Models
 */
class Group extends Model
{
    use SlugScope;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
    ];

    /**
     * Hidden for api
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
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
