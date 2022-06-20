<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Funtv desc">
    <meta name="keywords" content="keyword Funtv">
    <meta name="author" content="Funtv">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>Fun TV</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7"><img class="bg-img-cover bg-center"
                    src="{{ asset('assets/images/login/bg.jpg') }}" alt="looginpage"></div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <h1 class="text-center mb-3">FUN TV</h1>
                        </div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('players.login') }}">
                                @csrf
                                <h4>Welcome</h4>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password" placeholder="Password">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                                @if (Route::has('password.request'))
                                    <p class="mt-4 mb-0">Forget Password?<a class="ml-2"
                                            href="{{ route('password.request') }}">Reset Password</a></p>
                                @endif
                            </form>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul class="p-0 m-0" style="list-style: none;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
        <script src="{{ asset('assets/js/config.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
    </div>

</body>

</html>
