<div class="page-header">
    <div class="header-wrapper row m-0">
      <div class="header-logo-wrapper">
        <div class="logo-wrapper"><h6 class="text-black text-center">FUN <br> TV</h6></div>
        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
      </div> 
      <div class="left-header col horizontal-wrapper pl-0">
        
      </div>
      <div class="nav-right col-8 pull-right right-header p-0">
        <ul class="nav-menus">
          {{-- Navigasi --}}
            {{-- <li class="onhover-dropdown">
              <div class="notification-box"><i data-feather="bell"></i><span class="badge badge-pill badge-secondary">4</span></div>
              <ul class="notification-dropdown onhover-show-div">
                <li class="bg-primary text-center">
                  <h6 class="f-18 mb-0">Notitication</h6>
                  <p class="mb-0">You have 4 new notification</p>
                </li>
                <li>
                  <p><i class="fa fa-circle-o mr-3 font-primary"> </i>Delivery processing <span class="pull-right">10 min.</span></p>
                </li>
                <li>
                  <p><i class="fa fa-circle-o mr-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p>
                </li>
                <li>
                  <p><i class="fa fa-circle-o mr-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p>
                </li>
                <li>
                  <p><i class="fa fa-circle-o mr-3 font-danger"></i>Delivery Complete<span class="pull-right">6 hr</span></p>
                </li>
                <li><a class="btn btn-primary" href="index.html#">Check all notification</a></li>
              </ul>
            </li> --}}
          {{-- Navigasi --}}
          <li>
            <div class="mode"><i class="fa fa-moon-o"></i></div>
          </li>
          
          <li class="maximize"><a class="text-dark" href="#" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
          <li class="profile-nav onhover-dropdown p-0 mr-0">
            <div class="media profile-media">
              @if(Auth::user()->image)
              <img id="preview" class="img-40 b-r-10" src="{{ ('/img/user/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
              @else
              <img id="preview" src="https://via.placeholder.com/150" class="img-40 b-r-10 hidden">
              @endif
              <div class="media-body"><span>{{ Auth::user()->name }}</span>
                <p class="mb-0 font-roboto">
                  @if (!empty(Auth::user()->getRoleNames()))
                      @foreach (Auth::user()->getRoleNames() as $v) 
                          {{ $v }}
                      @endforeach
                  @endif
                  <i class="middle fa fa-angle-down"></i></p>
              </div>
            </div>
            <ul class="profile-dropdown onhover-show-div">
              <li><i data-feather="user"></i><span>Account </span></li>
              <li>
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                <i data-feather="log-out"></i>Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </div>
  </div>