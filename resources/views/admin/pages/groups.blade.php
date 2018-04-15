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
    <data-table-wrapper model-name="groups"></data-table-wrapper>
@endsection
