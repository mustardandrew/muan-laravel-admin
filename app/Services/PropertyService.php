<?php

namespace Muan\Admin\Services;

use Muan\Admin\Models\{
    Property, Group
};

/**
 * Class PropertyService
 *
 * @package Muan\Admin\Services
 */
class PropertyService
{

    /**
     * Properties
     *
     * @var array
     */
    static protected $properties = [];

    /**
     * Get types
     *
     * @return array
     */
    public function getTypes()
    {
        return [
            'string'  => 'String',
            'integer' => 'Integer',
            'text'    => 'Text',
        ];
    }

    /**
     * Get value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        if (! isset(self::$properties[$key])) {
            self::$properties[$key] = $this->getProperty($key);
        }

        if (isset(self::$properties[$key]) && self::$properties[$key] instanceof Property) {
            return self::$properties[$key]->value;
        }

        return self::$properties[$key] ? self::$properties[$key] : $default;
    }

    /**
     * Get grop properties
     *
     * @param string $key
     * @return array
     */
    public function group(string $key) : array
    {
        if (! $group = $this->getGroup($key)) {
            return [];
        }

        return $group->properties->mapWithKeys(function(Property $property) {
            return [$property->slug => $property->value];
        })->toArray();
    }

    /**
     * Get Property
     *
     * @param string $key
     * @return mixed
     */
    public function getProperty(string $key)
    {
        if (! empty(self::$properties[$key])) {
            return self::$properties[$key];
        }

        self::$properties[$key] = Property::where('slug', $key)
            ->first();

        return self::$properties[$key];
    }

    /**
     * Get Group
     *
     * @param string $key
     * @return Group|null
     */
    public function getGroup(string $key)
    {
        return Group::whereSlug($key)->first();
    }

}
