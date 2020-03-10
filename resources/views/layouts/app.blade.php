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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Wypożyczalnia
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>Koszyk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

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

@yield('scripts')
</body>
</html>
