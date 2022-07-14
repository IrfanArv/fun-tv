<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img class="img-fluid" src="{{ asset('funtv/img/main_logo.svg') }}"
                alt="FUN-TV"></a>
        <div class="username">
            <span class="me-2 mt-1">
                Hi, {{ $playerName }}
            </span>
            <a class="nav-link" href="javascript:void(0)" onclick="getProfile()"><img class="img-fluid icon"
                    src="{{ asset('funtv/img/slide.svg') }}" alt="FUN-TV"></a>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end" id="offcanvasRight" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    aria-labelledby="offcanvasRightLabel">
    <div class="my-3 mx-3"> <button class="nav-link" type="button" data-bs-dismiss="offcanvas" aria-label="Close"> <img
                id="playerAva" class="img-fluid icon" src="{{ asset('funtv/img/back.svg') }}" alt="back"></button>
    </div>
    <div class="offcanvas-body offcanvas-body pb-5 mb-5">
        <div class="container">
            <div class="row">
                <form id="updatePlayer" name="updatePlayer" class="mb-1" enctype="multipart/form-data">
                    <div class="d-flex justify-content-center">
                        <img class="img-120 rounded-circle border border-dark border-2" id="avatarImg" src="">
                    </div>
                    <div class="d-flex justify-content-center pt-2 pb-3">
                        <div class="upload-btn-wrapper">
                            <button id="generateAvatar" type="button" class="btn btn-upload">Ganti Avatar <img
                                    class="img-fluid" src="{{ asset('funtv/img/refresh.svg') }}"></button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="profile my-2">Nama Lengkap</label>
                            <input type="hidden" name="avatar" id="avatar">
                            <input type="text" class="form-control form-profile mb-3" id="fullname" name="fullname"
                                value="" required="" placeholder="Nama Lengkap kamu">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="profile my-2">Username</label>
                            <input type="text" class="form-control form-profile mb-3" id="username" name="username"
                                value="" required="" placeholder="username" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="profile my-2">Bio</label>
                            <input type="text" class="form-control form-profile mb-3" id="bio" name="bio"
                                value="" placeholder="Bio">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="profile my-2">Mobile</label>
                            <input type="number" class="form-control form-profile mb-3" id="mobile" name="mobile"
                                value="" required="" placeholder="Mobile" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="profile my-2">Gender</label>
                            <input type="text" class="form-control form-profile mb-3" id="gender" name="gender"
                                value="" placeholder="Gender">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="profile my-2">Date of Brith</label>
                            <input type="date" class="form-control form-profile mb-3" id="brithday" name="brithday"
                                value="" placeholder="Date of Brith">
                        </div>
                    </div>
                    <div class="fixed-bottom">
                        <div class="d-grid gap-1">
                            <button class="btn btn-lg btn-auth" id="sendProfile" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var ava_default = $("#avatarImg");
    var SITEURL = '{{ URL::to('') }}';
    $("#generateAvatar").click(function() {
        username = generateUsername();
        $('#avatarImg').attr('src', 'https://avatars.dicebear.com/api/adventurer/' + username +
            '.svg');
        $('#avatar').val('https://avatars.dicebear.com/api/adventurer/' + username + '.svg')
    });

    function generateUsername() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

        for (var i = 0; i < 7; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }
    $(document).ready(function() {
        $('body').on('submit', '#updatePlayer', function(e) {
            e.preventDefault();
            var actionType = $('#sendProfile').val();
            $('#sendProfile').html('Sending Data..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/update-profile",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#sendProfile').html('Simpan');
                },
            });
        });
    });
</script>
