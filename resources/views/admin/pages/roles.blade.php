@extends('admin::admin.layouts.main')

@section('title', 'Roles')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Roles',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper id="admin" route="{{ route('admin.api.roles') }}" title="Roles"></data-table-wrapper>
@endsection
