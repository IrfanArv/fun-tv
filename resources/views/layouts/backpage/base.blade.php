<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FUN TV desc">
    <meta name="keywords" content="keyword FUN TV">
    <meta name="author" content="FUN TV">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png')}}">
    <title>@yield('title') - FUN TV</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css')}}"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css" integrity="sha512-rQESClU96g/m7xFESOEisIKXZapchOd6+HfUTaMzGXtBFfF837IDR0utlmq58hgoAqGUWQn9LeZbw2DtOgaWYg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.js" integrity="sha512-thJ99QHPSIGxvufiC1cqtmE5PgfRjYfa8PXpuhjAwiLij9VhATR+lApJU5Y4t7kQepIVq1n9QkAqVx5YIt2UFw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
          <defs></defs>
          <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
          </filter>
        </svg>
      </div>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('layouts/backpage/header')
        <div class="page-body-wrapper horizontal-menu">
        @include('layouts/backpage/sidebar')
        @yield('content')
        @include('layouts/backpage/sidebar')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.js"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('assets/js/config.js')}}"></script>
    <script src="{{ asset('assets/js/prism/prism.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
    <script src="{{ asset('assets/js/custom-card/custom-card.js')}}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js')}}"></script>
    <script src="{{ asset('assets/js/script.js')}}"></script>

    <script>
        $(window).on('load', function() {
            var today = new Date();
            var hourNow = today.getHours();
            var greeting ;
            if (hourNow > 18) {
                greeting = 'Good evening!';
            } else if (hourNow > 12) {
                greeting = 'Good afternoon!';
            } else if (hourNow > 0) {
                greeting = 'Good morning!';
            } else {
                greeting = 'Welcome Back!';
            }
            document.getElementById("greeting").innerHTML = greeting;
        });
    </script>


</body>

</html>
