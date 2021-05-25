<div class="container-fluid no-gutters d-print-none">
  <div class="row">
    <div class="col-lg-12 p-0">
      <div class="header_iner d-flex justify-content-between align-items-center">
        <div class="small_logo_crm d-lg-none">
          <a href="{{ route('home') }}"> <img src="{{ asset('img/logo.png') }}" alt=""></a>
        </div>

        <div id="sidebarCollapse" class="sidebar_icon  d-lg-none">
          <i class="fa fa-bars"></i>
        </div>

        <div class="collaspe_icon open_miniSide">
          <i class="fa fa-bars"></i>
        </div>

        <div class="serach_field-area ml-40">
          <div class="search_inner">
            <!--form action="#">
              <div class="search_field">
                <input type="text" placeholder="SEARCH" id="search" onkeyup="showResult(this.value)">
              </div>
              <button type="button"> <i class="fa fa-search"></i> </button>
            </form-->
          </div>

          <div id="livesearch" style="display: none;"></div>
        </div>

        <div class="header_right d-flex justify-content-between align-items-center">
          <div class="header_notification_warp d-flex align-items-center">
          </div>

          <div class="profile_info">
            <img src="{{ auth()->user()->getavatarfulllink() }}" alt="#">
            <div class="profile_info_iner">
              <div class="use_info d-flex align-items-center">
                <div class="thumb">
                  <img src="{{ auth()->user()->getavatarfulllink() }}" alt="#">
                </div>

                <div class="user_text">
                  <h5><a href="{{ route('userprofile') }}">{{ auth()->user() }}</a></h5>
                  <span>{{ auth()->user()->email }}</span>
                </div>
              </div>

              <div class="profile_info_details">
                <a href="{{ route('setlange','ar') }}" style="float: left;/*! margin: 5px; */">
                  <img src="{{ asset('img/lng/ar.png') }}"> <span> العربية </span>
                </a>
                <a href="{{ route('setlange','en') }}" style="float: right;">
                  <img src="{{ asset('img/lng/en.png') }}"> <span> English </span>
                </a>
                <a href="{{ route('userprofile') }}" style="clear: both;border-top: solid 1px #000;padding-top: 10px;margin-top: 40px;"> 
                  <i class="fa fa-user"></i>
                  <span> {{ __('user.profile') }}</span>
                </a>

                <a id="logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out"></i>
                  <span>{{ __('global.logout') }}</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>