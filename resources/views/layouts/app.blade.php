<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<main id="app" class="main">
    <nav class="navbar navbar-expand-sm navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/rehastore-logo.png') }}" alt="Logo Rehastore wypożyczalnia">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-sm-auto">
                    @guest
                        <li class="navbar-item dropdown">
                            <button type="button" class="btn btn-menu dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <span>Zaloguj się lub załóz konto</span>
                            </button>

                            <div class="navbar-dropdown dropdown-menu dropdown-menu-right">
                                <a class="navbar-dropdown-item dropdown-item btn btn-login"
                                   href="{{ route('login') }}">{{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a class="navbar-dropdown-item dropdown-item btn btn-login"
                                       href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </div>
                        </li>
                    @else

                        <li class="navbar-item btn-group dropup-sm dropdown-md">
                            <button type="button" class="btn btn-user dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>

                            <div class="navbar-dropdown dropdown-menu dropdown-menu-sm-right">
                                <a class="navbar-dropdown-item dropdown-item btn btn-login"
                                   href="{{ route('user.orders') }}">
                                    Zamówienia
                                </a>
                                <a class="navbar-dropdown-item dropdown-item btn btn-login" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endguest

                    <li class="navbar-item">
                        <a href="{{ route('cart') }}" type="button" class="btn btn-basket">
                            <i class="fa fa-shopping-cart btn-basket--icon"></i>
                            <span>Koszyk</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</main>
<!-- jQuery -->
<script src="{{ asset('/js/jquery.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('/vendors/bootstrap/dist/js/bootstrap.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset('/vendors/fastclick/lib/fastclick.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- NProgress -->
<script src="{{ asset('/vendors/nprogress/nprogress.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Chart.js -->
<script src="{{ asset('/vendors/Chart.js/dist/Chart.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- gauge.js -->
<script src="{{ asset('/vendors/gauge.js/dist/gauge.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('/vendors/iCheck/icheck.min.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Skycons -->
<script src="{{ asset('/vendors/skycons/skycons.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Flot -->
<script src="{{ asset('/vendors/Flot/jquery.flot.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/Flot/jquery.flot.pie.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/Flot/jquery.flot.time.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/Flot/jquery.flot.stack.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/Flot/jquery.flot.resize.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Flot plugins -->
<script src="{{ asset('/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/flot.curvedlines/curvedLines.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- DateJS -->
<script src="{{ asset('/vendors/DateJS/build/date.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- JQVMap -->
<script src="{{ asset('/vendors/jqvmap/dist/jquery.vmap.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('/vendors/moment/min/moment.min.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('/js/custom.min.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="db25bb0af1c5ca965d7b8174-|49" defer=""></script>

<!-- Main JS -->
<script src="{{ asset('/js/main.js') }}"></script>

@yield('scripts')
</body>
</html>
