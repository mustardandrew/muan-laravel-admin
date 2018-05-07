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
    <data-table-wrapper id="admin" route="{{ route('admin.api.pages') }}" title="Pages"></data-table-wrapper>
@endsection
