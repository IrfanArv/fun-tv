<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="keywords" content="Fun TV" />
    <meta name="description" content="Fun TV" />
    <meta name="author" content="EDM" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('main/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('main/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('main/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('main/css/responsive.css') }}" />


</head>

<body>
    @include('layouts/frontpage/header')
    @yield('content')
    <script src="{{ asset('main/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.js"></script>
    <script src="{{ asset('main/js/asyncloader.min.js') }}"></script>
    <script src="{{ asset('main/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('main/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('main/js/jquery.counterup.min.js') }}"></script>
    
    <script src="{{ asset('main/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('main/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('main/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('main/js/slick.min.js') }}"></script>
    <script src="{{ asset('main/js/streamlab-core.js') }}"></script>
    <script src="{{ asset('main/js/script.js') }}"></script>
</body>

</html>
