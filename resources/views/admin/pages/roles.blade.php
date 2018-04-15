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
    <data-table-wrapper model-name="roles"></data-table-wrapper>
@endsection
