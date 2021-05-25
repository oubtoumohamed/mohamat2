@extends('frontend.main')

@section('head') 
<style type="text/css">
.page_header_parallax {
	background: #000 url('{{ $article->getImageLink() }}') no-repeat fixed center;
	background-size: cover;
	padding: 0px;
}
.page_header_parallax .container_ {
	background: rgba(0,0,0,0.7);
	padding: 80px 5%;
	width: 100%;
}
</style>
@endsection


@section('content') 
	<!-- PAGE HEADER -->

	<div class="page_header">
		<div class="page_header_parallax">
			<div class="container_">
				<div class="row">
					<div class="col-md-12">
						<center><h3>{{ $article->titre }}</h3></center>
					</div>
				</div>
			</div>
		</div>
		<div class="bcrumb-wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="bcrumbs">
							<li>
								<a href="{{ route('front_home') }}">
								<i class="fa fa-home"></i> {{__('front.accueil')}}</a>
							</li>
							<li><a>/ &nbsp; &nbsp;{{ $article->titre }}</a></li>
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
			<span>{{ $article->categorie() }}</span>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<span>{!! $article->getDate2() !!}</span>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<span>{{ $article->info }}</span>
			<br/><br/>
			{!! $article->contenu !!}
		</div>
	</div>
@endsection