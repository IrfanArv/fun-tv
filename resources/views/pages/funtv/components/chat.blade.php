<div class="container">
    <div class="row my-3">
        <div class="rank-area">
            <div class="row">
                <div class="col-6">
                    <div class="title-rank">
                        Funchat.
                    </div>
                </div>
                <div class="col-6 ms-auto">
                    <button class="btn-close text-reset float-end" type="button" onclick="closeChat()"></button>
                </div>
            </div>
            <div class="mt-3">
                <div id="chat-wrapper">
                    <div class="chat-content-wrap">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="chat-footer">
    <div class="container h-100">
        <div class="chat-footer-content h-100 d-flex align-items-center">
            <form id="liveChat" name="liveChat" enctype="multipart/form-data">
                <input class="form-control" name="conversations" id="conversations" type="text"
                    placeholder="Type here...">
                <button class="btn btn-submit ms-2" type="submit">
                    <svg class="bi bi-cursor" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var SITEURL = '{{ URL::to('') }}';
    var playerId = '{{ $playerId }}';
    $(document).ready(function() {
        $('body').on('submit', '#liveChat', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/store-chat",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#liveChat').trigger("reset");
                },
            });
        });
    });
    window.Echo.channel('conversations').listen('liveChat', (event) => {
        var html = '';
        if (event.playerImage == null) {
            var source = 'https://via.placeholder.com/50';
        } else {
            var source = event.playerImage;
        }

        var time = new Date(event.sendTime);
        var sendChat = time.getHours()+ ':' + (time.getMinutes()<10?'0':'') + time.getMinutes();
        var chat = event.conversations;
        var ownerChat = event.playerId;
        if (ownerChat == playerId) {
            html += '<div class="single-chat-item outgoing">' +
                '<div class="user-avatar"><img src="' + source + '"></div>' +
                '<div class="user-message"><div class="message-content"><div class="single-message"><p>' +
                chat +
                '</p></div></div><div class="message-time-status"><div class="sent-time">' + sendChat +
                '</div><div class="sent-status seen"><i class="fa-solid fa-check-double"></i></div></div></div>' +
                '</div>';
        } else {
            html += '<div class="single-chat-item">' +
                '<div class="user-avatar"><img src="' + source + '"></div>' +
                '<div class="user-message"><div class="message-content"><div class="single-message"><p>' +
                chat +
                '</p></div></div><div class="message-time-status"><div class="sent-time">' + sendChat +
                '</div></div></div>' +
                '</div>';
        }
        $("#chat-wrapper").animate({
            scrollTop: $('#chat-wrapper').prop("scrollHeight")
        });
        $('.chat-content-wrap').append(html);
        $('#notifChat').show();
    });
</script>
