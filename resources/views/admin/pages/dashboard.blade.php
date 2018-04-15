@extends('admin::admin.layouts.main')

@section('title', 'Dashboard')

@section('content')

    <h1>Dashboard</h1>

    <div class="row">
        <div class="column mr-10">
            <a class="block-info bg-blue-madison" href="{{ route('admin.users') }}">
                <div class="block-info__title">Users</div>
                <hr>
                <div class="block-info__description">{{ $countUsers }}</div>
            </a>
        </div>
        <div class="column mr-10">
            <a class="block-info bg-yellow-gold" href="{{ route('admin.posts') }}">
                <div class="block-info__title">Posts</div>
                <hr>
                <div class="block-info__description">{{ $countPosts }}</div>
            </a>
        </div>
        <div class="column mr-10">
            <a class="block-info bg-purple-medium" href="{{ route('admin.categories') }}">
                <div class="block-info__title">Categories</div>
                <hr>
                <div class="block-info__description">{{ $countCategories }}</div>
            </a>
        </div>
        <div class="column mr-10">
            <a class="block-info bg-red-flamingo" href="{{ route('admin.pages') }}">
                <div class="block-info__title">Pages</div>
                <hr>
                <div class="block-info__description">{{ $countPages }}</div>
            </a>
        </div>
        <div class="column">
            <a class="block-info bg-green-jungle" href="{{ route('admin.blocks') }}">
                <div class="block-info__title">Blocks</div>
                <hr>
                <div class="block-info__description">{{ $countBlocks }}</div>
            </a>
        </div>
    </div>

@endsection
