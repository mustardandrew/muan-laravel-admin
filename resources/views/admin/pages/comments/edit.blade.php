@extends('admin::admin.layouts.main')

@section('title', 'Edit Comment')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.comments') => 'Comments',
            '' => 'Edit Comment'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Edit Comment</h1>

    <form class="form" action="{{ route('admin.comments.update', ['id' => $comment->id]) }}" method="POST">
        {{ csrf_field() }}

        <div class="row">
            <div class="column two mr-20 mb-20">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="comment">Comment</label>

                        <code-mirror-wrapper
                            class="vue-wrapper"
                            id="comment"
                            name="comment"
                            placeholder="Input comment"
                            value="{{ $comment->comment }}">
                        </code-mirror-wrapper>

                        @if ($errors->has('comment'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('comment') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">

                        <input type="checkbox"
                               class="control__field"
                               name="approved"
                               id="approved"
                               value="1"
                            {{ $comment->approved ? 'checked' : '' }}/>
                        <label class="control__label" for="approved">Approved</label>

                        @if ($errors->has('approved'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('approved') }}
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
            <a href="{{ route('admin.comments') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
