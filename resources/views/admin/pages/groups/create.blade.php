@extends('admin::admin.layouts.main')

@section('title', 'Create Group')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.groups') => 'Groups',
            '' => 'Create Group'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Create Group</h1>

    <form class="form" action="{{ route('admin.groups.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="column two mr-20 mb-20">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="slug">Slug</label>
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
                        <label class="control__label" for="description">Description</label>
                        <textarea name="description"
                                  class="control__field"
                                  id="description"
                                  placeholder="Input description"
                                  cols="30"
                                  rows="5">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('description') }}
                            </span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="column mb-20">

            </div>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Create
            </button>
            <a href="{{ route('admin.groups') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
