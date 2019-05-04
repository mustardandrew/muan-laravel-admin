<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Http\Requests\{CreateTagRequest, UpdateTagRequest};
use Muan\Admin\Http\Resources\TagResource;
use Muan\Admin\Services\TagService;

/**
 * Class RoleController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class TagController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return config('admin.entities.tag.model');
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
            'slug' => [
                'title' => 'Slug',
                'field'  => 'string-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Filter by Slug',
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
                'route' => route('admin.tags.create'),
            ],
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.tags.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.tags.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Create tag
     *
     * @param CreateTagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTagRequest $request)
    {
        $tag = $this->resolveEntity()->create($request->all());
        FlashMessage::notice("Tag '{$tag->title}' created successfully!");
        return redirect()->route('admin.tags');
    }

    /**
     * Edit tag
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.tags.edit', compact('tag'));
    }

    /**
     * Update block
     *
     * @param UpdateTagRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTagRequest $request, $id)
    {
        $tag = $this->resolveEntity()->findOrFail($id);
        $tag->update($request->all());
        FlashMessage::notice("Tag '{$tag->name}' updated successfully!");
        return redirect()->route('admin.tags.edit', ['id' => $tag->id]);
    }

    /**
     * Delete tag
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $tag = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.tags.delete', compact('tag'));
    }

    /**
     * Destroy tag
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tag = $this->resolveEntity()->findOrFail($id);
        $tag->delete();
        FlashMessage::notice("Block with name '{$tag->title}' deleted successfully!");
        return redirect()->route('admin.tags');
    }

    /**
     * Return tags
     *
     * @param Request $request
     * @param TagService $tagService
     * @return JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function multiSelect(Request $request, TagService $tagService)
    {
        $query = trim($request->input('q', ''));

        if (empty($query)) {
            return new JsonResponse([]);
        }

        $tags = $tagService->findTags($query);

        return TagResource::collection($tags);
    }

}
