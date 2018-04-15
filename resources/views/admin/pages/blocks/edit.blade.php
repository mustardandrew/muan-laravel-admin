@extends('admin::admin.layouts.main')

@section('title', 'Edit Block')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.blocks') => 'Blocks',
            '' => 'Edit Block'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Edit Block</h1>

    <form class="form" action="{{ route('admin.blocks.update', ['id' => $block->id]) }}" method="POST">
        @csrf

        <div class="row">
            <div class="column two mr-20 mb-20">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="name">Slug</label>
                        <input type="text"
                               class="control__field"
                               name="slug"
                               id="slug"
                               placeholder="Input slug"
                               value="{{ $block->slug }}" />
                        @if ($errors->has('slug'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('slug') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="value">Value</label>
                        <textarea name="value"
                                  class="control__field"
                                  id="value"
                                  placeholder="Input value"
                                  cols="30"
                                  rows="10">{{ $block->value }}</textarea>
                        @if ($errors->has('value'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('value') }}
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
                            {{ $block->is_active ? 'checked' : '' }}/>
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
                        <label class="control__label" for="name">Title</label>
                        <input type="text"
                               class="control__field"
                               name="title"
                               id="title"
                               placeholder="Input title"
                               value="{{ $block->title }}" />
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
                                  rows="5">{{ $block->description }}</textarea>
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
            <a href="{{ route('admin.blocks') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
