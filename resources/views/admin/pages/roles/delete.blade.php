@extends('admin::admin.layouts.main')

@section('title', 'Delete Role')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.roles') => 'Roles',
            '' => 'Delete Role'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Role</h1>

    <form class="form" action="{{ route('admin.roles.destroy', ['id' => $role->id]) }}" method="POST">
        @csrf

        <p>Are you sure want to destroy role?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $role->id }}</td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{ $role->name }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $role->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $role->updated_at }}</td>
                </tr>
                @if ($count = $role->users()->count())
                    <tr>
                        <td><strong>Attached To Users</strong></td>
                        <td>
                            {{ $count  }} user{{ $count > 1 ? 's' : '' }}
                        </td>
                    </tr>
                @endif
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.roles') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
