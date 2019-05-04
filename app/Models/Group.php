<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Muan\Admin\Models\Scopes\SlugScope;

/**
 * Class Group
 *
 * @package Muan\Admin\Models
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $description
 *
 * @property Collection $properties
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
     * @return HasMany
     */
    public function properties() : HasMany
    {
        return $this->hasMany(Property::class);
    }

}
