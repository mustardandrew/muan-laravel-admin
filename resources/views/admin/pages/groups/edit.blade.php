@extends('admin::admin.layouts.main')

@section('title', 'Edit Group')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.groups') => 'Groups',
            '' => 'Edit Group'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Edit group</h1>

    <form class="form" action="{{ route('admin.groups.update', ['id' => $group->id]) }}" method="POST">
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
                               value="{{ $group->slug }}" />
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
                               value="{{ $group->title }}" />
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
                                  rows="5">{{ $group->description }}</textarea>
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
                Update
            </button>
            <a href="{{ route('admin.groups') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
