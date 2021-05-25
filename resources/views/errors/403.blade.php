@extends("auth.main")


@section('content')
	<div class="text-center pt-7">
		<img src="{{ asset('img/404.svg') }}" class="img-fluid mb-6" width="" />
    	<a href="{{ route('home') }}" class="btn btn-lg btn-warning">{{ __('global.home') }}</a>
	</div>
@endsection