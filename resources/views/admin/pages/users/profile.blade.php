@extends('admin::admin.layouts.main')

@section('title', 'Profile of ' . $user->name)

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.users') => 'Users',
            '' => 'Profile of ' . $user->name
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')

    <h1>Profile of <strong>{{ $user->name }}</strong></h1>

    <div class="row">
        <div class="column one">

            <div class="profile-actions">
                <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="button button--dark">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a>
                <a href="{{ route('admin.users.permissions', ['id' => $user->id]) }}" class="button button--gold">
                    <i class="fas fa-key"></i> Permissions
                </a>
                <a href="{{ route('admin.users.delete', ['id' => $user->id]) }}" class="button button--red">
                    <i class="fas fa-times"></i> Delete
                </a>
            </div>

            <div class="profile-avatar">
                @if ($user->avatar)
                    <img src="{{ Storage::disk(config('admin.diskname', 'public'))->url($user->avatar) }}" alt="{{ $user->name }}" />
                @else
                    <img src="{{ Gavatar::url($user->email) }}" alt="{{ $user->name }}" />
                @endif
            </div>

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
                    <td><strong>Sex</strong></td>
                    <td>{{ $user->sex }}</td>
                </tr>
                @if ($user->birthday)
                    <tr>
                        <td><strong>Birthday</strong></td>
                        <td>{{ $user->birthday }}</td>
                    </tr>
                @endif
                <tr>
                    <td><strong>About</strong></td>
                    <td>{{ $user->about ? $user->about : '-' }}</td>
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

        <div class="column two"></div>
    </div>

    {{-- <div class="mt-20">
        <h2>Statistic</h2>
        <div class="row">

            <div class="column mr-10">
                <a class="block-info bg-blue-madison" href="{{ route('admin.pages') }}">
                    <div class="block-info__title">Pages</div>
                    <hr>
                    <div class="block-info__description">{{ $user->pages()->count() }}</div>
                </a>
            </div>
            <div class="column">
                <a class="block-info bg-yellow-gold" href="{{ route('admin.posts') }}">
                    <div class="block-info__title">Posts</div>
                    <hr>
                    <div class="block-info__description">{{ $user->posts()->count() }}</div>
                </a>
            </div>

        </div>
    </div> --}}


@endsection
