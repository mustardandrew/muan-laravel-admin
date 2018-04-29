<div class="top-menu">

    {{-- Logo --}}
    <a href="{{ route(config('admin.logo.route', 'admin.dashboard')) }}"
       class="logo"
       title="{{ config('admin.logo.title') }}">
        <span class="logo__part-one">{{ config('admin.logo.first', 'MU') }}</span>
        <span class="logo__part-two">{{ config('admin.logo.second', 'AN') }}</span>
    </a>
    {{-- // Logo--}}

    {{-- Left Menu --}}
    @php $leftMenu = config('admin.left-menu'); @endphp

    @if(! empty($leftMenu))
        <div class="top-menu__block">

            <div class="menu">
                @foreach ($leftMenu as $item)
                    @isset ($item['title'])
                        <div class="menu__item">
                            <a class="menu__link{{ isset($item['route']) && Route::currentRouteName() == $item['route'] ? ' menu__link--active' : '' }}"
                               href="{{ empty($item['route']) ? 'javascript: return false;' : route($item['route']) }}"
                               title="{{ empty($item['title']) ? '' : $item['title'] }}">
                                @isset($item['icon'])
                                    <i class="{{ $item['icon'] }}"></i>
                                @endisset
                                @isset ($item['title'])
                                    {{ $item['title'] }}
                                @endisset
                            </a>

                            @if (isset($item['menu']))

                                <div class="menu menu--sub">

                                    @foreach ($item['menu'] as $item)
                                        @isset ($item['title'])
                                            <div class="menu__item">
                                                <a class="menu__link{{  isset($item['route']) && Route::currentRouteName() == $item['route'] ? ' menu__link--active' : '' }}"
                                                   href="{{ empty($item['route']) ? '#' : route($item['route']) }}">
                                                    @if (isset($item['icon']))
                                                        <i class="{{ $item['icon'] }}"></i>&nbsp;
                                                    @endif
                                                    {{ $item['title'] }}
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                            @endif
                        </div>
                    @endisset
                @endforeach
            </div>

        </div>
    @endif
    {{-- // Left Menu --}}

    <div class="top-menu__space"></div>

    {{-- Right Menu --}}
    @php $rightMenu = config('admin.right-menu'); @endphp

    @if(! empty($rightMenu))
        <div class="top-menu__block">

            <div class="menu">
                @foreach ($rightMenu as $item)
                    @isset ($item['icon'])
                        <div class="menu__item">
                            <a class="menu__link{{ isset($item['route']) && Route::currentRouteName() == $item['route'] ? ' menu__link--active' : '' }}"
                               href="{{ empty($item['route']) ? '#' : route($item['route']) }}"
                               title="{{ empty($item['title']) ? '' : $item['title'] }}">
                                <i class="{{ $item['icon'] }}"></i>
                            </a>
                        </div>
                    @endisset
                @endforeach
            </div>

        </div>
    @endif
    {{-- // Right Menu --}}

    <div class="top-menu__block">

        {{-- User Menu --}}
        <div class="menu">

            <div class="menu__item">
                <a class="menu__link"
                   href="#"
                   onclick="event.preventDefault();">
                    @if (Auth::user()->avatar)
                        <img class="avatar" src="{{ Upload::url(Auth::user()->avatar) }}"/>
                    @else
                        <img class="avatar" src="{{ Gavatar::url(Auth::user()->email) }}"/>
                    @endif
                    &nbsp;{{ Auth::user()->name }}&nbsp;
                    <i class="fas fa-angle-down"></i>
                </a>

                @php $userMenu = config('admin.user-menu'); @endphp

                @if (! empty($userMenu))
                    <div class="menu menu--sub menu--rightfix">
                        @foreach ($userMenu as $item)
                            @isset ($item['title'])
                                <div class="menu__item">
                                    <a class="menu__link{{  isset($item['route']) && Route::currentRouteName() == $item['route'] ? ' menu__link--active' : '' }}"
                                       href="{{ empty($item['route']) ? '#' : route($item['route']) }}">
                                        @isset ($item['icon'])
                                            <i class="{{ $item['icon'] }}"></i>
                                        @endisset
                                        {{ $item['title'] }}
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Logout --}}
            <div class="menu__item">
                <a class="menu__link"
                   href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
                <form id="logout-form"
                      action="{{ route('admin.logout') }}"
                      method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
            {{-- // Logout --}}

        </div>
        {{-- // User Menu --}}

    </div>

</div>
