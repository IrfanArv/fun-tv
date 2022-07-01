<div class="row no-gutters">
    <div class="col-12 d-flex justify-content-center">
        <div style="position: relative">
            <a class="full-btn" href="javascript:void(0)" onclick="fullscreen()"> <img class="img-fluid full_logo"
                    src="{{ asset('funtv/img/max.svg') }}"></a>
        </div>
        <div id="player"></div>
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
                    controls: 0,
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

    function fullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        }
    }
</script>
