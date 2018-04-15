@extends('admin::admin.layouts.main')

@section('title', 'Properties')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Properties',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper model-name="properties"></data-table-wrapper>
@endsection
