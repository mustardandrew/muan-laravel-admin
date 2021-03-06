<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreatePageRequest, UpdatePageRequest
};
use Muan\Admin\Services\UploadService;

/**
 * Class PageController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class PageController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return config('admin.entities.page.model');
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
                'route' => route('admin.pages.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.pages.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.pages.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create page
     *
     * @param CreatePageRequest $request
     * @param UploadService $uploadService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePageRequest $request, UploadService $uploadService)
    {
        $page = $this->resolveEntity()->create($request->all());

        // Upload image
        if ($request->hasFile('image')) {
            $page->image = $uploadService->upload($request->file('image'), 'pages', config('admin.resize.page'));
            $page->save();
        }

        FlashMessage::notice("Page with name '{$page->title}' created successfully!");
        return redirect()->route('admin.pages');
    }

    /**
     * Edit page
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.pages.edit', compact('page'));
    }

    /**
     * Update page
     *
     * @param UpdatePageRequest $request
     * @param UploadService $uploadService
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePageRequest $request, UploadService $uploadService, $id)
    {
        $page = $this->resolveEntity()->findOrFail($id);

        $page->update($request->all());

        // Upload image
        if ($request->hasFile('image')) {
            $oldFileName = $page->image;

            $page->image = $uploadService->upload($request->file('image'), 'pages', config('admin.resize.page'));
            $page->save();

            $oldFileName && $uploadService->remove($oldFileName);
        }

        FlashMessage::notice("Page with name '{$page->title}' updated successfully!");
        return redirect()->route('admin.pages.edit', ['id' => $page->id]);
    }

    /**
     * Delete page
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $page = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.pages.delete', compact('page'));
    }

    /**
     * Destroy page
     *
     * @param UploadService $uploadService
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UploadService $uploadService, $id)
    {
        $page = $this->resolveEntity()->findOrFail($id);
        $page->delete();

        $page->image && $uploadService->remove($page->image);

        FlashMessage::notice("Page with name '{$page->title}' deleted successfully!");
        return redirect()->route('admin.pages');
    }

    /**
     * Remove image
     *
     * @param UploadService $uploadService
     * @param int $id
     * @return mixed
     */
    public function removeImage(UploadService $uploadService, $id)
    {
        $page = $this->resolveEntity()->findOrFail($id);

        if ($page->image) {
            $uploadService->remove($page->image);
            $page->image = "";
            $page->save();
        }

        return response()->json(['message' => 'Image removed successfully!']);
    }

}
