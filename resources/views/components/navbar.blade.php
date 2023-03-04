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
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                {{-- language --}}
                @if (app()->getLocale() == 'zh-TW')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('lang', 'en') }}"
                            onclick="event.preventDefault(); document.getElementById('lang-en').submit();">
                            @lang('navbar.en')
                        </a>
                        <form id="lang-en" action="{{ route('lang', 'en') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lang', 'zh-TW') }}"
                        onclick="event.preventDefault(); document.getElementById('lang-zh-TW').submit();">
                        @lang('navbar.zh-TW')
                    </a>
                    <form id="lang-zh-TW" action="{{ route('lang', 'zh-TW') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endif
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
