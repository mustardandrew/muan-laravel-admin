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

    <div class="settings-tools">
        <a class="settings-tools__button" title="Export settings" href="{{ route('admin.settings.export') }}"><i class="fas fa-file-export"></i> Export</a>

        <form id="upload-config" action="{{ route('admin.settings.import') }}" method="post" class="settings-tools__button" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" accept="application/json" name="config" id="config" class="upload_json" onchange="document.getElementById('upload-config').submit()">
            <label for="config">
                <i class="fas fa-file-import"></i> Import
            </label>
        </form>
    </div>

    <settings class="vue-wrapper"
              list-route="{{ route('admin.api.settings') }}"
              add-group-route="{{ route('admin.api.settings.add-group') }}"
              edit-group-route="{{ route('admin.api.settings.edit-group') }}"
              destroy-group-route="{{ route('admin.api.settings.destroy-group') }}"
              add-property-route="{{ route('admin.api.settings.add-property') }}"
              destroy-property-route="{{ route('admin.api.settings.destroy-property') }}"
              save-all-properties-route="{{ route('admin.api.settings.save-all-properties') }}">

    </settings>

@endsection
