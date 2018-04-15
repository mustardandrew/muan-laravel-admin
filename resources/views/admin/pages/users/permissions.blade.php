@extends('admin::admin.layouts.main')

@section('title', 'Attach Permissions To ' . ucfirst($user->name) . ' User')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.users') => 'Users',
            '' => 'Attach Permissions To ' . ucfirst($user->name) . ' User'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Attach Permissions To <strong>{{ ucfirst($user->name) }}</strong> User</h1>

    <form class="form" action="{{ route('admin.users.attach', ['id' => $user->id]) }}" method="POST">

        {{ csrf_field() }}

        @php
            $groups = $permissions->map(function ($permission) {
                $words = str_word_count(trim($permission->name), 1);
                return array_pop($words);
            })->unique();
        @endphp

        @foreach ($groups->chunk(4) as $chunk)
            <div class="form__group">
                @foreach ($chunk as $group)
                    @php
                        $currentGroup = $permissions->filter(function ($value) use ($group) {
                            return strpos($value, $group) !== false;
                        })
                    @endphp

                    <div style="flex: 1;">
                        <p><strong>{{ ucfirst($group) }}</strong></p>
                        @foreach ($currentGroup as $permission)

                            <div class="control">
                                <input type="checkbox"
                                       name="permissions[]"
                                       id="permissions-{{ $permission->id }}"
                                       value="{{ $permission->id }}"
                                       {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }} />

                                <label class="control__label" for="permissions-{{ $permission->id }}">
                                    {{ $permission->name }}
                                    @if ($user->hasPermissionThroughRole($permission->name))
                                        <strong>(in role)</strong>
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>

                @endforeach
            </div>
        @endforeach

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Attach
            </button>
            <a href="{{ route('admin.users') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
