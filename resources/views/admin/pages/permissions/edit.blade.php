@extends('admin::admin.layouts.main')

@section('title', 'Edit Permission')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.permissions') => 'Permissions',
            '' => 'Edit Permission'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Edit Permission</h1>

    <form class="form" action="{{ route('admin.permissions.update', ['id' => $permission->id]) }}" method="POST">
        @csrf

        <div class=form__group>
            <div class="control">
                <label class="control__label" for="name">Permission name</label>
                <input type="text"
                       class="control__field"
                       name="name"
                       id="name"
                       placeholder="Input name"
                       value="{{ $permission->name }}" />
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
            <a href="{{ route('admin.permissions') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
