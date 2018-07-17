<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreateBlockRequest, UpdateBlockRequest
};

/**
 * Class RoleController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class BlockController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return config('admin.entities.block.model');
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
                    'placeholder' => 'Filter by Slug',
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
            'is_active' => [
                'title' => 'Is Active',
                'field'  => 'active-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'select-filter',
                    'placeholder' => 'Is Active',
                    'options' => [
                        0 => 'Not active',
                        1 => 'Active',
                    ],
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
                'route' => route('admin.blocks.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.blocks.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.blocks.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create block
     *
     * @param CreateBlockRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateBlockRequest $request)
    {
        $block = $this->resolveEntity()->create($request->all());
        FlashMessage::notice("Block with name '{$block->name}' created successfully!");
        return redirect()->route('admin.blocks');
    }

    /**
     * Edit block
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $block = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.blocks.edit', compact('block'));
    }

    /**
     * Update block
     *
     * @param UpdateBlockRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBlockRequest $request, $id)
    {
        $block = $this->resolveEntity()->findOrFail($id);
        $block->update($request->all());
        FlashMessage::notice("Block with name '{$block->name}' updated successfully!");
        return redirect()->route('admin.blocks.edit', ['id' => $block->id]);
    }

    /**
     * Delete block
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $block = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.blocks.delete', compact('block'));
    }

    /**
     * Destroy block
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $block = $this->resolveEntity()->findOrFail($id);
        $block->delete();
        FlashMessage::notice("Block with name '{$block->name}' deleted successfully!");
        return redirect()->route('admin.blocks');
    }

}
