<!-- sidebar part here -->
<nav id="sidebar" class="sidebar ">

    <div class="sidebar-header update_sidebar">
        <a class="large_logo" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="">
        </a>
        <a class="mini_logo" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="">
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="fa fa-times"></i>
        </a>
    </div>
    <ul id="sidebar_menu" class="metismenu">
      <li>
        <a class="home" href="{{ route('home') }}">
          <div class="nav_icon_small">
            <span class="fa fa-home"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('global.dashboard') }}</span>
          </div>
        </a>
      </li>

      <li>
        <a class="userprofile" href="{{ route('userprofile') }}">
          <div class="nav_icon_small">
            <span class="fa fa-user"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('user.profile') }}</span>
          </div>
        </a>
      </li>

      @if( isGranted('CONTACT') )
      <li class="">
        <a href="javascript:;" class="has-arrow contact contactcategorie" aria-expanded="">
          <div class="nav_icon_small">
            <span class="fa fa-address-book"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('contact.menu') }}</span>
          </div>
        </a>
        <ul class="mm-collapse">
          <li>
            <a href="{{ route('contact') }}" class="contact">{{ __('contact.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('contactcategorie') }}" class="contactcategorie">{{ __('contactcategorie.module_name') }}</a>
          </li>
        </ul>
      </li>
      @endif

      @if( isGranted('CLIENT') )
      <li class="">
        <a href="javascript:;" class="has-arrow client clientcategorie" aria-expanded="">
          <div class="nav_icon_small">
            <span class="fa fa-users"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('client.menu') }}</span>
          </div>
        </a>
        <ul class="mm-collapse">
          <li>
            <a href="{{ route('client') }}" class="client">{{ __('client.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('clientcategorie') }}" class="clientcategorie">{{ __('clientcategorie.module_name') }}</a>
          </li>
        </ul>
      </li>
      @endif

      @if( isGranted('CASE') )
      <li class="">
        <a href="javascript:;" class="has-arrow act stage casee casecategorie" aria-expanded="">
          <div class="nav_icon_small">
            <span class="fa fa-users"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('casee.menu') }}</span>
          </div>
        </a>
        <ul class="mm-collapse">
          <li>
            <a href="{{ route('act') }}" class="act">{{ __('act.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('stage') }}" class="stage">{{ __('stage.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('casecategorie') }}" class="casecategorie">{{ __('casecategorie.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('casee') }}" class="casee">{{ __('casee.module_name') }}</a>
          </li>
        </ul>
      </li>
      @endif

      @if( isGranted('COURT') )
      <li class="">
        <a href="javascript:;" class="has-arrow court courtcategorie" aria-expanded="">
          <div class="nav_icon_small">
            <span class="fa fa-bandcamp"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('court.menu') }}</span>
          </div>
        </a>
        <ul class="mm-collapse">
          <li>
            <a href="{{ route('court') }}" class="court">{{ __('court.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('courtcategorie') }}" class="courtcategorie">{{ __('courtcategorie.module_name') }}</a>
          </li>
        </ul>
      </li>
      @endif

      @if( isGranted('APPOINTMENT') )
      <li>
        <a class="appointment" href="{{ route('appointment') }}">
          <div class="nav_icon_small">
            <span class="fa fa-calendar"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('appointment.menu') }}</span>
          </div>
        </a>
      </li>
      @endif

      @if( isGranted('TASK') )
      <li>
        <a class="task" href="{{ route('task') }}">
          <div class="nav_icon_small">
            <span class="fa fa-calendar"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('task.menu') }}</span>
          </div>
        </a>
      </li>
      @endif

      @if( isGranted('TODO') )
      <li>
        <a class="todo" href="{{ route('todo') }}">
          <div class="nav_icon_small">
            <span class="fa fa-calendar"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('todo.menu') }}</span>
          </div>
        </a>
      </li>
      @endif

      @if( isGranted('EVENT') )
      <li>
        <a class="event" href="{{ route('event') }}">
          <div class="nav_icon_small">
            <span class="fa fa-calendar"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('event.menu') }}</span>
          </div>
        </a>
      </li>
      @endif

      @if( isGranted('ADMIN') )
      <li class="">
        <a href="javascript:;" class="has-arrow user groupe" aria-expanded="">
          <div class="nav_icon_small">
            <span class="fa fa-bandcamp"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('user.menu') }}</span>
          </div>
        </a>
        <ul class="mm-collapse">
          <li>
            <a href="{{ route('user') }}" class="user">{{ __('user.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('groupe') }}" class="groupe">{{ __('groupe.module_name') }}</a>
          </li>
        </ul>
      </li>
      @endif

      @if( isGranted('LEAVE') )
      <li class="">
        <a href="javascript:;" class="has-arrow leave leavetype" aria-expanded="">
          <div class="nav_icon_small">
            <span class="fa fa-bandcamp"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('leave.menu') }}</span>
          </div>
        </a>
        <ul class="mm-collapse">
          <li>
            <a href="{{ route('leave') }}" class="leave">{{ __('leave.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('leavetype') }}" class="leavetype">{{ __('leavetype.module_name') }}</a>
          </li>
        </ul>
      </li>
      @endif

      @if( isGranted('LAWYER') )
      <li>
        <a class="lawyer" href="{{ route('lawyer') }}">
          <div class="nav_icon_small">
            <span class="fa fa-calendar"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('lawyer.menu') }}</span>
          </div>
        </a>
      </li>
      @endif

      @if( isGranted('ADMIN') )
      <li class="">
        <a href="javascript:;" class="has-arrow categorie article page slider service team front" aria-expanded="">
          <div class="nav_icon_small">
            <span class="fa fa-bandcamp"></span>
          </div>
          <div class="nav_title">
            <span>{{ __('front.menu') }}</span>
          </div>
        </a>
        <ul class="mm-collapse">
          <li>
            <a href="{{ route('article') }}" class="article">{{ __('article.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('categorie') }}" class="categorie">{{ __('categorie.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('page') }}" class="page">{{ __('page.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('slider') }}" class="slider">{{ __('slider.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('service') }}" class="service">{{ __('service.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('team') }}" class="team">{{ __('team.module_name') }}</a>
          </li>
          <li>
            <a href="{{ route('front_setting') }}" class="front">{{ __('front.module_name') }}</a>
          </li>
        </ul>
      </li>
      @endif
    </ul>
</nav>
<!-- sidebar part end -->

<script type="text/javascript">
  $(document).ready(function(){
    $('#sidebar_menu a.{{ explode('_',\Request::route()->getName())[0] }}').addClass('active');
    $('.has-arrow.{{ explode('_',\Request::route()->getName())[0] }}').attr('aria-expanded','true');
    $('.has-arrow.{{ explode('_',\Request::route()->getName())[0] }}+.mm-collapse').addClass('mm-show');
    $('.has-arrow.{{ explode('_',\Request::route()->getName())[0] }}').parent().addClass('mm-active');
  })
</script> 