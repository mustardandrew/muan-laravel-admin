@extends('admin::admin.layouts.main')

@section('title', 'Categories')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Categories',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper model-name="categories"></data-table-wrapper>
@endsection
