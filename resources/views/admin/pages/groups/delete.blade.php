@extends('admin::admin.layouts.main')

@section('title', 'Delete Group')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.blocks') => 'Groups',
            '' => 'Delete Group'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Group</h1>

    <form class="form" action="{{ route('admin.groups.destroy', ['id' => $group->id]) }}" method="POST">
        @csrf

        <p>Are you sure want to destroy group?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $group->id }}</td>
                </tr>
                <tr>
                    <td><strong>Slug</strong></td>
                    <td>{{ $group->slug }}</td>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{{ $group->title }}</td>
                </tr>
                <tr>
                    <td><strong>Description</strong></td>
                    <td>{{ $group->description }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $group->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $group->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <div class="form__group">
                <div class="control">
                    <label class="control__label" for="category_id">Move To Another Category</label>
                    <select name="group_id" id="group_id" class="control__field">
                        <option value="0">No parent</option>
                        @foreach ($groups as $groupItem)
                            <option value="{{ $groupItem->id }}">
                                {{ $groupItem->title }}
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
            <a href="{{ route('admin.groups') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
