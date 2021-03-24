<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="andreasyulianto3@gmail.com">
    <meta name="author" content="re">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" href="{{ asset('img/pkkp_favicon.png') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('img/pkkp_favicon.png') }}" type="image/x-icon" />

    @yield('customStyle')

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
</head>
<body style="background-color: #dee9ff;">
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('img/pkkp_favicon.png') }}" alt="" class="img-fluid">
                    {{ config('PKKP 2021', 'PKKP 2021') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('js/sweetalert2.js') }}"></script>

    {{-- <script>
        M.AutoInit()
    </script> --}}

    @if (Session::has('status') && Session::get('status') == 'nik-not-found')
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Ups!',
            text: 'NIK tidak ditemukan',
            showConfirmButton: false,
            timer: 1200
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'have-attend')
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Maaf!',
            text: 'Anda sudah Absen',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'not-open')
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Maaf!',
            text: 'Absensi belum dibuka',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'no-weekday')
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Maaf!',
            text: 'Absensi hanya untuk 5 hari kerja',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'not-open-date')
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Maaf!',
            text: 'Absensi dibuka 22 Maret 2021',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'done')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat!',
            text: 'Absensi Tersimpan',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @endif

    @yield('script')
</body>
</html>
