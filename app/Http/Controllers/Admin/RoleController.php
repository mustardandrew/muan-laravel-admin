<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Acl\Models\Permission;
use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Acl\Models\Role;
use Muan\Admin\Http\Requests\CreateRoleRequest;
use Muan\Admin\Http\Requests\UpdateRoleRequest;

/**
 * Class RoleController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class RoleController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return Role::class;
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
                'route' => route('admin.roles.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.roles.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Permissions',
                    'route' => route('admin.roles.permissions', ['id' => '[id]']),
                    'icon'  => 'fas fa-key',
                    'style' => 'background-color: #E87E04',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.roles.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create role
     *
     * @param CreateRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request)
    {
        $role = Role::create($request->all());
        FlashMessage::notice("Role with name '{$role->name}' created successfully!");
        return redirect()->route('admin.roles');
    }

    /**
     * Edit permission
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin::admin.pages.roles.edit', compact('role'));
    }

    /**
     * Update permission
     *
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        FlashMessage::notice("Role with name '{$role->name}' updated successfully!");
        return redirect()->route('admin.roles.edit', ['id' => $role->id]);
    }

    /**
     * Delete permission
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $role = Role::findOrFail($id);
        return view('admin::admin.pages.roles.delete', compact('role'));
    }

    /**
     * Destroy permission
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        FlashMessage::notice("Role with name '{$role->name}' deleted successfully!");
        return redirect()->route('admin.roles');
    }

    /**
     * Form attached permissions
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin::admin.pages.roles.permissions', compact('role', 'permissions'));
    }

    /**
     * Attach permissions
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach($id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->sync(request()->permissions);
        FlashMessage::notice("Role with name '{$role->name}' attached permissions!");
        return redirect()->route('admin.roles.permissions', ['id' => $id]);
    }

}
