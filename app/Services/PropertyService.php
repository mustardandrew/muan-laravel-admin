<?php

namespace Muan\Admin\Services;

use Illuminate\Database\Eloquent\Collection;
use Muan\Admin\Models\{Property, Group};

/**
 * Class PropertyService
 *
 * @package Muan\Admin\Services
 */
class PropertyService
{
    /**
     * @var Collection|Group[]
     */
    static $groups;

    /**
     * @return Collection|Group[]
     */
    private function getGroups()
    {
        if (self::$groups === null) {
            self::$groups = Group::with('properties')->get();
        }

        return self::$groups;
    }

    /**
     * Get Property
     *
     * @param string $key
     * @return Property|null
     */
    private function getProperty(string $key)
    {
        if (! preg_match('~\.~', $key)) {
            return null;
        }

        list($groupKey, $propertyKey) = explode('.', $key, 2);

        if (! $group = $this->getGroup($groupKey)) {
            return null;
        }

        return $group->properties->filter(function (Property $property) use (&$propertyKey) {
            return $property->slug == $propertyKey;
        })->first();
    }

    /**
     * Get Group
     *
     * @param string $key
     * @return Group|null
     */
    private function getGroup(string $key)
    {
        return $this->getGroups()->filter(function (Group $group) use (&$key) {
            return $group->slug == $key;
        })->first();
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
        if (! $property = $this->getProperty($key)) {
            return $default;
        }

        return $property->value;
    }

    /**
     * Get group properties
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

}
