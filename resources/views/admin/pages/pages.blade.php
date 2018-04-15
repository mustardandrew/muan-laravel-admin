@extends('admin::admin.layouts.main')

@section('title', 'Pages')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Pages',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper model-name="pages"></data-table-wrapper>
@endsection
