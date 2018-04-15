@if (! empty($breadcrumbs))
    <div class="breadcrumbs">

        {{-- Main Crumb --}}
        <div class="breadcrumbs__item">
            <a class="breadcrumbs__link" href="{{ route(config('admin.logo.route', 'admin.dashboard')) }}">
                <i class="fas fa-home"></i>
            </a>
        </div>
        {{-- // End Main Crumb--}}

        @foreach ($breadcrumbs as $route => $title)
            @if ($loop->last)
                <div class="breadcrumbs__item">
                    {{ $title }}
                </div>
            @else
                <div class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ $route }}">
                        {{ $title }}
                    </a>
                </div>
            @endif
        @endforeach

    </div>
@endif
