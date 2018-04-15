@extends('admin::admin.layouts.main')

@section('title', 'Edit Property')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.properties') => 'Properties',
            '' => 'Edit Property'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Edit Property</h1>

    <form class="form" action="{{ route('admin.properties.update', ['id' => $property->id]) }}" method="POST">
        @csrf

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
                               value="{{ $property->slug }}" />
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
                            <option value="0" {{ $group->id == 0 ? 'selected' : '' }}>No group</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}"
                                        {{ $group->id == $property->group_id ? 'selected' : '' }} >
                                    {{ $group->title }}
                                </option>
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
                                <option value="{{ $type }}" {{ $property->type == $type ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
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
                               value="{{ $property->value }}" />
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
                               value="{{ $property->title }}" />
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
                                  rows="5">{{ $property->description }}</textarea>
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
                Update
            </button>
            <a href="{{ route('admin.properties') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
