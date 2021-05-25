@extends('standard')

@section('content') 

<div class="row">
  <div class="col-lg-12">
      <div class="main-title">
          <h3 class="mb-0">{{ __('global.dashboard') }}</h3>
      </div>
  </div>
</div>

<div class="row">
	@if( isGranted('ADMIN') )
	@foreach( $results as $mdl=>$total)

	<div class="col-lg-3 col-md-6">
	  	<a class="d-block">
	      	<div class="white-box single-summery">
	        	<div class="d-flex justify-content-between">
	            	<div>
	                	<h3>{{ __($mdl.'.module_name') }}</h3>
	                  	<p class="mb-0">.</p>
	              	</div>
	              	<h1 class="gradient-color2">{{ $total }}</h1>
	          	</div>
	      	</div>
	  	</a>
	</div>
	@endforeach
	@else
	
	<div class="col-md-12">		
		<div style="text-align: center;padding: 20px;">
			<img src="{{ auth()->user()->getavatarfulllink() }}" class="avatar img-fluid rounded-circle" alt="" style="background: #f1f1f1;width: 120px;height: 120px;" />
			<div class="text-dark p-3" >{{ auth()->user() }}</div>
			{{ __('global.welcomemsg') }} 
		</div>
	</div>

	@endif
</div>

@endsection