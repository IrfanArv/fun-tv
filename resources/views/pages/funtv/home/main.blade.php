@extends('layouts/funtv/main')
@section('title', 'Home')
@section('content')
    @include('pages.funtv.components.header')

    <div class="container-fluid" style="padding: 0!important;">
        <div class="row no-gutters">

            <div class="col-12 d-flex justify-content-center">
                {{-- <div style="position: relative">
                    <a class="full-btn" href="javascript:void(0)" id="full_screen"> <img class="img-fluid full_logo" src="{{ asset('funtv/img/max.svg') }}"></a>
                </div> --}}
                <div id="player"></div>
            </div>
        </div>
    </div>
    
    <div id="content-home" class="mb-3">
        <div class="container border-bottom">
            <div class="row my-3 text-center">
                <div class="col-3">
                    <a class="list-btn" href="javascript:void(0)" id="rank_btn"> <img class="img-fluid"
                            src="{{ asset('funtv/img/rank.svg') }}"></a>
                </div>
                <div class="col-3">
                    <a class="list-btn" href="javascript:void(0)" id="live_chat_btn"> <img class="img-fluid"
                            src="{{ asset('funtv/img/live_chat.svg') }}"></a>
                </div>
                <div class="col-3">
                    <a class="list-btn" href="javascript:void(0)" id="help_btn"> <img class="img-fluid"
                            src="{{ asset('funtv/img/help.svg') }}"></a>
                </div>
                <div class="col-3">
                    <a class="list-btn" href="javascript:void(0)" id="share_btn"> <img class="img-fluid"
                            src="{{ asset('funtv/img/share.svg') }}"></a>
                </div>
            </div>
        </div>
        <div class="container border-bottom">
            <div class="row my-3">
                <div class="col-4">
                    <div class="viewer-count mt-3 ms-3">
                        630 Viewer
                    </div>
                </div>
                <div class="col-8 align-self-end">
                    <img class="img-fluid" src="{{ asset('funtv/img/ava_list.png') }}">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="title mt-4 mb-3">
                Jangan Lewatkan
            </div>
            <div class="row">
                <div class="col-12">
                    <img class="img-fluid" src="{{ asset('funtv/img/jkt_banner.png') }}">
                </div>
                <div class="col-6">
                    <div class="card" style="background-color: #FFB824">
                        <div class="card-body">
                          <div class="card-banner-title mt-5">
                            Promotion.
                          </div>
                          <p class="content-banner mt-2">
                            This is area for marketing program
                          </p>
                        </div>
                      </div>
                </div>
                <div class="col-6">
                    <div class="card" style="background-color: #97248C">
                        <div class="card-body">
                          <div class="card-banner-title mt-5">
                            Feature.
                          </div>
                          <p class="content-banner mt-2">
                            This is area for marketing program
                          </p>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    <div id="stream_empty" style="display: none;">
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-6 mx-auto">
                    <div class="jumbotron text-center">
                        <h4 class="mb-3">No streaming at this time!</h4>
                        <lottie-player src="https://assets10.lottiefiles.com/private_files/lf30_iHPAva.json"
                            background="transparent" speed="1" style="height: 250px;" loop autoplay></lottie-player>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
    <script type="text/javascript">
        var streamID = "{{ $streamKey }}";
        if (streamID !== "") {
            var tag = document.createElement("script");
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName("script")[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            function onYouTubeIframeAPIReady() {
                player = new YT.Player("player", {
                    videoId: streamID,
                    playerVars: {
                        modestbranding: 1,
                        rel: 0,
                        autoplay: 1,
                        enablejsapi: 1,
                        disablekb: 1,
                        showinfo: 0,
                        controls: 1,
                        fs: 1,
                    },
                    events: {
                        onReady: onPlayerReady,
                        onStateChange: onPlayerStateChange
                    }
                });
            }

            function onPlayerReady(event) {
                event.target.playVideo();
            }
            var done = false;

            function onPlayerStateChange(event) {
                if (event.data === YT.PlayerState.ENDED) {
                    stopVideo();
                }
            }

            function stopVideo() {
                player.stopVideo();
            }
        } else {
            $("#stream_empty").show();
        }
    </script>
@endsection
