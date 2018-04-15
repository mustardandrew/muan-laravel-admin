<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#2b3643">
        <meta name="msapplication-TileColor" content="#2b3643">
        <meta name="theme-color" content="#2b3643">

        <title>@yield('title') - Admin Panel</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        @yield('styles')
    </head>

    <body>
        <div id="admin">
            @yield('main')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/admin.js') }}"></script>
        @yield('scripts')
    </body>

</html>
