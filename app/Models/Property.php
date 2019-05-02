<?php

namespace Muan\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Muan\Admin\Models\Scopes\SlugScope;

/**
 * Class Property
 *
 * @package Muan\Admin\Models
 *
 * @property int $id
 * @property int $group_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $value
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
     * @return BelongsTo
     */
    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

}
