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
    <data-table-wrapper model-name="users"></data-table-wrapper>
@endsection
