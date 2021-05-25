<!DOCTYPE html>
<html @if( @App::getLocale() == "ar" ) lang="ar" dir="rtl" @else lang="en" dir="ltr" @endif >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="ar" />
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="theme-color" content="#4188c9">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <link rel="icon" href="{{ asset('img/favicon.ico') }}"/>
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <title>{{ config('app.name') }}</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('theme/bootstrap.css') }}">
  <!-- metis menu  -->
  <link rel="stylesheet" href="{{ asset('theme/metisMenu.css') }}?v=2">
  <link rel="stylesheet" href="{{ asset('theme/style_002.css') }}?v=4">
  <link rel="stylesheet" href="{{ asset('theme/infix.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/style.css') }}?v=2">  

  <link href="{{ asset('css/select2.min.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">


  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  <!--link href="{{ asset('theme/css/app.rtl.css') }}?v=3" rel="stylesheet" />
  <script src="{{ asset('js/select2-ar.js') }}"></script-->

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">

  <style type="text/css">body {font-family: 'Tajawal' !important;}</style>


  <style type="text/css">form.white_box_50px{
  padding: 0;
}
form .card-body{
  border-radius: 18px 18px 0 0;
  background: #fff;
  margin-top:  10px;
  padding: 30px 40px
}
form .card-body .form-control{
  border: solid 1px #f3f4f8;
  border-radius: 50px;
  padding: 10px 20px;
  min-height: 50px
}
.card-header {
  background: transparent !important;
  border: none;
  padding-left: 5px;
}
.card-footer {
  background: #fff;
  border-radius: 0 0 18px 18px !important;
  border: none;
  padding-bottom: 40px;
}
/*------*/
.dt_infos{
  padding: 40px;
}
.dt_paginate{
  padding: 20px;
  text-align: right !important;
}
.dt_paginate .pagination{
  display: inline-flex !important;
  
}
.dt_paginate .pagination li{
  margin: 5px;
}
.dt_paginate .pagination li a,
.dt_paginate .pagination li span{
  background: #fff;
  display: block;
  width: 30px;
  padding: 5px;
  text-align: center;
  border-radius: 5px;
}
.dt_paginate .pagination li.active a,
.dt_paginate .pagination li.active span,
.dt_paginate .pagination li:hover span,
.dt_paginate .pagination li:hover a{
  background: -webkit-linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
  background: -moz-linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
  background: -o-linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
  background: -ms-linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
  background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
  color: #ffffff;
  background-size: 200% auto;
  -webkit-transition: all 0.4s ease 0s;
  -moz-transition: all 0.4s ease 0s;
  -o-transition: all 0.4s ease 0s;
  transition: all 0.4s ease 0s;
}
</style>

  @yield('head')
</head>
<body class="admin">
    <div class="main-wrapper" style="min-height: 600px">
      <!-- Sidebar  -->
      @section('sidebar')
        @include('sidebar')
      @show
      <!-- Sidebar  -->

      <!-- Page Content  -->
      <div id="main-content">
          @section('header')
            @include('header')
          @show
          <div class="container-fluid p-0">
            @yield('content')
          </div>
      </div>

    </div>


<!-- ================Footer Area ================= -->
<!--footer class="footer-area pt-10 pb-20">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 text-center">
        <p> Copyright © 2020 - 2021 All rights reserved | This application is made by <a href="https://codecanyon.net/user/codethemes" target="_blank"><font color="#ff0000">Codethemes</font></a> </p>
            </div>
        </div>
    </div>
</footer-->
<!-- ================End Footer Area ================= -->

  <script src="{{ asset('theme/jquery-3.js') }}"></script>
  <script src="{{ asset('theme/bootstrap.js') }}"></script>
  <!-- metisMenu js  -->
  <script src="{{ asset('theme/metisMenu.js') }}"></script>
  <script src="{{ asset('theme/main.js') }}"></script>
</body>
</html>