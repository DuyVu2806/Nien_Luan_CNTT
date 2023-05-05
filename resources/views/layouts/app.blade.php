<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/navbar.css') }}">
    <!-- Scripts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    @yield('style')
    @livewireStyles
</head>

<body>
    <style>
        body {
            background-color: #ebe8e8
        }

        html {
            scroll-behavior: smooth;
        }
/* 
        nav {
            position: fixed;
            width: 100%;
            z-index: 1000000;
            top: 0;
        } */
    </style>
    <div id="app" class="position-relative">
        @include('layouts.inc.frontend.navbar')
        <main class="container" >
            <div class="py-3 py-md-2 bg-light" style="min-height: 1000px">
                @yield('content')
            </div>
        </main>
        @include('layouts.inc.frontend.footer')
        <div class="position-fixed" style="bottom:5% ; right: 3%">
            <a href="#"><i class="fa fa-arrow-up text-primary" style="font-size: 35px"></i></a>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/frontend/main.js') }}"></script>
    <script src="{{ asset('assets/js/frontend/popper.js') }}"></script>
    <script src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
    @yield('scripts')
    @livewireScripts
    @stack('scripts')
</body>

</html>
