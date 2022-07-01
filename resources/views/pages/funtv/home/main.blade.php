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

    <script src="/js/app.js"></script>

    <script type="text/javascript">
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
                        $("#homeComponent").hide();
                        $("#quizComponent").show();
                        $("#quest_title").html(data.quest.title);
                        var answerData = data.answer;
                        var answerEleme = $("#answers");
                        $.each(answerData, function(key, value) {
                            answerEleme.append($("<div class='question-answer' answer-id='" + value.id + "'>").text(
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
                                    // waktu habis
                                    clearInterval(x);
                                    $("#homeComponent").show();
                                    $("#quizComponent").hide();
                                }
                            }, 0)
                    } else {
                        $("#homeComponent").show();
                        $("#quizComponent").hide();
                    }
                    // $('#modal-preview').attr('alt', 'No image available');
                    // if (data.image) {
                    //     $('#modal-preview').attr('src', '{{ URL::to('/img/user') }}' +
                    //         '/' + data.image);
                    //     $('#hidden_image').attr('src', '{{ URL::to('/img/user') }}' +
                    //         '/' + data.image);
                    // }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
        window.Echo.channel('quiz').listen('PushQuiz', (event) => {
            var answerData = event.detailQuestion;
            var answerEleme = $("#answers");
            $.each(answerData, function(key, value) {
                answerEleme.append($("<div class='question-answer' answer-id='" + value.id + "'>").text(
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
                        $("#homeComponent").show();
                        $("#quizComponent").hide();
                    }
                }, 0)


        });
    </script>
@endsection
