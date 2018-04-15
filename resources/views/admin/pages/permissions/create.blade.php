@extends('admin::admin.layouts.main')

@section('title', 'Create Permission')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.permissions') => 'Permissions',
            '' => 'Create Permission'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Create Permission</h1>

    <form class="form" action="{{ route('admin.permissions.store') }}" method="POST">
        {{ csrf_field() }}

        <div class=form__group>
            <div class="control">
                <label class="control__label" for="name">Permission name</label>
                <input type="text"
                       class="control__field"
                       name="name"
                       id="name"
                       placeholder="Input name"
                       value="{{ old('name') }}" />
                @if ($errors->has('name'))
                    <span class="control__help control__help--error">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Create
            </button>
            <a href="{{ route('admin.permissions') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
