<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public_html/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Font Awesome -->
    <link href="{{ asset('public_html/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('public_html/css/app.css') }}" rel="stylesheet">
</head>
<body>
<main id="app" class="main">
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('public_html/images/rehastore-logo.png') }}" alt="Logo Rehastore wypożyczalnia">
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
                                   href="{{ route('login') }}">Zaloguj</a>

                                @if (Route::has('register'))
                                    <a class="navbar-dropdown-item dropdown-item btn btn-login"
                                       href="{{ route('register') }}">Zarejestruj</a>
                                @endif
                            </div>
                        </li>
                    @else

                        <li class="navbar-item btn-group dropup-sm dropdown-md">
                            <button type="button" class="btn btn-user dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->email }}
                            </button>

                            <div class="navbar-dropdown dropdown-menu dropdown-menu-sm-right">
                                @if(auth()->user() && auth()->user()->admin == 1)
                                    <a class="navbar-dropdown-item dropdown-item btn btn-login"
                                       href="{{ route('admin.index') }}">
                                        Administracja
                                    </a>
                                @endif
                                <a class="navbar-dropdown-item dropdown-item btn btn-login"
                                   href="{{ route('user.orders') }}">
                                    Zamówienia
                                </a>
                                <a class="navbar-dropdown-item dropdown-item btn btn-login" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Wyloguj
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
                            <span>Zamówienie</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="app-body">
        @yield('content')
    </main>

    <footer class="MainContainer-footer container">
        <div class="row">
            <div class="col-12">
                <div class="MainContainer-footer-app"
                     style="background-image: url('{{ asset('public_html/images/banner-app.jpg') }}');">
                    <div class="MainContainer-footer-wrapper">
                        <h4 class="MainContainer-footer--title">Applikacja Compex</h4>
                        <p class="MainContainer-footer--text">Pobierz za darmo aplikacje</p>

                        <div class="MainContainer-footer-buttons">
                            <a class="MainContainer-footer--button"
                               href="https://play.google.com/store/apps/details?id=com.djoglobal.compexcoach">
                                <img class="MainContainer-footer--button--image"
                                     src="{{ asset('public_html/images/google-play.png') }}" alt="Przycisk google play">
                            </a>
                            <a class="MainContainer-footer--button"
                               href="https://s3.amazonaws.com/assets.compex.com/en/support-documents/iPhone-App.png">
                                <img class="MainContainer-footer--button--image"
                                     src="{{ asset('public_html/images/app-store.png') }}" alt="Przycisk app store">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p class="MainContainer-footer--copyright">© {{ date("Y") }} - Wypożyczalnia wykonana przez
                    Netoholics</p>
            </div>
        </div>
    </footer>
</main>
<!-- jQuery -->
<script src="{{ asset('public_html//js/jquery.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('public_html//vendors/bootstrap/dist/js/bootstrap.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset('public_html//vendors/fastclick/lib/fastclick.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- NProgress -->
<script src="{{ asset('public_html//vendors/nprogress/nprogress.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Chart.js -->
<script src="{{ asset('public_html//vendors/Chart.js/dist/Chart.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- gauge.js -->
<script src="{{ asset('public_html//vendors/gauge.js/dist/gauge.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('public_html//vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('public_html//vendors/iCheck/icheck.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Skycons -->
<script src="{{ asset('public_html//vendors/skycons/skycons.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Flot -->
<script src="{{ asset('public_html//vendors/Flot/jquery.flot.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html//vendors/Flot/jquery.flot.pie.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html//vendors/Flot/jquery.flot.time.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html//vendors/Flot/jquery.flot.stack.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html/vendors/Flot/jquery.flot.resize.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- Flot plugins -->
<script src="{{ asset('public_html//vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html/vendors/flot.curvedlines/curvedLines.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- DateJS -->
<script src="{{ asset('public_html/vendors/DateJS/build/date.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- JQVMap -->
<script src="{{ asset('public_html/vendors/jqvmap/dist/jquery.vmap.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('public_html/vendors/moment/min/moment.min.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>
<script src="{{ asset('public_html/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"
        type="db25bb0af1c5ca965d7b8174-text/javascript"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('public_html/js/custom.min.js') }}" type="db25bb0af1c5ca965d7b8174-text/javascript"></script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="db25bb0af1c5ca965d7b8174-|49" defer=""></script>

<!-- Main JS -->
<script src="{{ asset('public_html/js/main.js') }}"></script>

@yield('scripts')
</body>
</html>
