<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreateCategoryRequest, UpdateCategoryRequest
};
use Muan\Admin\Services\UploadService;

/**
 * Class CategoryController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return config('admin.entities.category.model');
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
            'category' => [
                'title' => 'Parent',
                'field'  => 'string-field',
                'sorted' => false,
                'filter' => [
                    'type' => 'select-filter',
                    'placeholder' => 'Parent Category',
                    'options' => $this->resolveEntity()->where('parent_category_id', 0)->get()->mapWithKeys(function($category) {
                        return [$category->id => $category->title];
                    }),
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
        return $query->with('category');
    }

    /**
     * Prepare item
     *
     * @param array $item
     * @return array
     */
    protected function prepareItem(array $item): array
    {
        $item['category'] = isset($item['category']) ? $item['category']['title'] : '';

        return $item;
    }

    /**
     * Custom filter
     *
     * @param $builder
     * @param $field
     * @param $value
     * @return bool
     */
    protected function customFilter($builder, $field, $value)
    {
        if ($field == 'category') {
            return $builder->whereHas('category', function ($query) use (&$value) {
                $query->where('id', $value);
            });
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
                'route' => route('admin.categories.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.categories.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.categories.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->resolveEntity()->get();
        return view('admin::admin.pages.categories.create', compact('categories'));
    }

    /**
     * Create category
     *
     * @param CreateCategoryRequest $request
     * @param UploadService $uploadService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request, UploadService $uploadService)
    {
        $category = $this->resolveEntity()->create($request->all());

        // Upload image
        if ($request->hasFile('image')) {
            $category->image = $uploadService->upload($request->file('image'), 'categories', config('admin.resize.category'));
            $category->save();
        }

        FlashMessage::notice("Category with name '{$category->title}' created successfully!");
        return redirect()->route('admin.categories');
    }

    /**
     * Edit category
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->resolveEntity()->findOrFail($id);
        $categories = $this->resolveEntity()->where('id', '!=', $id)->get();
        return view('admin::admin.pages.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update category
     *
     * @param UpdateCategoryRequest $request
     * @param UploadService $uploadService
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, UploadService $uploadService, $id)
    {
        $category = $this->resolveEntity()->findOrFail($id);
        $category->update($request->all());

        // Upload image
        if ($request->hasFile('image')) {
            $oldFileName = $category->image;

            $category->image = $uploadService->upload($request->file('image'), 'categories', config('admin.resize.category'));
            $category->save();

            if ($oldFileName) {
                $uploadService->remove($oldFileName);
            }
        }

        FlashMessage::notice("Category with name '{$category->title}' updated successfully!");
        return redirect()->route('admin.categories.edit', ['id' => $category->id]);
    }

    /**
     * Delete category
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $category = $this->resolveEntity()->findOrFail($id);
        $categories = $this->resolveEntity()->where('id', '!=', $id)->where('id', '!=', $category->parent_category_id)->get();
        return view('admin::admin.pages.categories.delete', compact('category', 'categories'));
    }

    /**
     * Destroy category
     *
     * @param UploadService $uploadService
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UploadService $uploadService, Request $request, $id)
    {
        $category = $this->resolveEntity()->findOrFail($id);

        // Update Posts
        app()->make(config('admin.entities.post.model'))
            ->where('category_id', $id)
            ->update(['category_id' => $request->get('category_id')]);

        // Update Categories
        $this->resolveEntity()->where('parent_category_id', $id)
            ->where('id', '!=', $request->get('category_id'))
            ->update(['parent_category_id' => $request->get('category_id')]);

        $category->delete();

        $category->image && $uploadService->remove($category->image);

        FlashMessage::notice("Category with name '{$category->title}' deleted successfully!");
        return redirect()->route('admin.categories');
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
        $category = $this->resolveEntity()->findOrFail($id);

        if ($category->image) {
            $uploadService->remove($category->image);
            $category->image = "";
            $category->save();
        }

        return response()->json(['message' => 'Image removed successfully!']);
    }
}
