@extends('admin::admin.layouts.main')

@section('title', 'Delete Page')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.pages') => 'Pages',
            '' => 'Delete Page'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Page</h1>

    <form class="form" action="{{ route('admin.pages.destroy', ['id' => $page->id]) }}" method="POST">
        @csrf

        <p>Are you sure want to destroy page?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $page->id }}</td>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{{ $page->title }}</td>
                </tr>
                <tr>
                    <td><strong>Slug</strong></td>
                    <td>{{ $page->slug }}</td>
                </tr>
                <tr>
                    <td><strong>Is Active</strong></td>
                    <td>{{ $page->is_active ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $page->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $page->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.pages') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
