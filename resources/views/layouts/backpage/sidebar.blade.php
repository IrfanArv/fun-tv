<div class="sidebar-wrapper">
    <div>
      <div class="logo-wrapper"><h3 class="mt-2 text-black text-center">FUN TV</h3>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><h6 class="text-black text-center">FUN <br> TV</h6></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="sidebar-list "><a class="sidebar-link sidebar-title link-nav {{ Request::segment(2) === 'dashboard' ? 'active' : null }}" href="{{ url('/dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
            <li class="sidebar-list "><a class="sidebar-link sidebar-title link-nav {{ Request::segment(2) === 'rooms' ? 'active' : null }}" href="{{ url('/dashboard/rooms') }}"><i data-feather="tv"></i><span>Stream Rooms</span></a></li>
            {{-- <li class="sidebar-list "><a class="sidebar-link sidebar-title link-nav {{ Request::segment(2) === 'trivia-quiz' ? 'active' : null }}" href="{{ url('/dashboard/trivia-quiz') }}"><i data-feather="umbrella"></i><span>Trivia Quiz</span></a></li> --}}
            <li class="sidebar-list"><a class="nav-link sidebar-title" href="#"><i data-feather="users"></i><span>Users</span></a>
              <ul class="sidebar-submenu">
                <li><a class="submenu-title {{ Request::segment(2) === 'users' ? 'active' : null }}"" href="{{ url('/dashboard/users')}}">Users<span class="sub-arrow"></span></a></li>
                <li><a class="submenu-title {{ Request::segment(2) === 'roles' ? 'active' : null }}"" href="{{ url('/dashboard/roles')}}">Roles<span class="sub-arrow"></span></a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>