@extends('admin::admin.layouts.main')

@section('title', 'Delete Tag')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.tags') => 'Tags',
            '' => 'Delete Tag'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Tag</h1>

    <form class="form" action="{{ route('admin.tags.destroy', ['id' => $tag->id]) }}" method="POST">
        {{ csrf_field() }}

        <p>Are you sure want to destroy tag?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $tag->id }}</td>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{{ $tag->title }}</td>
                </tr>
                <tr>
                    <td><strong>Slug</strong></td>
                    <td>{{ $tag->slug }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $tag->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $tag->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.tags') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
