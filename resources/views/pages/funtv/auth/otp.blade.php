@extends('layouts/funtv/main')
@section('title', 'Request OTP')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center mt-5">
                <div class="title-otp mt-5">
                    KODE OTP
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center text-center mt-1 px-5">
                <p><span class="sub-greetings">Ok, sekarang masukin kode verifikasi yang barusan kami kirim via SMS</span>
                </p>
            </div>
            <form action="{{ route('players.otp') }}" method="POST" class="px-5 mt-2 mb-1">
                @csrf
                <input id="otp_key" type="number"
                    class="form-control auth-area form-control-lg @error('otp_key') is-invalid @enderror" name="otp_key"
                    value="{{ old('otp_key') }}" required autocomplete="otp_key" autofocus>
                <button class="btn btn-help d-flex justify-content-center mx-auto mt-1"> <img class="img-fluid me-1 mt-1"
                        src="{{ asset('funtv/img/refresh.svg') }}" alt=""> Kirim Ulang</button>
                <div class="fixed-bottom">
                    <div class="d-grid gap-1">
                        <button class="btn btn-lg btn-auth" type="submit">Submit</button>
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
