<?php

namespace Muan\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Muan\Admin\Facades\FlashMessage;
use Muan\Admin\Http\DataTable\ExtendDataTableController;
use Muan\Admin\Http\Controllers\Controller;
use Muan\Admin\Models\TargetSource\TargetSourceContract;

/**
 * Class CommentController
 *
 * @package Muan\Admin\Http\Controllers\Admin
 */
class CommentController extends Controller
{
    use ExtendDataTableController;

    /**
     * Get entity class
     *
     * @return string
     */
    protected function entity(): string
    {
        return config('admin.entities.comment.model');
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
            'user' => [
                'title' => 'User',
                'field'  => 'anchor-field',
                'target' => '_blank'
            ],
            'comment' => [
                'title' => 'Comments',
                'field'  => 'string-field',
                'style' => 'width: 35%',
                'sorted' => true,
                'filter' => [
                    'type' => 'string-filter',
                    'placeholder' => 'Comment',
                ],
            ],
            'source' => [
                'title' => 'Source',
                'field'  => 'source-field',
            ],
            'approved' => [
                'title' => 'Approved',
                'field'  => 'active-field',
                'sorted' => true,
                'filter' => [
                    'type' => 'select-filter',
                    'placeholder' => 'Is Approved',
                    'options' => [
                        0 => 'No',
                        1 => 'Yes',
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
        return $query->with('user')->with('commentable');
    }

    /**
     * Prepare model
     *
     * @param $model
     * @return string
     */
    public function prepareModel($model)
    {
        if ($model->commentable instanceof TargetSourceContract) {
            $model->source = $model->commentable->getTargetSource();
        }

        return '';
    }

    /**
     * Prepare item
     *
     * @param array $item
     * @return array
     */
    protected function prepareItem(array $item): array
    {
        $item['user'] = [
            'link' => route('admin.users.profile', ['id' => $item['user']['id']]),
            'text' => $item['user']['name'],
        ];

        return $item;
    }

    /**
     * Get actions
     *
     * @return array
     */
    protected function getActions(): array
    {
        return [
            'entity' => [
                [
                    'title' => 'Edit',
                    'route' => route('admin.comments.edit', ['id' => '[id]']),
                    'icon'  => 'fas fa-pencil-alt',
                    'style' => 'background-color: #303a47',
                ],
                [
                    'title' => 'Delete',
                    'route' => route('admin.comments.delete', ['id' => '[id]']),
                    'icon'  => 'fas fa-times',
                    'style' => 'background-color: #e43a45',
                ],
            ],
        ];
    }

    /**
     * Edit comment
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $comment = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.comments.edit', compact('comment'));
    }

    /**
     * Update comment
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $comment = $this->resolveEntity()->findOrFail($id);
        $comment->update([
            'comment'  => $request->get('comment'),
            'approved' => $request->get('approved'),
        ]);
        FlashMessage::notice("Comment with id '{$comment->id}' updated successfully!");
        return redirect()->route('admin.comments.edit', ['id' => $comment->id]);
    }

    /**
     * Delete comment
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $comment = $this->resolveEntity()->findOrFail($id);
        return view('admin::admin.pages.comments.delete', compact('comment'));
    }

    /**
     * Destroy comment
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $comment = $this->resolveEntity()->findOrFail($id);
        $comment->delete();
        FlashMessage::notice("Comment with id '{$comment->id}' deleted successfully!");
        return redirect()->route('admin.comments');
    }

}
