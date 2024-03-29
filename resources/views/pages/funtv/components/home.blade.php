<div class="container border-bottom">
    <div class="row my-3 text-center">
        <div class="col-3">
            <a class="list-btn" href="javascript:void(0)" onclick="rank_btn()"> <img class="img-fluid"
                    src="{{ asset('funtv/img/rank.svg') }}"></a>
        </div>
        <div class="col-3">
            <a class="list-btn position-relative" href="javascript:void(0)" onclick="live_chat()">
                <span id="notifChat" class="badge-custom position-absolute translate-middle border border-light rounded-circle" style="display: none">
                    <span class="visually-hidden">New chats</span>
                  </span>
                <img class="img-fluid" src="{{ asset('funtv/img/live_chat.svg') }}">
            </a>
        </div>
        <div class="col-3">
            <a class="list-btn" href="javascript:void(0)" onclick="help()"> <img class="img-fluid"
                    src="{{ asset('funtv/img/help.svg') }}"></a>
        </div>
        <div class="col-3">
            <a class="list-btn" href="javascript:void(0)" id="share_btn"> <img class="img-fluid"
                    src="{{ asset('funtv/img/share.svg') }}"></a>
        </div>
    </div>
</div>
<div class="container border-bottom">
    <div class="row my-3">
        <div class="col-4">
            <div class="viewer-count mt-3 ms-3" id="listeners">
            </div>
        </div>
        <div class="col-8 align-self-end">
            <div class="avatars" onclick="getOnlineUser()">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="title mt-4 mb-3">
        Jangan Lewatkan
    </div>
    <div class="row">
        <div class="col-12">
            <img class="img-fluid" src="{{ asset('funtv/img/jkt_banner.png') }}">
        </div>
        <div class="col-6">
            <div class="card" style="background-color: #FFB824">
                <div class="card-body">
                    <div class="card-banner-title mt-5">
                        Promotion.
                    </div>
                    <p class="content-banner mt-2">
                        This is area for marketing program
                    </p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card" style="background-color: #97248C">
                <div class="card-body">
                    <div class="card-banner-title mt-5">
                        Feature.
                    </div>
                    <p class="content-banner mt-2">
                        This is area for marketing program
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
