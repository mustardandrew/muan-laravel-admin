@extends('admin::admin.layouts.main')

@section('title', 'Messages')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Messages',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')

    <h1>Messages</h1>

    <p>In process, comming soon...</p>

@endsection
