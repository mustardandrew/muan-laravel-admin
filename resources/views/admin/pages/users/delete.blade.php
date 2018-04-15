@extends('admin::admin.layouts.main')

@section('title', 'Delete User')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.roles') => 'Users',
            '' => 'Delete User'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete User</h1>

    <form class="form" action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST">
        {{ csrf_field() }}

        <p>Are you sure want to destroy user?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
                <tr>
                    <td><strong>Roles</strong></td>
                    <td>
                        {{ $user->roles->implode('name', ', ') }}
                    </td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.users') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
