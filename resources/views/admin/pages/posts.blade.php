@extends('admin::admin.layouts.main')

@section('title', 'Posts')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Posts',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper id="admin" route="{{ route('admin.api.posts') }}" title="Posts"></data-table-wrapper>
@endsection
