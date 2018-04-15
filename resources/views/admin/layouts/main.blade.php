@extends('admin::admin.layouts.default')

@section('main')

    <div class="container">
        <div class="left-bar" id="left-bar">
            <div class="left-menu">
                @include('admin::admin.layouts.chunks._nav-bar')
            </div>
        </div>

        <div class="right-bar">
            @include('admin::admin.layouts.chunks._top-menu')
            @yield('breadcrumbs')

            @include('admin::admin.layouts.chunks._flash-message')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

@endsection
