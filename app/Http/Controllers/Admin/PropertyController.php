<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreatePropertyRequest, UpdatePropertyRequest
};
use Muan\Admin\Models\{
    Group, Property
};

/**
 * Class PropertyController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class PropertyController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return Property::class;
    }

    /**
     * Prepare query
     *
     * @param $query
     * @return mixed
     */
    protected function prepareQuery($query)
    {
        return $query->with('group');
    }

    /**
     * Prepare Item
     *
     * @param array $item
     * @return array
     */
    protected function prepareItem(array $item): array
    {
        $item['group'] = $item['group']['title'];

        return $item;
    }

    /**
     * @param $builder
     * @param $field
     * @param $value
     * @return bool
     */
    protected function customFilter($builder, $field, $value)
    {
        if ($field === 'group') {
            return $builder->where('group_id', $value);
        }

        return false;
    }

    /**
     * Get columns
     *
     * @return array
     */
    protected function getColumns() : array
    {
        return [
            'id' => [
                'title' => 'ID',
                'field'  => 'string-field',
                'style' => 'width: 5%',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                ],
            ],
            'slug' => [
                'title' => 'Slug',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Title',
                ],
            ],
            'title' => [
                'title' => 'Title',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Title',
                ],
            ],
            'group' => [
                'title' => 'Group',
                'field'  => 'string-field',
                'sorted' => false,
                'filter' => [
                    'type' => 'select-filter',
                    'placeholder' => 'Filter by group',
                    'options' => collect(['0' => 'No group'])->union(Group::all()->mapWithKeys(function ($group) {
                        return ["{$group->id}" => $group->title];
                    })),
                ],
            ],
            'created_at' => [
                'title' => 'Created At',
                'field' => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Date',
                ],
            ],
            'updated_at' => [
                'title' => 'Updated At',
                'field' => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Date',
                ],
            ],
        ];
    }

    /**
     * Get actions
     *
     * @return array
     */
    protected function getActions(): array
    {
        return [
            'create' => [
                'title' => 'Create',
                'route' => route('admin.properties.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.properties.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.properties.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create property
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $groups = Group::all();
        return view('admin::admin.pages.properties.create', compact('groups'));
    }

    /**
     * Create property
     *
     * @param CreatePropertyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePropertyRequest $request)
    {
        $property = Property::create($request->all());
        FlashMessage::notice("Property with name '{$property->title}' created successfully!");
        return redirect()->route('admin.properties');
    }

    /**
     * Edit property
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $groups = Group::all();
        return view('admin::admin.pages.properties.edit', compact('property', 'groups'));
    }

    /**
     * Update property
     *
     * @param UpdatePropertyRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->update($request->all());
        FlashMessage::notice("Property with name '{$property->name}' updated successfully!");
        return redirect()->route('admin.properties.edit', ['id' => $property->id]);
    }

    /**
     * Delete property
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $property = Property::findOrFail($id);
        return view('admin::admin.pages.properties.delete', compact('property'));
    }

    /**
     * Destroy property
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        FlashMessage::notice("Property with name '{$property->name}' deleted successfully!");
        return redirect()->route('admin.properties');
    }

}
