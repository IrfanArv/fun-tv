@extends('layouts/frontpage/base')
@section('title', 'Register - FUN TV')
@section('content')
    <section class="position-relative pb-0">
        <div class="gen-login-page-background" style="background-image: url('{{ asset('main/images/bg.jpg') }}');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <form name="pms_login" id="pms_login" method="POST" action="{{ route('players.register') }}">
                            @csrf
                            <h4>Register</h4>
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
                            <p class="login-username">
                                <label>Email Address</label>
                                <input id="email" type="email" class="input @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Email Address">
                            </p>
                            <p class="login-password">
                                <label>Password</label>
                                <input type="password" class="input @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="Password">
                            </p>
                            <p class="login-password">
                                <label>Confirm Password</label>
                                <input type="password" class="input"
                                    name="password_confirmation" required autocomplete="current-password"
                                    placeholder="Confirm Password">
                            </p>
                            <p class="login-submit">
                                <button class="btn button button-primary" type="submit">Register</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
