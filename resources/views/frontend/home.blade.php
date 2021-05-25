@extends('frontend.main')
@section('content') 
	<div class="">
	  <div id="myCarousel" class="carousel slide" data-ride="carousel">

	    <!-- Wrapper for slides -->
	    <div class="carousel-inner">
		    @php
		    	$active = "active";
		    @endphp
			@foreach( $sliders as $slider )
				<div class="item {{ $active }}">
		      		<a href="{{ route('slider_front', $slider->link) }}" alt="{{ $slider->titre }}">
		      			<img src="{{ $slider->getImageLink() }}" alt="{{ $slider->titre }}">
		      		</a>
		      	</div>
			    @php
			    	$active = "";
			    @endphp
			@endforeach
	    </div>

	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left fa fa-chevron-left"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#myCarousel" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right fa fa-chevron-right"></span>
	      <span class="sr-only">Next</span>
	    </a>
	  </div>
	</div>

	<style type="text/css"> .ulmots li{background: #f1f1f1; } .ulmots li.active{background: #fff; } </style>
	
	<div class="inner-content no-padding" style="margin-top: 25px;">
		<div class="container">
		<div class="text-center space40">
			<h2 class="title uppercase">عن {{ __('setting.app_name') }}</h2>
		</div>
			<div class="row padding10">
				<p>{!! __('setting.description') !!}</p>
			</div>
		</div>
	</div>

	<style type="text/css">.articles .article{padding-bottom: 15px } .articles .article .article_details{height: 140px; overflow: hidden; } .articles .article .showmore{padding: 20px 0; text-align: left; } .articles .article .showmore a{padding: 5px 15px !important;}</style>

	<div class="container home-blog articles padding70" id="5">
		<div class="text-center space40">
			<h2 class="title uppercase">أحدث المقالات</h2>
			<br/>
			<p>
				@foreach( $categories as $categorie )
				<a href="{{ route('front_cat_articles',$categorie->label) }}" style="display: inline-block; padding: 3px 6px 2px 6px !important" class="color2 btn-border button btn-xs">{{ $categorie }}</a>&nbsp;
				@endforeach
			</p>
		</div>
		<div class="row">
			@foreach( $articles as $article )
			<div class="col-md-4">
				<div class="article hb-info text-center">
					<div class="hb-thumb">
						<img src="{{ $article->getImageLink() }}" style="width: 370px; height: 202px;" class="img-responsive" title="{{ $article->titre }}" alt="{{ $article->titre }}"/>
						<div class="date-meta">
							{!! $article->getDate() !!}
						</div>
						<div class="date-meta" style="left: 10px; top: 10px; background: #1b2c3c;">
							{{ $article->categorie() }}
						</div>
					</div>
					<div class="article_details">
						<h4 class="titre"><a href="{{ route('front_article', $article->lien) }}">{{ $article->titre }}</a></h4>
						<p class="excerpt">{{ $article->getexcerpt() }}</p>
					</div>
					<div class="showmore">
						<a href="{{ route('front_article', $article->lien) }}" style="display: inline-block;" class="button color2 btn-xs">المزيد </a>
					</div>
				</div>
			</div>
			@endforeach

			<div style="clear: both;"></div>

			<div style="text-align: center; clear: both;padding-top: 30px;">
				<a href="{{ route('front_articles') }}"  style="display: inline-block;" class="color2 btn-border button btn-reveal btn-lg">
					<i class="fa fa-plus"></i>
					<span>المزيد من الأخبار ...</span>
				</a>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<style type="text/css">.services-row a{color: #fff; display: block; text-align: center; } .services-row a img{display: inline-block; border-radius: 100%; border: solid 8px #000; }</style>
	<div class="parallax-bg2 services-row row group" style="text-align: center;">

		<div class="container videos padding70">

			<h3 style="text-align: center; color: #fff;">فريق العمل</h3>

			<br><br><br>

			@foreach( $teams as $team )

			<div class="col-md-3 col-sm-6 col-xs-12 ">
				<div class="circle-services">
                    <a>
                        <img style="width: 180px;" src="{{ $team->getavatarfulllink() }}" alt="project">
                    </a>
	            </div>
	            <h3 style="color: #fff;">{{ $team->name }}</h3>
	            <p >{{ $team->description }}</p>
	        </div>    

	        @endforeach                                
	        
        </div>
    </div>

	<div class="clearfix"></div>


	<div class="parallax-bg">
		<div class="container services padding70">
			<div class="text-center space40">
				<h2 class="title uppercase">خدماتنا</h2>
				<br />
			</div>
			<div class="row">
				@foreach( $services as $service )
				<div class="col-md-3">
					<div class="content">
			            <h1><i class="fa {{ $service->icon }}" aria-hidden="true"></i></h1>
			            <h4 class="title">{{ $service->name }}</h4>
			            <p>{{ $service->description }}</p>
			        </div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

@endsection