<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreateGroupRequest, CreatePropertyRequest
};
use Muan\Admin\Models\{
    Group, Property
};

/**
 * Class SettingController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class SettingController extends Controller
{
    /**
     * Get settings list
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Group[]
     */
    public function index()
    {
        $list = Group::with('properties')->get();

        return $list;
    }

    /**
     * Create group
     *
     * @param CreateGroupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeGroup(CreateGroupRequest $request)
    {
        $group = Group::create($request->all());

        return response()->json([
            'message' => "Group with name '{$group->title}' created successfully!",
            'group' => $group->toArray(),
        ]);
    }

    /**
     * Create property
     *
     * @param CreatePropertyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeProperty(CreatePropertyRequest $request)
    {
        $data = $request->all();
        $data['value'] = $this->getDefaultValueByType($data['type']);

        $property = Property::create($data);

        return response()->json([
            'message' => "Property with name '{$property->title}' created successfully!",
            'property' => $property->toArray(),
        ]);
    }

    /**
     * Get default value by type
     *
     * @param string $type
     * @return string
     */
    protected function getDefaultValueByType(string $type) : string
    {
        $defaultValues = [
            'string' => '',
            'boolean' => '0',
            'integer' => '0',
            'text' => ''
        ];

        if (isset($defaultValues[$type])) {
            return $defaultValues[$type];
        }

        return '';
    }

    /**
     * Destroy group
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyGroup(Request $request)
    {
        $groupId = $request->id;

        $group = Group::findOrFail($groupId);
        Property::where('group_id', $groupId)->delete();
        $group->delete();

        return response()->json([
            'message' => "Group with name '{$group->title}' deleted successfully!",
            'group' => $group->toArray(),
        ]);
    }

    /**
     * Destroy property
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyProperty(Request $request)
    {
        $propertyId = $request->id;

        $property = Property::findOrFail($propertyId);
        $property->delete();

        return response()->json([
            'message' => "Property with name '{$property->title}' deleted successfully!",
            'property' => $property
        ]);
    }

    /**
     * Save all properties
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function saveAllProperties(Request $request)
    {
        $properties = $request->all();

        foreach ($properties as $slug => $value) {
            if ($property = Property::whereSlug($slug)->first()) {
                $property->value = $value;
                $property->save();
            }
        }

        return response()->json([
            'message' => 'All properties updated!',
        ]);
    }
}
