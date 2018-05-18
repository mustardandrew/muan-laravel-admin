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
    <data-table-wrapper class="vue-wrapper" route="{{ route('admin.api.properties') }}" title="Properties"></data-table-wrapper>
@endsection
