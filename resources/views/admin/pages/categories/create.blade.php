@extends('admin::admin.layouts.main')

@section('title', 'Create Category')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.categories') => 'Categories',
            '' => 'Create Category'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Create Category</h1>

    <form class="form"
        action="{{ route('admin.categories.store') }}"
        method="POST"
        enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="row">
            <div class="column two mr-20 mb-20">

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

                <div class="form__group">
                    <div class="control">
                        <label class="control__label" for="parent_category_id">Parent category</label>
                        <select name="parent_category_id" id="parent_category_id" class="control__field">
                            <option value="0">No parent</option>
                            @foreach ($categories as $categoryItem)
                                <option value="{{ $categoryItem->id }}">
                                    {{ $categoryItem->title }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('parent_category_id'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('parent_category_id') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <upload-image class="vue-wrapper"
                                  title="Choose Image"
                                  name="image"
                                  error="{{ $errors->has('image') ? $errors->first('image') : '' }}">
                    </upload-image>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="description">Description</label>
                        <textarea name="description"
                                  class="control__field"
                                  id="description"
                                  placeholder="Input description"
                                  cols="30"
                                  rows="15">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('description') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">

                        <input type="checkbox"
                               class="control__field"
                               name="is_active"
                               id="is_active"
                               value="1"
                               placeholder="Input slug"
                            {{ old('is_active') ? 'checked' : '' }}/>
                        <label class="control__label" for="is_active">Is Active</label>

                        @if ($errors->has('is_active'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('is_active') }}
                            </span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="column mb-20">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="name">Title (META)</label>
                        <input type="text"
                               class="control__field"
                               name="meta_title"
                               id="meta_title"
                               placeholder="Input meta title"
                               value="{{ old('meta_title') }}" />
                        @if ($errors->has('meta_title'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('meta_title') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="meta_description">Description (META)</label>
                        <textarea name="meta_description"
                                  class="control__field"
                                  id="meta_description"
                                  placeholder="Input meta description"
                                  cols="30"
                                  rows="4">{{ old('meta_description') }}</textarea>
                        @if ($errors->has('meta_description'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('meta_description') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="meta_description">Keywords (META)</label>
                        <textarea name="meta_keywords"
                                  class="control__field"
                                  id="meta_keywords"
                                  placeholder="Input meta keywords"
                                  cols="30"
                                  rows="4">{{ old('meta_keywords') }}</textarea>
                        @if ($errors->has('meta_keywords'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('meta_keywords') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="name">Robots (META)</label>
                        <input type="text"
                               class="control__field"
                               name="meta_robots"
                               id="meta_robots"
                               placeholder="Input meta robots"
                               value="{{ old('meta_robots') }}" />
                        @if ($errors->has('meta_robots'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('meta_robots') }}
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
            <a href="{{ route('admin.categories') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
