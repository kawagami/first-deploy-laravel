<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('image/favicon-32x32.png') }}" alt="" srcset="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('note') }}">@lang('navbar.my-note')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('short-url') }}">@lang('navbar.short-url')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('thumbor') }}">thumbor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://vue.kawa.homes/">武將列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://vue.kawa.homes/">env test</a>
                </li>

                {{-- only admin --}}
                @role('admin')
                    <li class="nav-item dropdown">
                        <a id="admin-select" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @lang('navbar.admin-panel')
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="admin-select">
                            <a class="dropdown-item" href="{{ route('admin.index') }}">
                                @lang('navbar.admin-panel')
                            </a>
                            @foreach (config('app.admins') as $page)
                                <a class="dropdown-item" href="{{ route('admin.' . $page) }}">
                                    {{-- @lang('navbar.' . $locale) --}}
                                    {{ $page }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endrole

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                {{-- language --}}
                <li class="nav-item dropdown">
                    <a id="lang-select" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @lang('langs.' . app()->getLocale())
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="lang-select">
                        @foreach (__('langs') as $key => $locale)
                            @if ($key != app()->getLocale())
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault();document.getElementById('lang-{{ $key }}').submit();">
                                    @lang('langs.' . $key)
                                </a>
                                <form id="lang-{{ $key }}" action="{{ route('lang', $key) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            @endif
                        @endforeach
                    </div>
                </li>

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">@lang('navbar.login')</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                @lang('navbar.logout')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
