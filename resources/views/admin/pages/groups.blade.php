@extends('admin::admin.layouts.main')

@section('title', 'Groups')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Groups',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper class="vue-wrapper" route="{{ route('admin.api.groups') }}" title="Groups"></data-table-wrapper>
@endsection
