<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{
    CreatePostRequest, UpdatePostRequest
};
use Muan\Admin\Models\Post;
use Muan\Admin\Services\UploadService;

/**
 * Class PostController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class PostController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return config('admin.entities.post.model');
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
            'published_at' => [
                'title' => 'Published At',
                'field' => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Date',
                ],
            ],
            'category' => [
                'title' => 'Category',
                'field'  => 'string-field',
                'sorted' => false,
                'filter' => [
                    'type' => 'select-filter',
                    'placeholder' => 'Category',
                    'options' => collect(['0' => 'No category'])->union(
                        app()->make(config('admin.entities.category.model'))->get()->mapWithKeys(function($category) {
                            return [$category->id => $category->title];
                        })
                    ),
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
            return $builder->where('category_id', $value);
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
                'route' => route('admin.posts.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.posts.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.posts.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = app()->make( config('admin.entities.category.model') )->get();
        return view('admin::admin.pages.posts.create', compact('categories'));
    }

    /**
     * Create post
     *
     * @param CreatePostRequest $request
     * @param UploadService $uploadService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $request, UploadService $uploadService)
    {
        /** @var Post $post */
        $post = $this->resolveEntity()->create($request->all());

        // Upload image
        if ($request->hasFile('image')) {
            $post->image = $uploadService->upload($request->file('image'), 'posts', config('admin.resize.post'));
            $post->save();
        }

        $post->tags()->sync($request->input('tags', []));

        FlashMessage::notice("Post with name '{$post->title}' created successfully!");
        return redirect()->route('admin.posts');
    }

    /**
     * Edit post
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = $this->resolveEntity()->findOrFail($id);
        $categories = app()->make( config('admin.entities.category.model') )->get();
        return view('admin::admin.pages.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update post
     *
     * @param UpdatePostRequest $request
     * @param UploadService $uploadService
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, UploadService $uploadService, $id)
    {
        $post = $this->resolveEntity()->findOrFail($id);
        $post->update($request->all());

        $post->tags()->sync($request->input('tags', []));

        // Upload image
        if ($request->hasFile('image')) {
            $oldFileName = $post->image;

            $post->image = $uploadService->upload($request->file('image'), 'posts', config('admin.resize.post'));
            $post->save();

            $oldFileName && $uploadService->remove($oldFileName);
        }

        FlashMessage::notice("Post with name '{$post->title}' updated successfully!");
        return redirect()->route('admin.posts.edit', ['id' => $post->id]);
    }

    /**
     * Delete post
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $post = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.posts.delete', compact('post'));
    }

    /**
     * Destroy post
     *
     * @param UploadService $uploadService
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UploadService $uploadService, $id)
    {
        $post = $this->resolveEntity()->findOrFail($id);
        $post->tags()->sync([]);
        $post->delete();

        $post->image && $uploadService->remove($post->image);

        FlashMessage::notice("Post with name '{$post->title}' deleted successfully!");
        return redirect()->route('admin.posts');
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
        $post = $this->resolveEntity()->findOrFail($id);

        if ($post->image) {
            $uploadService->remove($post->image);
            $post->image = "";
            $post->save();
        }

        return response()->json(['message' => 'Image removed successfully!']);
    }
}
