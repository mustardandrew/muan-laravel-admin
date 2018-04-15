<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Acl\Models\{
    Permission, Role
};
use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreateUserRequest, UpdateUserRequest
};
use Muan\Admin\Services\UploadService;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return config('auth.providers.users.model');
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
                'title'  => 'ID',
                'field'  => 'string-field',
                'style'  => 'width: 5%',
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
            'email' => [
                'title' => 'Email',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Email',
                ],
            ],
            'roles' => [
                'title' => 'Roles',
                'field'  => 'string-field',
                'filter' => [
                    'type' => 'select-filter',
                    'options' => Role::all()->mapWithKeys(function ($role) {
                        return [$role->id => ucfirst($role->name)];
                    })->toArray(),
                ],
            ],
            'created_at' => [
                'title' => 'Registration At',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Date',
                ],
            ],
        ];
    }

    /**
     * Prepare query
     *
     * @param $query
     * @return mixed
     */
    protected function prepareQuery($query)
    {
        return $query->with('roles');
    }

    /**
     * Prepare item before print
     *
     * @param array $item
     * @return array
     */
    protected function prepareItem(array $item): array
    {
        foreach ($item['roles'] as &$role) {
            $role = $role['name'];
        }
        $item['roles'] = implode(', ', $item['roles']);

        return $item;
    }

    /**
     * Make custom filter
     *
     * @param $builder
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    protected function customFilter($builder, $field, $value): bool
    {
        if ($field === 'roles') {
            $builder->whereHas('roles', function ($query) use ($value) {
                $query->where('id', $value);
            });
            return true;
        }

        return false;
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
                'route' => route('admin.users.create'),
            ],
            'entity' => [
                [
                    'title' => 'Profile',
                    'route' => route('admin.users.profile', ['id' => '[id]']),
                    'icon'  => 'fas fa-eye',
                    'style' => 'background-color: #598ed4',
                ],
                [
                    'title' => 'Edit',
                    'route' => route('admin.users.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Permissions',
                    'route' => route('admin.users.permissions', ['id' => '[id]']),
                    'icon'  => 'fas fa-key',
                    'style' => 'background-color: #E87E04',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.users.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create user form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin::admin.pages.users.create', compact('roles'));
    }

    /**
     * Create user
     *
     * @param CreateUserRequest $request
     * @param UploadService $uploadService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request, UploadService $uploadService)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = $this->resolveEntity()->create($data);

        // Additional fields
        $user->sex = $request->sex;
        $user->birthday = $request->birthday;
        $user->about = $request->about;

        $user->save();

        // Sync roles
        if (! empty($request->roles)) {
            $user->roles()->sync($request->roles);
        }

        // Upload image
        if ($request->hasFile('image')) {
            $uploadFile = $request->file('image');
            $user->avatar = $uploadService->upload($uploadFile, 'avatars', config('admin.resize.user'));
            $user->save();
        }

        FlashMessage::notice("User with name '{$user->name}' created successfully!");
        return redirect()->route('admin.users');
    }

    /**
     * Edit user
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->resolveEntity()->firstOrFail();
        $roles = Role::all();

        return view('admin::admin.pages.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user
     *
     * @param UpdateUserRequest $request
     * @param UploadService $uploadService
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, UploadService $uploadService, $id)
    {
        $user = $this->resolveEntity()->findOrFail($id);

        $data = $request->all();
        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        // Aditional fields
        $user->sex = $request->sex;
        $user->birthday = $request->birthday;
        $user->about = $request->about;

        $user->save();

        // Sync roles
        $user->roles()->sync($request->roles);

        // Upload image
        if ($request->hasFile('image')) {
            $oldFileName = $user->avatar;
            $uploadFile = $request->file('image');
            $user->avatar = $uploadService->upload($uploadFile, 'avatars', config('admin.resize.user'));
            $user->save();
            if ($oldFileName) {
                $uploadService->remove($oldFileName);
            }
        }

        FlashMessage::notice("User with name '{$user->name}' updated successfully!");
        return redirect()->route('admin.users.edit', ['id' => $user->id]);
    }

    /**
     * Delete user
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $user = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.users.delete', compact('user'));
    }

    /**
     * Destroy user
     *
     * @param UploadService $uploadService
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UploadService $uploadService, $id)
    {
        $user = $this->resolveEntity()->findOrFail($id);
        $fileName = $user->avatar;
        $user->delete();

        if ($fileName) {
            $uploadService->remove($fileName);
        }

        FlashMessage::notice("User with name '{$user->name}' deleted successfully!");
        return redirect()->route('admin.users');
    }

    /**
     * Show profile
     *
     * @param int|null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile($id = null)
    {
        $user = $id
            ? $this->resolveEntity()->findOrFail($id)
            : auth()->user();
        return view('admin::admin.pages.users.profile', compact('user'));
    }

    /**
     * Form attached permissions
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permissions($id)
    {
        $user = $this->resolveEntity()->findOrFail($id);
        $permissions = Permission::all();
        return view('admin::admin.pages.users.permissions', compact('user', 'permissions'));
    }

    /**
     * Attach permissions
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach($id)
    {
        $user = $this->resolveEntity()->findOrFail($id);
        $user->permissions()->sync(request()->permissions);
        FlashMessage::notice("User with name '{$user->name}' attached permissions!");
        return redirect()->route('admin.users.permissions', ['id' => $id]);
    }

}
