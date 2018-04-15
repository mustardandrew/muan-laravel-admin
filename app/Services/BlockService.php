<?php

namespace Muan\Admin\Services;

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
     * @var array
     */
    static protected $blocks = [];

    /**
     * Get value
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if (! isset(self::$blocks[$key])) {
            self::$blocks[$key] = $this->getBlock($key);
        }

        if (isset(self::$blocks[$key]) && self::$blocks[$key] instanceof Block) {
            return self::$blocks[$key]->value;
        }

        return self::$blocks[$key];
    }

    /**
     * Get block
     *
     * @param string $key
     * @return mixed
     */
    public function getBlock(string $key)
    {
        if (! empty(self::$blocks[$key])) {
            return self::$blocks[$key];
        }

        self::$blocks[$key] = Block::where('slug', $key)
            ->where('is_active', true)
            ->first();

        return self::$blocks[$key];
    }

}
