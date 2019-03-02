@extends('admin::admin.layouts.main')

@section('title', 'Create User')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.users') => 'Users',
            '' => 'Create User'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Create User</h1>

    <form class="form"
        action="{{ route('admin.users.store') }}"
        method="POST"
        enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class=form__group>

            <div class="form__item">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="name">Name</label>
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
                    <div class="control">
                        <label class="control__label" for="email">Email</label>
                        <input type="email"
                               class="control__field"
                               name="email"
                               id="email"
                               placeholder="Input email"
                               value="{{ old('email') }}" />
                        @if ($errors->has('email'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form__group">
                    <div class="control">
                        <label class="control__label" for="sex">Sex</label>
                        <select class="control__field"
                                name="sex"
                                id="sex">
                            <option value="unknown" {{ old('sex') == 'unknown' ? 'selected' : '' }}>Unknown</option>
                            <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @if ($errors->has('sex'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('sex') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="birthday">Birthday</label>
                        <input type="date"
                               class="control__field"
                               name="birthday"
                               id="birthday"
                               placeholder="Input birthday"
                               value="{{ old('birthday') }}" />

                        @if ($errors->has('birthday'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('birthday') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="about">About</label>

                        <code-mirror-wrapper
                            class="vue-wrapper"
                            id="about"
                            name="about"
                            placeholder="Input about"
                            value="{{ old('about') }}">
                        </code-mirror-wrapper>

                        @if ($errors->has('about'))
                            <span class="control__help control__help--error">
                                {{ $errors->first('about') }}
                            </span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="form__item">

                <div class=form__group>
                    <upload-image class="vue-wrapper"
                                  title="Choose Avatar"
                                  name="image"
                                  error="{{ $errors->has('image') ? $errors->first('image') : '' }}">
                    </upload-image>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="password">Password</label>
                        <input type="password"
                               class="control__field"
                               name="password"
                               id="password"
                               placeholder="Input password"
                               value="{{ old('password') }}" />
                        @if ($errors->has('password'))
                            <span class="control__help control__help--error">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="password_confirmation">Confirm password</label>
                        <input type="password"
                               class="control__field"
                               name="password_confirmation"
                               id="password_confirmation"
                               placeholder="Confirm password"
                               value="{{ old('password_confirmation') }}" />
                        @if ($errors->has('password_confirmation'))
                            <span class="control__help control__help--error">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="control">
                    <label class="control__label">Roles</label>

                    @foreach ($roles as $role)
                        <input type="checkbox"
                               name="roles[]"
                               id="roles-{{ $role->id }}"
                               value="{{ $role->id }}" />
                        <label class="control__label" for="roles-{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    @endforeach
                </div>

            </div>

        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Create
            </button>
            <a href="{{ route('admin.users') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
