@extends('admin::admin.layouts.main')

@section('title', 'Delete Permission')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.permissions') => 'Permissions',
            '' => 'Delete Permission'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Permission</h1>

    <form class="form" action="{{ route('admin.permissions.destroy', ['id' => $permission->id]) }}" method="POST">
        @csrf

        <p>Are you sure want to destroy permission?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $permission->id }}</td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{ $permission->name }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $permission->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $permission->updated_at }}</td>
                </tr>
                @if ($permission->roles->count())
                    <tr>
                        <td><strong>Attached To Roles</strong></td>
                        <td>
                            {{ $permission->roles->implode('name', ', ')  }}
                        </td>
                    </tr>
                @endif
                @if ($permission->users()->count())
                    <tr>
                        <td><strong>Attached To Users</strong></td>
                        <td>
                            {{ $permission->users()->count()  }} users
                        </td>
                    </tr>
                @endif
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.permissions') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
