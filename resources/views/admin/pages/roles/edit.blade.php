@extends('admin::admin.layouts.main')

@section('title', 'Edit Role')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.roles') => 'Roles',
            '' => 'Edit Role'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Edit Role</h1>

    <form class="form" action="{{ route('admin.roles.update', ['id' => $role->id]) }}" method="POST">
        @csrf

        <div class=form__group>
            <div class="control">
                <label class="control__label" for="name">Role name</label>
                <input type="text"
                       class="control__field"
                       name="name"
                       id="name"
                       placeholder="Input name"
                       value="{{ $role->name }}" />
                @if ($errors->has('name'))
                    <span class="control__help control__help--error">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Update
            </button>
            <a href="{{ route('admin.roles') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
