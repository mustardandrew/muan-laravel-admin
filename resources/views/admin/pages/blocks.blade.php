@extends('admin::admin.layouts.main')

@section('title', 'Blocks')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Blocks',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <data-table-wrapper model-name="blocks"></data-table-wrapper>
@endsection
