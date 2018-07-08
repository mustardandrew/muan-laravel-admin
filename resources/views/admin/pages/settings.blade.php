@extends('admin::admin.layouts.main')

@section('title', 'Settings')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            '' => 'Settings',
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')

    <h1>Settings</h1>

    <settings class="vue-wrapper"
              list-route="{{ route('admin.api.settings') }}"
              add-group-route="{{ route('admin.api.settings.add-group') }}"
              destroy-group-route="{{ route('admin.api.settings.destroy-group') }}"
              add-property-route="{{ route('admin.api.settings.add-property') }}"
              destroy-property-route="{{ route('admin.api.settings.destroy-property') }}"
              save-all-properties-route="{{ route('admin.api.settings.save-all-properties') }}">

    </settings>

@endsection
