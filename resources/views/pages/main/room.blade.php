@extends('layouts/frontpage/base')
@section('title', $nameRoom)
@section('content')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <section class="gen-section-padding-3 gen-single-movie">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div id="stream_empty" style="display: none;">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-6 mx-auto">
                                    <div class="jumbotron text-center">
                                        <h4 class="mb-3 text-dark">No streaming at this time!</h4>
                                        <lottie-player src="https://assets10.lottiefiles.com/private_files/lf30_iHPAva.json"
                                            background="transparent" speed="1" style="height: 250px;" loop autoplay>
                                        </lottie-player>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gen-single-movie-wrapper style-1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gen-video-holder">
                                    <div id="player"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
