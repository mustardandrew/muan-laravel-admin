@extends('admin::admin.layouts.default')

@section('title', '404 error')

@section('main')

    <div class="error-page" style="
        height: 100vh;
        position: relative;
        display: flex;
        color: white;
        justify-content: center;
        align-items: center;">

        <div>
            <h1>404 Error</h1>

<pre><strong>class</strong> Handler {
    <strong>function</strong> catchError($error) {
        <strong>if</strong> ($error->code === 404) {
            <strong>echo</strong> "404 Error";
        }
    }
    <strong>function</strong> gotoDashboard() {
        <strong>echo</strong> "<a href="{{ route('admin.dashboard') }}" style="color: #fff;">Dashboard</a>";
    }
    <strong>function</strong> gotoLogin() {
        <strong>echo</strong> "<a href="{{ route('admin.login') }}" style="color: #fff;">Login</a>";
    }
}</pre>

        </div>
    </div>

@endsection
