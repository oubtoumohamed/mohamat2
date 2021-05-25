@extends('standard')

@section('content')
  <form class="forme_dit" method="POST" action="{{ route('front_setting_store') }}">

    <div class="card-header">
      <div class="row">
        <h4>{{ __('front.module_name') }}</h4>
      </div>
    </div>
    {{ csrf_field() }}
    <div class="card-body">

      <div class="row">

        @foreach( $data as $key=>$value )
        <div class="col-md-6">
          <div class="form-group input-group">
            <label class="input-group-text col-md-3">{{ $key }}</label>
            <input class="form-control" name="trans[{{$key}}]" value="{{ $value }}" type="text">
          </div>
        </div>
        @endforeach

      </div>

    </div>
    <div class="card-footer text-right">
      {!! update_actions() !!}
    </div>
  </form>


@endsection