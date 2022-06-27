<header id="gen-header" class="gen-header-style-1 gen-has-sticky">
    <div class="gen-bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img class="img-fluid logo" src="{{ asset('main/images/logo-1.png') }}" alt="FUN-TV">
                        </a>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        </div>
                        <div class="gen-header-info-box">
                            @if(Auth::guard('players')->check())
                            <div class="gen-btn-container">
                                <a href="{{ route('players.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="gen-button">
                                    <div class="gen-button-block">
                                        <span class="gen-button-line-left"></span>
                                        <span class="gen-button-text">Logout</span>
                                    </div>
                                    <form id="logout-form" action="{{ route('players.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                            @else
                                @if (Request::segment(2) === 'login')
                                @elseif (Request::segment(2) === 'register')
                                @else
                                    <div class="gen-btn-container">
                                        <a href="{{ route('players.login') }}" class="gen-button">
                                            <div class="gen-button-block">
                                                <span class="gen-button-line-left"></span>
                                                <span class="gen-button-text">Login</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
