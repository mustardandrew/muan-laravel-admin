@extends('admin::admin.layouts.main')

@php $title = 'Tags'; @endphp

@section('title', $title)

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => $title,
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper class="vue-wrapper" route="{{ route('admin.api.tags') }}" title="{{ $title }}"></data-table-wrapper>
@endsection
