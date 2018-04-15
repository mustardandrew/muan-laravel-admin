@extends('admin::admin.layouts.main')

@section('title', 'Logs')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Logs',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')

    <h1>Logs</h1>

    <p>In process, comming soon...</p>

@endsection
