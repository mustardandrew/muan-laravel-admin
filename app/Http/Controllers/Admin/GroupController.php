<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreateGroupRequest, UpdateGroupRequest
};
use Muan\Admin\Models\{
    Group, Property
};

/**
 * Class GroupController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class GroupController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return Group::class;
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
            'title' => [
                'title' => 'Title',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Title',
                ],
            ],
            'description' => [
                'title' => 'Description',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by description',
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
                'route' => route('admin.groups.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.groups.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.groups.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create group
     *
     * @param CreateGroupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateGroupRequest $request)
    {
        $group = Group::create($request->all());
        FlashMessage::notice("Group with name '{$group->name}' created successfully!");
        return redirect()->route('admin.groups');
    }

    /**
     * Edit group
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('admin::admin.pages.groups.edit', compact('group'));
    }

    /**
     * Update group
     *
     * @param UpdateGroupRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGroupRequest $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->update($request->all());
        FlashMessage::notice("Group with name '{$group->name}' updated successfully!");
        return redirect()->route('admin.groups.edit', ['id' => $group->id]);
    }

    /**
     * Delete group
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $group = Group::findOrFail($id);
        $groups = Group::where('id', '!=', $id)->get();
        return view('admin::admin.pages.groups.delete', compact('group', 'groups'));
    }

    /**
     * Destroy group
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        Property::where('group_id', $id)->update(['group_id' => $request->group_id]);
        $group->delete();
        FlashMessage::notice("Group with name '{$group->name}' deleted successfully!");
        return redirect()->route('admin.groups');
    }

}
