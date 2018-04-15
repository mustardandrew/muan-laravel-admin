@extends('admin::admin.layouts.main')

@section('title', 'Delete Property')

@section('breadcrumbs')
    @php
        $breadcrumbs = [
            route('admin.properties') => 'Properties',
            '' => 'Delete Property'
        ];
    @endphp
    @include('admin::admin.layouts.chunks._breadcrumbs', $breadcrumbs)
@endsection

@section('content')
    <h1>Delete Property</h1>

    <form class="form" action="{{ route('admin.properties.destroy', ['id' => $property->id]) }}" method="POST">
        {{ csrf_field() }}

        <p>Are you sure want to destroy property?</p>

        <div class=form__group>
            <table class="table">
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $property->id }}</td>
                </tr>
                <tr>
                    <td><strong>Slug</strong></td>
                    <td>{{ $property->dlug }}</td>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{{ $property->title }}</td>
                </tr>
                <tr>
                    <td><strong>Description</strong></td>
                    <td>{{ $property->description }}</td>
                </tr>
                <tr>
                    <td><strong>Created At</strong></td>
                    <td>{{ $property->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>Updated At</strong></td>
                    <td>{{ $property->updated_at }}</td>
                </tr>
            </table>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Delete
            </button>
            <a href="{{ route('admin.properties') }}" class="button">
                Cancel
            </a>
        </div>

    </form>
@endsection
