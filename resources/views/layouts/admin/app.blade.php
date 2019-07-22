<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{csrf_token()}}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
{{--    <script src="{{ asset('js/admin/dropzone.js') }}"></script>--}}
    <script src="{{ asset('js/plugins-admin.js') }}"></script>
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="admin navbar navbar-dark navbar-expand-lg fixed-top bg-dark flex-md-nowrap p-0 shadow">
            {{--    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/home') }}">GotoPeru</a>--}}
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/home') }}">
                <span class="text-g-green">GO</span><span class="text-g-yellow">TO</span><span class="text-white">PERU</span>
            </a>
            {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
            <ul class="navbar-nav ml-auto px-3">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @section('sidebar')

                @show


                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    @yield('content')
                </main>
            </div>
        </div>

        {{--<main class="p-0">--}}
            {{--@yield('content')--}}
        {{--</main>--}}
    </div>
    <script>
        feather.replace();
        // });
    </script>
    @stack('scripts')
</body>
</html>
