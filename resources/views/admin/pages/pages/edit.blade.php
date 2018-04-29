@extends('admin::admin.layouts.main')

@section('title', 'Edit Page')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.pages') => 'Pages',
            '' => 'Edit Page'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Edit Page</h1>

    <form class="form"
        action="{{ route('admin.pages.update', ['id' => $page->id]) }}"
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
                               value="{{ $page->title }}" />
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
                               value="{{ $page->slug }}" />
                        @if ($errors->has('slug'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('slug') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        @if ($page->image)
                            <div>
                                <div>(Now)</div>
                                <img class="thumbnail" src="{{ Storage::disk(config('admin.diskname', 'public'))->url($page->image) }}" alt="" height="100">
                            </div>
                        @endif

                        <label class="control__label" for="image">Choose Image</label>
                        <input type="file"
                               class="control__field"
                               name="image"
                               id="image"
                               placeholder="Choose Image" />
                        @if ($errors->has('image'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('image') }}
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
                                  rows="15">{{ $page->description }}</textarea>
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
                            {{ $page->is_active ? 'checked' : '' }}/>
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
                               value="{{ $page->meta_title }}" />
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
                                  rows="4">{{ $page->meta_description }}</textarea>
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
                                  rows="4">{{ $page->meta_keywords }}</textarea>
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
                               value="{{ $page->meta_robots }}" />
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
                Update
            </button>
            <a href="{{ route('admin.pages') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
