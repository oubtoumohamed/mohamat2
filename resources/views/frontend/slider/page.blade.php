@extends('frontend.main')
@section('content') 
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<center><h3>{{ $object->titre }}</h3></center>
					</div>
				</div>
			</div>
		</div>

		<div class="bcrumb-wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="bcrumbs">
							<li><a href="{{ route('front_home') }}"><i class="fa fa-home"></i> {{__('front.accueil')}}</a></li>
							<li>{{ $object->titre }}</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- INNER CONTENT -->
	<div class="inner-content">
		<div class="container">
			{!! $object->contenu !!}
		</div>
	</div>
@endsection