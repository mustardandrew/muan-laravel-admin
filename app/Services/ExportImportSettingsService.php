<?php

namespace Muan\Admin\Services;

use Muan\Admin\Models\{Group, Property};

/**
 * Class ExportImportSettingsService
 *
 * @package Muan\Admin\Services
 */
class ExportImportSettingsService
{

    /**
     * Export settings
     *
     * @return array
     */
    public function export() : array
    {
        $groups = Group::with('properties')->get();

        $data = [];

        foreach ($groups as $group) {
            $groupItem = &$data[];

            $groupItem = [
                'slug' => $group->slug,
                'title' => $group->title,
                'description' => $group->description,
                'properties' => [],
            ];

            foreach($group->properties as $property) {
                $propertyItem = &$groupItem['properties'][];

                $propertyItem = [
                    'slug' => $property->slug,
                    'title' => $property->title,
                    'type' => $property->type,
                    'description' => $property->description,
                    'value' => $property->value,
                ];
            }
        }

        return $data;
    }

    /**
     * Import setting
     *
     * @param array $data
     */
    public function import(array $data)
    {
        foreach ($data as &$groupItem) {
            $groupItem = (array) $groupItem;

            if (! $group = Group::slug($groupItem['slug'])->first()) {
                $group = Group::create($groupItem);
            }

            if (! isset($groupItem['properties'])) {
                continue;
            }

            foreach ($groupItem['properties'] as &$propertyItem) {
                $propertyItem = (array) $propertyItem;

                if (! Property::slug($propertyItem['slug'])->first()) {
                    $group->properties()->create($propertyItem);
                }
            }
        }
    }
}
