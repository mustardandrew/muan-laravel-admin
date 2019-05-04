<?php

namespace Muan\Admin\Services;

use Illuminate\Database\Eloquent\Collection;
use Muan\Tags\Models\Tag;

/**
 * Class TagService
 *
 * @package Muan\Admin\Services
 */
class TagService
{

    /**
     * Find tags
     *
     * @param string $query
     * @param int $limit
     * @return Collection
     */
    public function findTags(string $query, int $limit = 10) : Collection
    {
        return Tag::where('title', 'like', "%{$query}%")
            ->limit($limit)
            ->orderByDesc('id')
            ->get();
    }

}
