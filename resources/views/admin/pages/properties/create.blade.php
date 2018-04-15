@extends('admin::admin.layouts.main')

@section('title', 'Create Property')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.properties') => 'Properties',
            '' => 'Create Property'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Create Property</h1>

    <form class="form" action="{{ route('admin.properties.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="row">
            <div class="column mr-20 mb-20">

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
                        <label class="control__label" for="group_id">Group</label>
                        <select name="group_id"
                                class="control__field"
                                placeholder="Select group"
                                id="group_id">
                            <option value="0">No group</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('group_id'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('group_id') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="type">Type</label>
                        <select class="control__field" name="type" id="type" placeholder="Input type">
                            @foreach (Properties::getTypes() as $type => $title)
                                <option value="{{ $type }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('value'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('value') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="value">Value</label>
                        <input type="text"
                               class="control__field"
                               name="value"
                               id="value"
                               placeholder="Input value"
                               value="{{ old('value') }}" />
                        @if ($errors->has('value'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('value') }}
                            </span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="column mb-20">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="name">Title</label>
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
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Create
            </button>
            <a href="{{ route('admin.properties') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
