@extends('admin::admin.layouts.main')

@section('title', 'Delete Post')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.posts') => 'Posts',
            '' => 'Delete Post'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Post</h1>

    <form class="form" action="{{ route('admin.posts.destroy', ['id' => $post->id]) }}" method="POST">
        {{ csrf_field() }}

        <p>Are you sure want to destroy post?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $post->id }}</td>
                </tr>
                <tr>
                    <td><strong>Category</strong></td>
                    <td>
                        @isset ($post->category)
                            {{ $post->category->title }}
                        @endisset
                    </td>
                </tr>
                <tr>
                    <td><strong>User</strong></td>
                    <td>
                        @isset ($post->user)
                            {{ $post->user->name }}
                        @endisset
                    </td>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{{ $post->title }}</td>
                </tr>
                <tr>
                    <td><strong>Slug</strong></td>
                    <td>{{ $post->slug }}</td>
                </tr>
                <tr>
                    <td><strong>Is Active</strong></td>
                    <td>{{ $post->is_active ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <td><strong>Published At</strong></td>
                    <td>{{ $post->published_at }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $post->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $post->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.posts') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
