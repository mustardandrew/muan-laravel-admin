@extends('admin::admin.layouts.main')

@section('title', 'Create Tag')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.blocks') => 'Tags',
            '' => 'Create Tag'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Create Tag</h1>

    <form class="form" action="{{ route('admin.tags.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="row">
            <div class="column mb-20">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="title">Title</label>

                        <input type="text"
                               class="control__field"
                               name="title"
                               id="title"
                               placeholder="Input title"
                               value="{{ old('title') }}" />

                        @if ($errors->has('title'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('title') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="name">Slug</label>
                        <input type="text"
                               class="control__field"
                               name="slug"
                               id="slug"
                               placeholder="Input slug"
                               value="{{ old('slug') }}" />
                        @if ($errors->has('slug'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('slug') }}
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Create
            </button>
            <a href="{{ route('admin.tags') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
