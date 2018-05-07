@extends('admin::admin.layouts.main')

@section('title', 'Users')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Users',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper id="admin" route="{{ route('admin.api.users') }}" title="Users"></data-table-wrapper>
@endsection
