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
    <data-table-wrapper route="{{ route('admin.api.categories') }}" title="Categories"></data-table-wrapper>
@endsection
