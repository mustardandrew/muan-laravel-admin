@extends('admin::admin.layouts.default')

@section('title', 'Login to Admin Panel')

@section('main')

    <div class="login-form-wrapper">

        <form class="form" action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="form__group login-form-header">
                <h1>Login</h1>
                <div class="logo"><span class="logo__part-one">MU</span> <span class="logo__part-two">AN</span></div>
            </div>

            <div class="form__group">
                <div class="control">
                    <label class="control__label" for="email">Email</label>
                    <input type="text"
                           class="control__field"
                           id="email"
                           name="email"
                           placeholder="Input email"
                           value="{{ old('email') }}"
                           autofocus />
                    @if ($errors->has('email'))
                        <span class="control__help control__help--error">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form__group">
                <div class="control">
                    <label class="control__label" for="password">Password</label>
                    <input type="password"
                           class="control__field"
                           id="password"
                           name="password"
                           placeholder="Input password" />
                    @if ($errors->has('password'))
                        <span class="control__help control__help--error">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form__group">
                <button type="submit" class="button button--dark mr-10">
                    Login
                </button>
                <div class="control">
                    <input type="checkbox"
                           class="control__field"
                           id="remember"
                           name="remember"
                           {{ old('remember') ? 'checked' : '' }} />
                    <label class="control__label" for="remember">Remember Me</label>
                </div>
            </div>
        </form>

    </div>

@endsection
