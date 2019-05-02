<?php

namespace Muan\Admin\Services;

use Illuminate\Database\Eloquent\Collection;
use Muan\Admin\Models\Block;

/**
 * Class BlockService
 *
 * @package Muan\Admin\Services
 */
class BlockService
{

    /**
     * Blocks
     *
     * @var Collection
     */
    static protected $blocks;

    /**
     * Get blocks
     *
     * @return Collection
     */
    private function getBlocks() : Collection
    {
        if (self::$blocks === null) {
            self::$blocks = Block::isActive()->get();
        }

        return self::$blocks;
    }

    /**
     * Get value
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if ($block = $this->getBlock($key)) {
            return $block->value;
        }

        return null;
    }

    /**
     * Get block
     *
     * @param string $key
     * @return mixed
     */
    public function getBlock(string $key)
    {
        return $this->getBlocks()->filter(function (Block $block) use ($key) {
            return $block->slug === $key;
        })->first();
    }

}
