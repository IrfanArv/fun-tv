@extends('layouts/funtv/main')
@section('title', 'Sign in')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center mt-5">
                <div class="greetings mt-5">
                    Hi!
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center text-center mt-1 px-5">
                <p><span class="sub-greetings">Untuk gabung masukin dulu No. handphone kamu</span></p>
            </div>
            <form action="{{ route('players.login') }}" method="POST" class="px-5 mt-2 mb-1">
                @csrf
                <input id="phone" type="number"
                    class="form-control auth-area form-control-lg @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" required autocomplete="email" autofocus>
                <span class="help d-flex justify-content-center text-center mt-1">Contoh: 0892345678910</span>
                <div class="fixed-bottom">
                    <div class="d-grid gap-1">
                        <button class="btn btn-lg btn-auth" type="submit">Request OTP</button>
                    </div>
                </div>
            </form>
            @if (count($errors) > 0)
                <div class="col-12 px-5">
                    <div class="alert alert-light alert-dismissible fade show px-2 mt-5" role="alert">
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
