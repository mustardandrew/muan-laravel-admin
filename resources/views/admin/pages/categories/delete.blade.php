@extends('admin::admin.layouts.main')

@section('title', 'Delete Category')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.categories') => 'Categories',
            '' => 'Delete Category'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Category</h1>

    <form class="form" action="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" method="POST">
        @csrf

        <p>Are you sure want to destroy category?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{{ $category->title }}</td>
                </tr>
                <tr>
                    <td><strong>Slug</strong></td>
                    <td>{{ $category->slug }}</td>
                </tr>
                <tr>
                    <td><strong>Is Active</strong></td>
                    <td>{{ $category->is_active ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $category->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $category->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <div class="form__group">
                <div class="control">
                    <label class="control__label" for="category_id">Move To Another Category</label>
                    <select name="category_id" id="category_id" class="control__field">
                        <option value="0">No parent</option>
                        @foreach ($categories as $categoryItem)
                            <option value="{{ $categoryItem->id }}">
                                {{ $categoryItem->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.categories') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
