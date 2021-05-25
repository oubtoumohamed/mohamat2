
	<!-- TOPBAR -->
	<div id="top-bar" class="hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!--div class="top-login">
						<a href="./shop-login.html">Login</a>
					</div-->
					<style type="text/css">
						.social-icons li,.info-icons li{
							display: inline-block;
						}
					</style>
					<div class="nav-info-icons">
						<ul class="nav navbar-nav info-icons">
							<li class="fax">
								<a dir="ltr" href="tel:{{ __('setting.phone') }}"><i class="fa fa-phone"></i>&nbsp;&nbsp;{{ __('setting.phone') }}</a>
							</li>
							<li class="mail">
								<a dir="ltr" href="mailto:{{ __('setting.email') }}"><i class="fa fa-envelope"></i>&nbsp;&nbsp;{{ __('setting.email') }}</a>
							</li>
						</ul>
					</div>
					<div class="nav-social-icons">
						<ul class="social-icons">
							<li class="facebook">
								<a href="{{ __('setting.facebook') }}" target="_blank">
								<i class="fa fa-facebook"></i><i class="fa fa-facebook"></i>
								</a>
							</li>
							<li class="youtube">
								<a href="{{ __('setting.youtube') }}" target="_blank">
								<i class="fa fa-youtube"></i>
								<i class="fa fa-youtube"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- HEADER -->
	<header id="header-main" style="border-bottom: solid 1px #eee;">
		<div class="container">
			<div class="navbar yamm navbar-default">
				<div class="navbar-header">
					<a style="display: inline-block; float: right;" href="{{ route('front_home') }}"><img src="{{ asset( __('setting.app_logo') ) }}" style="height: 85px; margin-bottom: 0px;" alt=""></a>
					<button style="margin-left: 0px;margin-right: 0px !important;" type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div id="navbar-collapse-1" class="navbar-collapse collapse navbar-left">
					<ul class="nav navbar-nav">
						
						<li class="dropdown">
							<a href="{{ route('front_home') }}">
								{{ __('front.home') }} 
							</a>
						</li>
						<li class="dropdown">
							<a href="{{ route('page_front','terms') }}">
							سياسة  الخصوصية
							</a>
						</li>
						<li class="dropdown">
							<a href="{{ route('page_front','contact') }}">
								إتصل بنا
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>