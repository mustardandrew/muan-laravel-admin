@extends('admin::admin.layouts.main')

@section('title', 'Delete Block')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.blocks') => 'Blocks',
            '' => 'Delete Block'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Block</h1>

    <form class="form" action="{{ route('admin.blocks.destroy', ['id' => $block->id]) }}" method="POST">
        {{ csrf_field() }}

        <p>Are you sure want to destroy block?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $block->id }}</td>
                </tr>
                <tr>
                    <td><strong>Slug</strong></td>
                    <td>{{ $block->slug }}</td>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{{ $block->title }}</td>
                </tr>
                <tr>
                    <td><strong>Description</strong></td>
                    <td>{{ $block->description }}</td>
                </tr>
                <tr>
                    <td><strong>Is Active</strong></td>
                    <td>{{ $block->is_active ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $block->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $block->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.blocks') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
