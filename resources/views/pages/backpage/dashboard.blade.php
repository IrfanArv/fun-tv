@extends('layouts/backpage/base')
@section('title', 'Dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-12">
                        <h5> Hello {{ Auth::user()->name }}, <span id="greeting"></span> 👋 </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="default-according style-1" id="accordionoc">
                        @foreach ($room as $key => $room)
                            <div class="card mb-3">
                                <div class="card-header bg-primary">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-white" data-toggle="collapse"
                                            data-target="#collapseicon_{{ $room->id }}" aria-expanded="true"
                                            aria-controls="collapse11"><i class="icofont icofont-video-cam"></i>
                                            {{ $room->name }} </button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapseicon_{{ $room->id }}"
                                    aria-labelledby="collapseicon" data-parent="#accordionoc">
                                    <div class="card-body">
                                        <div class="row">
                                            @php
                                            $questionList = App\Models\Question::where('room_id', '=', $room->id)->get();
                                            $questionTotal = $questionList->count();
                                        @endphp
                                            <div class="col-xl-4 col-md-6 col-sm-6">
                                                <div class="media p-0">
                                                    <div class="media-body">
                                                        <h6>Trivia Quiz <a class="mt-3" href="{{ route('quiz_by_room',$room->id) }}"><i data-feather="book-open"></i></a></h6>
                                                        <p>{{ $questionTotal }} Questions </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-12 pe-0">
                                                <div class="media p-0">
                                                    <div class="media-body">
                                                        <h6>Stream Link</h6>
                                                        <a href="https://www.youtube.com/watch?v={{ $room->stream_key }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            class="btn btn-sm btn-pill btn-light btn-air-light">Open on
                                                            Youtube</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="header-top">
                                            <h5 class="mt-5">Trivia Quiz</h5>
                                        </div>
                                        <div class="our-product">
                                            <div class="table-responsive">
                                                <table class="table table-bordernone" id="table_quiz">
                                                    <tbody class="f-w-500">
                                                        @php
                                                            $question = App\Models\Question::where('room_id', $room->id)
                                                                ->orderBy('status', 'ASC')
                                                                ->get();
                                                        @endphp
                                                        @if ($question->isEmpty())
                                                            <h6 class="mt-1 text-danger">Masih Kosong 😔</h6>
                                                            <a href="{{ route('quiz_by_room', $room->id) }}"
                                                                target="_blank" class="btn btn-sm btn-outline-success">Buat
                                                                Pertanyaan</a>
                                                        @else
                                                            @foreach ($question as $key => $quest)
                                                                <script type="text/javascript">
                                                                    $('document').ready(function() {
                                                                        var status_quiz = "{{$quest->status}}";
                                                                        var quiz_akhir = "{{$quest->date_end}}";
                                                                        var question_id = "{{$quest->id}}";
                                                                        if (status_quiz == 2) {
                                                                            const second = 1000,
                                                                                minute = second * 60,
                                                                                hour = minute * 60,
                                                                                day = hour * 24;
                                                                            var selesai = quiz_akhir,
                                                                                countDown = new Date(selesai.replace(' ', 'T')).getTime(),
                                                                                x = setInterval(function() {
                                                                                    var now = new Date().getTime(),
                                                                                        distance = countDown - now;
                                                                                    document.getElementById("minutes_"+ question_id).innerText = Math.floor((
                                                                                            distance % (hour)) / (minute)),
                                                                                        document.getElementById("seconds_"+ question_id).innerText = Math
                                                                                        .floor((distance % (minute)) / second);
                                                                                    if (distance < 0) {
                                                                                        clearInterval(x);
                                                                                        $.ajax({
                                                                                            url: SITEURL + "/dashboard/stop-quiz/" + question_id,
                                                                                            type: "GET",
                                                                                            dataType: "JSON",
                                                                                            success: function(data) {
                                                                                                $("#table_quiz").load(window.location.href + " #table_quiz");
                                                                                                swal("Success", "Quiz selesai dijalankan", "success");
                                                                                            }
                                                                                        });
                                                                                        var countdown = document.getElementById("countdown_"+ question_id);
                                                                                        countdown.style.display = "none";
                                                                                        clearInterval(x);
                                                                                    }
                                                                                }, 0)
                                                                        }
                                                                    });
                                                                </script>
                                                                <tr>
                                                                    <td>
                                                                        <div class="media">
                                                                            @if ($quest->image)
                                                                                <img class="img-40 m-r-15 rounded-circle"
                                                                                    src="{{ '/img/question/' . $quest->image }}"
                                                                                    alt="{{ $quest->title }}"
                                                                                    style="height: 40px">
                                                                            @endif

                                                                            <div class="media-body mt-3">
                                                                                <span>{{ strip_tags($quest->title) }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <p>Point</p><span>{{ $quest->point }}</span>
                                                                    </td>
                                                                    <td id="countdown_{{ $quest->id }}">
                                                                        <p>Waktu</p>
                                                                        <span id="minutes_{{ $quest->id }}">{{ $quest->time }} Menit</span>
                                                                        <span id="seconds_{{ $quest->id }}"></span>
                                                                    </td>
                                                                    <td id="button_quiz">
                                                                        @if ($quest->status == 1)
                                                                            <button
                                                                                class="btn btn-pill btn-success btn-air-success text-center"
                                                                                onclick="pushQuiz({{ $quest->id }});"
                                                                                type="button">Push Quiz</button>
                                                                        @elseif ($quest->status == 2)
                                                                            <button
                                                                                class="btn btn-pill btn-warning btn-air-warning text-center text-white"
                                                                                disabled type="button">Running</button>
                                                                        @elseif ($quest->status == 3)
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <button
                                                                                class="btn btn-pill btn-primary btn-air-primary text-center text-white"
                                                                                onclick="resetQuiz({{ $quest->id }});" type="button">Reset</button>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <button
                                                                                class="btn btn-pill btn-danger btn-air-danger text-center text-white"
                                                                                disabled type="button">Done</button>
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                            <button
                                                                                class="btn btn-pill btn-danger btn-air-danger text-center"
                                                                                disabled type="button">Disable</button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var SITEURL = '{{ URL::to('') }}';

        function pushQuiz(question_id) {
            swal({
                    title: "Push pertanyaan ini ?",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonClass: "btn-secondary",
                    cancelButtonText: "Batal",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Push",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "GET",
                            url: SITEURL + "/dashboard/run-quiz/" + question_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#table_quiz").load(window.location.href + " #table_quiz");
                                    swal("Success", "Pertanyaan berhasil dijalankan!", "success");
                                    // run coutdown
                                    var waktu_quiz = data.waktu_quiz;
                                    const second = 1000,
                                        minute = second * 60,
                                        hour = minute * 60,
                                        day = hour * 24;
                                    var selesai = waktu_quiz,
                                        countDown = new Date(selesai.replace(' ', 'T')).getTime(),
                                        x = setInterval(function() {
                                            var now = new Date().getTime(),
                                                distance = countDown - now;
                                            document.getElementById("minutes_"+ question_id).innerText = Math.floor((
                                                    distance % (hour)) / (minute)),
                                                document.getElementById("seconds_"+ question_id).innerText = Math
                                                .floor((distance % (minute)) / second);
                                            if (distance < 0) {
                                                clearInterval(x);
                                                $.ajax({
                                                    url: SITEURL + "/dashboard/stop-quiz/" + question_id,
                                                    type: "GET",
                                                    dataType: "JSON",
                                                    success: function(data) {
                                                        $("#table_quiz").load(window.location.href + " #table_quiz");
                                                        swal("Success", "Quiz selesai dijalankan", "success");
                                                    }
                                                });
                                                var countdown = document.getElementById("countdown_"+ question_id);
                                                countdown.style.display = "none";
                                                clearInterval(x);
                                            }
                                        }, 0)
                                }
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }

                        });
                    }
                });
        }

        function resetQuiz(question_id) {
            swal({
                    title: "Reset pertanyaan ini ?",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonClass: "btn-secondary",
                    cancelButtonText: "Batal",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Reset",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "GET",
                            url: SITEURL + "/dashboard/reset-quiz/" + question_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#table_quiz").load(window.location.href + " #table_quiz");
                                    swal("Success", "Pertanyaan berhasil di reset!", "success");
                                }
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }

                        });
                    }
                });
        }

    </script>
@endsection
