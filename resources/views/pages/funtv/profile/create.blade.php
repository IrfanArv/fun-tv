@extends('layouts/funtv/main')
@section('title', 'Profile')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center mt-5">
                <div class="greetings mt-5">
                    Yeay!
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center text-center mt-1 px-5">
                <p><span class="sub-greetings">Selamat bergabung, biar makin asik silahkan pilih avatar kamu dan buat
                        username dulu ya.</span>
                </p>
            </div>
            <form id="updatePlayer" name="updatePlayer" class="px-5 mt-2 mb-1" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                    <img class="img-80 rounded-circle border border-dark border-2" id="avatarImg" src="{{ asset('funtv/img/ava_default.svg') }}">
                </div>
                <div class="d-flex justify-content-center pt-2 pb-3">
                    <div class="upload-btn-wrapper">
                        <button id="generateAvatar" type="button" class="btn btn-upload">Pilih Avatar <img
                                class="img-fluid" src="{{ asset('funtv/img/refresh.svg') }}"></button>
                    </div>
                    <input type="hidden" name="hidden_image" id="hidden_image">
                </div>
                <div class="form-row text-center">
                    <div class="form-group col-md-12 px-3">
                        <label class="my-2">Username</label>
                        <input type="hidden" name="phone" id="phone" value="{{ $getPlayerPhone }}">
                        <input type="hidden" name="avatar" id="avatar">
                        <input type="text" class="form-control form-control-lg mb-3" id="username" name="username"
                            value="" required="">
                        <span id="user_results"></span>
                    </div>
                </div>
                <div class="fixed-bottom">
                    <div class="d-grid gap-1">
                        <button class="btn btn-lg btn-auth" id="sendProfile" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            @if (count($errors) > 0)
                <div class="col-12 px-5">
                    <div class="alert alert-light alert-dismissible fade show px-2 mt-5" role="alert">
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        var ava_default = $("#avatarImg");
        var SITEURL = '{{ URL::to('') }}';
        $(document).ready(function() {

            $("#generateAvatar").click(function() {
                username = GetUserName();
                $('#avatarImg').attr('src', 'https://avatars.dicebear.com/api/adventurer/' + username +
                    '.svg');
                $('#avatar').val('https://avatars.dicebear.com/api/adventurer/' + username + '.svg')
            });

            $("#sendProfile").attr("disabled", true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#username').keyup(function() {
                var username = $('#username').val();
                var field_name = username.toLowerCase().replace(/ /g, '-')
                    .replace(/[^\w-]+/g, '');
                var username = $('#field_name').val(field_name);
                if (field_name != '') {
                    $.ajax({
                        url: SITEURL + "/available-user",
                        method: "POST",
                        data: {
                            username: field_name
                        },
                        success: function(data) {
                            if (data.success === true) {
                                $("#sendProfile").attr("disabled", false);
                            } else {
                                $("#sendProfile").attr("disabled", true);
                            }
                            $('#user_results').html(data.message);
                        }
                    });
                }
                if (field_name === '') {
                    $("#sendProfile").attr("disabled", true);
                }
            });

            $('body').on('submit', '#updatePlayer', function(e) {
                e.preventDefault();
                var actionType = $('#sendProfile').val();
                $('#sendProfile').html('Sending Data..');
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: SITEURL + "/save-profile",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $('#updatePlayer').trigger("reset");
                        $('#sendProfile').html('Success');
                        window.location.href = "{{ route('home') }}";
                    },
                });
            });
        });

        function GetUserName() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

            for (var i = 0; i < 5; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }
    </script>
@endsection
