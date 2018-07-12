@extends('admin::admin.layouts.main')

@section('title', 'Comments')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Comments',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper class="vue-wrapper" route="{{ route('admin.api.comments') }}" title="Comments"></data-table-wrapper>
@endsection
