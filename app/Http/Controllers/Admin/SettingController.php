<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreateGroupRequest, CreatePropertyRequest, UpdateGroupRequest
};
use Muan\Admin\Models\{
    Group, Property
};
use Muan\Admin\Services\ExportImportSettingsService;
use Muan\Admin\Facades\FlashMessage;

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
     * Update group
     *
     * @param UpdateGroupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateGroup(UpdateGroupRequest $request)
    {
        $group = Group::with('properties')->findOrFail($request->get('id'));
        $group->update($request->all());

        return response()->json([
            'message' => "Group with name '{$group->title}' updated successfully!",
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
        $groupId = $request->get('id');

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
        $propertyId = $request->get('id');

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
    public function saveAllProperties(Request $request)
    {
        $properties = $request->all();

        foreach ($properties as $slug => $value) {
            if ($property = Property::whereSlug($slug)->first()) {
                $property->value = $value ? $value : $this->getDefaultValueByType($property->type);
                $property->save();
            }
        }

        return response()->json([
            'message' => 'All properties updated!',
        ]);
    }

    /**
     * Export settings
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function export()
    {
        $exportService = app()->make(ExportImportSettingsService::class);
        $data = $exportService->export();

        return response()->streamDownload(function () use (&$data) {
            echo json_encode($data);
        }, 'settings-config.json');
    }

    /**
     * Import config
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        if ($request->hasFile('config')) {
            $realPath = $request->file('config')->getRealPath();
            $data = json_decode(file_get_contents($realPath));

            $importService = app()->make(ExportImportSettingsService::class);
            $importService->import($data);
            FlashMessage::notice("Settings config imported successfully!");
        }

        return response()->redirectToRoute('admin.settings');
    }

}
