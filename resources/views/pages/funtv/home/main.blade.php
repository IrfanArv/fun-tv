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

    <div id="funrank" tabindex="-1" class="overlay">
        <div class="rank-area">
            <div class="title-rank">
                Funrank.
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
        <a href="#" class="btn-close" aria-hidden="true"><span class="mdi mdi-close"></span></a>
    </div>

    <script src="/js/app.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            removehash();
        });

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
                        window.location.hash = "#funrank";
                        var lead = data.leadboard;
                        for (i = 0; i < lead.length; i++) {
                            var phone =lead[i].phone;
                            var image =lead[i].image;
                            var hidePhone =  phone.slice(0, 2) + phone.slice(2).replace(/.(?=...)/g, '*');
                            if (image == null || image == '') {
                                var source = 'https://via.placeholder.com/150';
                            } else {
                                var source = '{{ URL::to('/img/players') }}' +
                                '/' + image;
                            }
                            html += '<tr>' +
                                '<td><div class="rank">' + count++ + '</div></td>' +
                                '<td><div class="name"><img class="img-30 rounded-circle me-2" src="'+ source +'">' + hidePhone + '</div></td>' +
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
        }
        var SITEURL = '{{ URL::to('') }}';
        $('document').ready(function() {
            removehash();
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
                                }
                            }, 0)
                    } else {
                        $("#homeComponent").show();
                        $("#quizComponent").hide();
                        $("#playerComponent").show();
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
                $('#img-quest').attr('src', '{{ URL::to('/img/question') }}' +
                    '/' + questImg);
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
            $("#quizComponent").show();
            if (document.fullscreenElement) {
                document.exitFullscreen();
            }
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
                    }
                }, 0)


        });

        function removehash() {
            setTimeout(function() {
                history.replaceState("", document.title, window.location.pathname);
            }, 1);
        }
    </script>
@endsection
