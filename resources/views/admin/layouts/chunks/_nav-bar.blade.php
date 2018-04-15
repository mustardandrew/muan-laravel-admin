<div class="nav-bar">

    <div id="toggle-nav-bar" class="nav-bar__item nav-bar__item--toggle" title="Navigation Bar">
        <div class="nav-bar__icon">
            <i class="fas fa-bars"></i>
        </div>
        <div class="nav-bar__title">Navigation</div>
    </div>

    @php $navBarMenu = config('admin.nav-bar'); @endphp

    @if (! empty($navBarMenu))
        @foreach ($navBarMenu as $menu)
            @isset ($menu['title'])
                <div class="nav-bar__header" title="{{ $menu['title'] }}">{{ $menu['title'] }}</div>
            @endisset
            @isset ($menu['menu'])
                @foreach ($menu['menu'] as $item)
                    @isset ($item['title'])
                        <a class="nav-bar__item{{ isset($item['route']) && Route::currentRouteName() == $item['route'] ? ' nav-bar__item--active' : '' }}"
                           href="{{ empty($item['route']) ? '#' : route($item['route']) }}"
                           title="{{ $item['title'] }}">
                            @isset ($item['icon'])
                                <div class="nav-bar__icon">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @endisset
                            <div class="nav-bar__title">{{ $item['title'] }}</div>
                        </a>
                    @endisset
                @endforeach
            @endisset
        @endforeach
    @endif

</div>
