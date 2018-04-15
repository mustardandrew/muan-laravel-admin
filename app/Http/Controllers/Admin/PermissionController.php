<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Acl\Models\Permission;
use Muan\Admin\Http\Requests\CreatePermissionRequest;
use Muan\Admin\Http\Requests\UpdatePermissionRequest;

/**
 * Class PermissionController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class PermissionController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity
     *
     * @return string
     */
    protected function entity(): string
    {
        return Permission::class;
    }

    /**
     * Get columns
     *
     * @return array
     */
    protected function getColumns(): array
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
            'name' => [
                'title' => 'Name',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Name',
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
                'route' => route('admin.permissions.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.permissions.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.permissions.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
            'tools' => [
                [
                    'title' => 'Delete',
                    'route' => route('admin.permissions.m-destroy'),
                    'icon'  => 'fas fa-times',
                ],
            ],
        ];
    }

    /**
     * Create permission
     *
     * @param CreatePermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = Permission::create($request->all());
        FlashMessage::notice("Permission with name '{$permission->name}' created successfully!");
        return redirect()->route('admin.permissions');
    }

    /**
     * Edit permission
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin::admin.pages.permissions.edit', compact('permission'));
    }

    /**
     * Update permission
     *
     * @param UpdatePermissionRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        FlashMessage::notice("Permission with name '{$permission->name}' updated successfully!");
        return redirect()->route('admin.permissions.edit', ['id' => $permission->id]);
    }

    /**
     * Delete permission
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin::admin.pages.permissions.delete', compact('permission'));
    }

    /**
     * Destroy permission
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        FlashMessage::notice("Permission with name '{$permission->name}' deleted successfully!");
        return redirect()->route('admin.permissions');
    }

    /**
     * Multiply destroy
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function mDestroy()
    {
        Permission::whereIn('id', request()->ids)->delete();
        return response()->json([
            'level' => 'notice',
            'message' => "Permissions with ids [" . implode(', ', request()->ids) . "] deleted successfully!",
        ]);
    }

}
