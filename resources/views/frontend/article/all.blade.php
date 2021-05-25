@extends('frontend.main')
@section('content') 

	<style type="text/css">.articles .article{padding-bottom: 15px } .articles .article .article_details{height: 140px; overflow: hidden; } .articles .article .readmore{padding: 10px; display: inline-block; }</style>

	<div class="container home-blog articles padding70" id="5">
		<div class="text-center space40">
			<h2 class="title uppercase">الاعلانات و الاخبار</h2>
			<p>جديد الاعلانات و الاخبار. التي  تهم الطلبة  و الرأي العام</p>
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
					<a href="{{ route('front_article', $article->lien) }}" class="readmore">أكمل القراءة ...</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<div style="text-align: center;margin-bottom: 50px;">
		{!! $articles->links() !!}
	</div>

@endsection