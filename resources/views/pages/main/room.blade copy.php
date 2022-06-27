<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FUN TV">
    <meta name="keywords" content="FUN TV">
    <meta name="author" content="FUN TV">
    <title>{{ $title }} - FUN TV</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/game.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lead.css') }}">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</head>

<body>
    <div class="container-fluid" style="padding: 0!important;">
        <div class="row no-gutters">
            <div class="col-12 d-flex justify-content-center">
                <h5 class="mt-2 mb-2"> Hello {{ Auth::guard('players')->user()->name }}, <span> Welcome to
                        {{ $title }}</span> </h5>
            </div>
            <div class="col-12 d-flex justify-content-center mb-2"> 
                <a href="{{ route('players.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('players.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div id="player"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.js"></script>
    <script src="/js/app.js"></script>
    <script type="text/javascript">
        var streamID = "{{ $streamId }}";
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
</body>

</html>
