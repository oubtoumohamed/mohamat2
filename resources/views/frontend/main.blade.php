<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <title>{{ __('front.app_name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}?v=3" type="text/css">
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-rtl.min.css') }}?v=3" type="text/css">

  <link rel="shortcut icon" href="{{ asset('img/fav-icon.png') }}">
  <link rel="icon" href="{{ asset('img/fav-icon.png') }}">

  <link rel="stylesheet" href="{{ asset('frontend/js/rs-plugin/css/settings.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/js/flexslider/flexslider.css') }}">

  <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}?v=3.8">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}" type="text/css">

  <!-- SKIN -->
  <link rel="stylesheet" href="{{ asset('frontend/css/color-scheme/default-blue.css') }}" type="text/css">
  
  @yield('head')

</head>
<body>

  <div class="outer-wrapper">
    @include('frontend.header')
    
    @yield('content')

    @include('frontend.footer')
  </div>
</body>
</html>