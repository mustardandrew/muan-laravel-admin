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
    <data-table-wrapper route="{{ route('admin.api.permissions') }}" title="Permissions"></data-table-wrapper>
@endsection
