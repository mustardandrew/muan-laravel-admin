@extends('admin::admin.layouts.main')

@section('title', 'Permissions')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Permissions',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper model-name="permissions"></data-table-wrapper>
@endsection
