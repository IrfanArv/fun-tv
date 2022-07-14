@extends('layouts/funtv/main')
@section('title', 'Home')
@section('content')
    @include('pages.funtv.components.header')
    <div class="container-fluid" style="padding: 0!important;" id="playerComponent">
        @include('pages.funtv.components.player')
    </div>
    <div id="homeComponent" class="mb-3">
        @include('pages.funtv.components.home')
    </div>
    <div id="quizComponent"class="mb-3">
        @include('pages.funtv.components.quiz')
    </div>
    <div id="chatComponent"class="mb-3" style="display: none;">
        @include('pages.funtv.components.chat')
    </div>
    {{-- rank --}}
    <div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" id="offcanvasBottom"
        tabindex="-1" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-body">
            <div class="rank-area">
                <div class="row">
                    <div class="col-6">
                        <div class="title-rank">
                            Funrank.
                        </div>
                    </div>
                    <div class="col-6 ms-auto">
                        <button class="btn-close text-reset float-end" type="button" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                </div>
                <div class="sub-title-rank">
                    Now who’s the boss?
                </div>
                <div class="mt-3">
                    <div class="lead">
                        <table class="table">
                            <tbody class="show_score">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- help --}}
    <div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" id="helpcontent" tabindex="-1"
        aria-labelledby="helpcontentLabel">
        <div class="offcanvas-body">
            <div class="rank-area">
                <div class="row">
                    <div class="col-6">
                        <div class="title-rank">
                            Help
                        </div>
                    </div>
                    <div class="col-6 ms-auto">
                        <button class="btn-close text-reset float-end" type="button" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                </div>
                <div class="mt-3">
                    <h6>Content here ...</h6>
                </div>
            </div>
        </div>
    </div>
    {{-- canvas player --}}
    <div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" id="canvasPlayer"
        tabindex="-1" aria-labelledby="canvasPlayerLabel">
        <div class="offcanvas-body">
            <div class="rank-area">
                <div class="row">
                    <div class="col-6">
                        <div class="title-rank">
                            Players Active
                        </div>
                    </div>
                    <div class="col-6 ms-auto">
                        <button class="btn-close text-reset float-end" type="button" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="lead">
                        <table class="table">
                            <tbody class="show_player">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function getProfile() {
            var defaultAva = '{{ asset('funtv/img/ava_default.svg') }}';
            $.ajax({
                type: "GET",
                url: SITEURL + "/profile",
                dataType: "JSON",
                async: true,
                success: function(data) {
                    if (data.success = true) {
                        var canvasProifle = new bootstrap.Offcanvas(offcanvasRight);
                        canvasProifle.show();
                        var profile = data.data;
                        if (profile.image == null || profile.image == '') {
                            $('#avatarImg').attr('src', defaultAva);
                        } else {
                            $('#avatarImg').attr('src', profile.image);
                            $('#avatar').val(profile.image);
                        }
                        $('#username').val(profile.username);
                        $('#fullname').val(profile.name);
                        $('#bio').val(profile.bio);
                        $('#brithday').val(profile.brith);
                        $('#gender').val(profile.gender);
                        $('#mobile').val(profile.phone);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }

            });
        }

        function rank_btn() {
            $.ajax({
                type: "GET",
                url: SITEURL + "/leadboard",
                dataType: "JSON",
                async: true,
                success: function(data) {
                    if (data.success = true) {
                        var html = '';
                        var count = 1;
                        var i;
                        var lead = data.leadboard;
                        var bsOffcanvas = new bootstrap.Offcanvas(offcanvasBottom);
                        bsOffcanvas.show();
                        $(window).scrollTop(0);
                        for (i = 0; i < lead.length; i++) {
                            var phone = lead[i].phone;
                            var image = lead[i].image;
                            var hidePhone = phone.slice(0, 2) + phone.slice(2).replace(/.(?=...)/g, '*');
                            if (image == null || image == '') {
                                var source = 'https://via.placeholder.com/150';
                            } else {
                                var source = image;
                            }
                            html += '<tr>' +
                                '<td><div class="rank">' + count++ + '</div></td>' +
                                '<td><div class="name"><img class="img-30 rounded-circle me-2" src="' + source +
                                '">' + lead[i].username + '</div></td>' +
                                '<td class="point">' + lead[i].total_point + ' pts </td>' +
                                '</tr>';
                        }
                        $('.show_score').html(html);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
            window.Echo.channel('rank').listen('leadboard', (event) => {
                var html = '';
                var count = 1;
                var i;
                var dataLead = event.ranking.original.leadboard;
                for (i = 0; i < dataLead.length; i++) {
                    var image = dataLead[i].image;
                    if (image == null || image == '') {
                        var source = 'https://via.placeholder.com/150';
                    } else {
                        var source = image;
                    }
                    html += '<tr>' +
                        '<td><div class="rank">' + count++ + '</div></td>' +
                        '<td><div class="name"><img class="img-30 rounded-circle me-2" src="' + source +
                        '">' + dataLead[i].username + '</div></td>' +
                        '<td class="point">' + dataLead[i].total_point + ' pts </td>' +
                        '</tr>';
                }
                $('.show_score').html(html);
            });
        }
        var SITEURL = '{{ URL::to('') }}';
        $('document').ready(function() {
            $.ajax({
                type: "GET",
                url: SITEURL + "/questions",
                success: function(data) {
                    if (data.success == true) {
                        if (document.fullscreenElement) {
                            document.exitFullscreen();
                        }
                        var questImg = data.quest.image;
                        if (questImg != null) {
                            $("#playerComponent").hide();
                            $('#img-quest').attr('src', '{{ URL::to('/img/question') }}' +
                                '/' + questImg);
                        } else {
                            $("#playerComponent").show();
                        }
                        $("#homeComponent").hide();
                        $("#chatComponent").hide();
                        $("#quizComponent").show();
                        $("#quest_title").html(data.quest.title);
                        var answerData = data.answer;
                        var answerEleme = $("#answers");
                        var questId = data.quest.id;
                        $.each(answerData, function(key, value) {
                            answerEleme.append($(
                                "<div class='question-answer' data-quest='" + questId +
                                "' onclick='getAnswer(" +
                                value.id + ")'>").text(
                                value.answer_choice));
                        });
                        $('html, body, #question-page').animate({
                            scrollTop: $("#answers").offset().top
                        });
                        var waktu_quiz = data.quest.date_end;
                        const second = 1000,
                            minute = second * 60,
                            hour = minute * 60,
                            day = hour * 24;
                        var total_waktu = waktu_quiz,
                            countDown = new Date(total_waktu.replace(' ', 'T')).getTime(),
                            x = setInterval(function() {
                                var now = new Date().getTime(),
                                    distance = countDown - now;
                                document.getElementById("minutes").innerText = Math.floor((
                                        distance % (hour)) / (minute)),
                                    document.getElementById("seconds").innerText = Math.floor((
                                            distance % (minute)) /
                                        second);
                                if (distance < 0) {
                                    clearInterval(x);
                                    $("#homeComponent").show();
                                    $("#quizComponent").hide();
                                    $("#playerComponent").show();
                                    $("#chatComponent").hide();
                                    $('html, body').animate({
                                        scrollTop: $("#playerComponent").offset().top
                                    });
                                }
                            }, 0)
                    } else {
                        $("#homeComponent").show();
                        $("#quizComponent").hide();
                        $("#playerComponent").show();
                        $("#chatComponent").hide();
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
        // pusher
        window.Echo.channel('quiz').listen('PushQuiz', (event) => {
            var answerData = event.detailQuestion;
            var answerEleme = $("#answers");
            var questId = event.quest.id;
            var questImg = event.quest.image;
            if (questImg != null) {
                $("#playerComponent").hide();
                $('#img-quest').attr('src', '{{ URL::to('/img/question') }}' + '/' + questImg);
            } else {
                $("#playerComponent").show();
            }
            $.each(answerData, function(key, value) {
                answerEleme.append($("<div class='question-answer' data-quest='" + questId +
                        "' onclick='getAnswer(" + value.id + ")'>")
                    .text(
                        value.answer_choice));
            });

            $("#homeComponent").hide();
            $("#chatComponent").hide();
            $("#quizComponent").show();
            if (document.fullscreenElement) {
                document.exitFullscreen();
            }

            $('html, body, #question-page').animate({
                scrollTop: $("#answers").offset().top
            });
            // event quiz
            var waktu_quiz = event.quest.date_end;
            $("#quest_title").html(event.quest.title);
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;

            var total_waktu = waktu_quiz,
                countDown = new Date(total_waktu.replace(' ', 'T')).getTime(),
                x = setInterval(function() {
                    var now = new Date().getTime(),
                        distance = countDown - now;
                    document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                        document.getElementById("seconds").innerText = Math.floor((distance % (minute)) /
                            second);
                    if (distance < 0) {
                        // waktu habis
                        clearInterval(x);
                        $("#playerComponent").show();
                        $("#homeComponent").show();
                        $("#quizComponent").hide();
                        $('html, body').animate({
                            scrollTop: $("#playerComponent").offset().top
                        });
                    }
                }, 0)


        });

        const share_btn = document.getElementById("share_btn");
        if (navigator.share) {
            share_btn.addEventListener("click", async () => {
                try {
                    await navigator.share({
                        title: "Fun TV",
                        text: "Yukk ikuti keseruannya di FUN TV",
                        url: "https://funtv.id",
                    });
                    console.log("Data was shared successfully");
                } catch (err) {
                    console.error("Share failed:", err.message);
                }
            });
        } else {
            console.log("Your Browser doesn't support Web Share API");
        }

        function live_chat() {
            $.ajax({
                type: "GET",
                url: SITEURL + "/chats",
                dataType: "JSON",
                async: true,
                success: function(data) {
                    if (data.status = true) {
                        $('#notifChat').hide();
                        $("#homeComponent").hide();
                        $("#chatComponent").show();
                        $('#conversations').focus();
                        $("#chat-wrapper").animate({
                            scrollTop: $('#chat-wrapper').prop("scrollHeight")
                        });
                        var html = '';
                        var count = 1;
                        var i;
                        var chats = data.chat;
                        var myChat = data.mychat;
                        for (i = 0; i < chats.length; i++) {
                            var image = chats[i].image;
                            var playerChat = chats[i].player_id;
                            var time = new Date(chats[i].created_at);
                            var sendChat = time.getHours() + ':' + (time.getMinutes() < 10 ? '0' : '') + time
                                .getMinutes();
                            if (image == null || image == '') {
                                var source = 'https://via.placeholder.com/50';
                            } else {
                                var source = image;
                            }
                            if (myChat === playerChat) {
                                html += '<div class="single-chat-item outgoing">' +
                                    '<div class="user-avatar"><img src="' + source + '"></div>' +
                                    '<div class="user-message"><div class="message-content"><div class="single-message"><p>' +
                                    chats[i].conversation +
                                    '</p></div></div><div class="message-time-status"><div class="sent-time">' +
                                    sendChat +
                                    '</div><div class="sent-status seen"><i class="fa-solid fa-check-double"></i></div></div></div>' +
                                    '</div>';
                            } else {
                                html += '<div class="single-chat-item">' +
                                    '<div class="user-avatar"><img src="' + source + '"></div>' +
                                    '<div class="user-message"><div class="message-content"><div class="single-message"><p>' +
                                    chats[i].conversation +
                                    '</p></div></div><div class="message-time-status"><div class="sent-time">' +
                                    sendChat + '</div></div></div>' +
                                    '</div>';
                            }

                        }
                        $('.chat-content-wrap').html(html);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }

        function closeChat() {
            $('#notifChat').hide();
            $("#homeComponent").show();
            $("#chatComponent").hide();
        }
        // help
        function help() {
            var canvasHelp = new bootstrap.Offcanvas(helpcontent);
            canvasHelp.show();
        }
        // listen players
        $('document').ready(function() {
            $.ajax({
                type: "GET",
                url: SITEURL + "/lister-players",
                success: function(data) {
                    if (data.success == true) {
                        var listener = $("#listeners");
                        listener.html(data.total_player + ' Viewer')
                        var html = '';
                        var count = 1;
                        var i;
                        if (data.total_player > 5) {
                            var image = 'https://via.placeholder.com/50';
                            html +=
                                '<div class="avatars__item"><div class="avatars__image"><img class="img-40 rounded-circle border border-light" src="' +
                                image + '"></div>' +
                                '</div>';
                            $('.avatars').html(html);
                        }
                        var listAvatar = data.ava_list.slice(-5);
                        for (i = 0; i < listAvatar.length; i++) {
                            var image = listAvatar[i].image;
                            if (image == null || image == '') {
                                var ava = 'https://via.placeholder.com/50';
                            } else {
                                var ava = image;
                            }
                            html +=
                                '<div class="avatars__item"><div class="avatars__image"><img class="img-40 rounded-circle" src="' +
                                ava + '"></div>' +
                                '</div>';
                        }
                        $('.avatars').html(html);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
        window.Echo.channel('online-players').listen('listenPlayers', (event) => {
            var dataPlayer = event.getPlayer;
            var image = dataPlayer.image;
            var totalPlayer = event.count;
            var listener = $("#listeners");
            var html = '';
            listener.html(totalPlayer + ' Viewer');
            if (totalPlayer > 5) {
                var image = 'https://via.placeholder.com/50';
                html +=
                    '<div class="avatars__item"><div class="avatars__image"><img class="img-40 rounded-circle border border-light" src="' +
                    image + '"></div>' +
                    '</div>';
                $('.avatars').html(html);
            }
            if (image == null || image == '') {
                var ava = 'https://via.placeholder.com/50';
            } else {
                var ava = image;
            }
            html +=
                '<div class="avatars__item"><div class="avatars__image"><img class="img-40 rounded-circle" src="' +
                ava + '"></div>' +
                '</div>';
            $('.avatars').append(html);
        });

        function getOnlineUser() {
            $.ajax({
                type: "GET",
                url: SITEURL + "/lister-players",
                dataType: "JSON",
                async: true,
                success: function(data) {
                    if (data.success == true) {
                        var html = '';
                        var count = 1;
                        var i;
                        var allactive = data.ava_list;
                        var bsOffcanvas = new bootstrap.Offcanvas(canvasPlayer);
                        bsOffcanvas.show();
                        $(window).scrollTop(0);
                        for (i = 0; i < allactive.length; i++) {
                            var image = allactive[i].image;
                            if (image == null || image == '') {
                                var source = 'https://via.placeholder.com/150';
                            } else {
                                var source = image;
                            }
                            html += '<tr>' +
                                '<td><div class="number_ava">' + count++ + '</div></td>' +
                                '<td><div class="name"><img class="img-30 rounded-circle me-2" src="' + source +
                                '">' + allactive[i].username + '</div></td>' +
                                '</tr>';
                        }
                        $('.show_player').html(html);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>
@endsection
