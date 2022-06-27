@extends('layouts/frontpage/base')
@section('title', 'FUN TV')
@section('content')
    <section class="gen-section-padding-2 pt-0 pb-0">
        <div class="container-fluid px-0">
            <div class="gen-nav-movies gen-banner-movies">
                <div class="row no-gutters">
                    <div class="col-lg-12">
                        <div class="slider slider-for">
                            @foreach ($data as $key => $room)
                                <div class="slider-item" style="background: url('{{ '/img/room/' . $room->image }}')">
                                    <div class="gen-slick-slider h-100">
                                        <div class="gen-movie-contain h-100">
                                            <div class="container h-100">
                                                <div class="row align-items-center h-100">
                                                    <div class="col-lg-6">
                                                        @if (session('error'))
                                                            <div class="col-sm-12">
                                                                <div class="alert  alert-danger alert-dismissible fade show"
                                                                    role="alert">
                                                                    {{ session('error') }}
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="gen-movie-info">
                                                            <h3>{{ $room->name }}</h3>
                                                            <p> {{ strip_tags($room->desc) }}</p>
                                                        </div>
                                                        <div class="gen-movie-action">
                                                            <div class="gen-btn-container button-1">
                                                                <a class="gen-button"
                                                                    href="{{ url('/watch?stream=' . $room->stream_key) }}"
                                                                    target="_blank" tabindex="0">
                                                                    <i aria-hidden="true" class="ion ion-play"></i>
                                                                    <span class="text">Watch Now</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="slider slider-nav">
                            @foreach ($data as $key => $room)
                                <div class="slider-nav-contain">
                                    <div class="gen-nav-img">
                                        <img src="{{ '/img/room/' . $room->image }}" alt="{{ $room->name }}">
                                    </div>
                                    <div class="movie-info">
                                        <h3>{{ $room->name }}</h3>
                                        <div class="gen-movie-meta-holder">
                                            <ul>
                                                <li></li>
                                                <li></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
