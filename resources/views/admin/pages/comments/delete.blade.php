@extends('admin::admin.layouts.main')

@section('title', 'Delete Comment')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.comments') => 'Comments',
            '' => 'Delete Comment'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Comment</h1>

    <form class="form" action="{{ route('admin.comments.destroy', ['id' => $comment->id]) }}" method="POST">
        {{ csrf_field() }}

        <p>Are you sure want to destroy comment?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $comment->id }}</td>
                </tr>
                <tr>
                    <td><strong>User</strong></td>
                    <td>{{ $comment->user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Comment</strong></td>
                    <td>{{ $comment->comment }}</td>
                </tr>
                <tr>
                    <td><strong>Approved</strong></td>
                    <td>{{ $comment->approved ? 'Yes' : 'no' }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $comment->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $comment->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.comments') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
