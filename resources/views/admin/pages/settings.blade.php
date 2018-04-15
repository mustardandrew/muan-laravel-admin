@extends('admin::admin.layouts.main')

@section('title', 'Settings')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Settings',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')

    <h1>Settings</h1>

    <p>In process, comming soon...</p>

@endsection
