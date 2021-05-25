@extends('standard')

@section('content')
  <form class="card" method="POST" action="{{ route('translator_store') }}">

    <div class="card-header">
      <div class="row">
        <div class="col-md-4">
          {{ __('translator.lang') }}
          <br>
          <select id="lang" name="lang" style="width: 100%;">
            <option ></option>
            <option @if( $lang == 'ar' ) selected="selected" @endif value="ar">العربية </option>
            <option @if( $lang == 'fr' ) selected="selected" @endif value="fr">Français </option>
            <option @if( $lang == 'en' ) selected="selected" @endif value="en">English </option>
          </select>
        </div>
        <div class="col-md-8">
          {{ __('translator.module') }}
          <br>
          <select id="module" name="module" style="width: 90%;">
            <option ></option>
            @foreach( $modules as $mdl )
            <option @if( $mdl == $module ) selected="selected" @endif value="{{ $mdl }}">{{ $mdl }} </option>
            @endforeach
          </select>
          <button id="load_data" class="btn rounded-pill btn-primary ms-4"> <i class="fa fa-refresh"></i> </button>
        </div>
      </div>
    </div>
    {{ csrf_field() }}
    <div class="card-body">

      <div class="row">

        @foreach( $data as $key=>$value )
        <div class="col-md-6">
          <div class="form-group input-group">
            <label class="input-group-text col-md-3">{{ $key }}</label>
            <input class="form-control" name="trans[{{$key}}]" value="{{ $value }}" type="text" required="">
          </div>
        </div>
        @endforeach

      </div>
      <div class="pt-3 m-0 row" id="fields"  style="background: var(--bs-light); border: solid 1px #ccc;"></div>
      <span class="btn btn-primary mt-4" id="addfield">{{ __('translator.addfield') }}</span>

    </div>
    <div class="card-footer text-right">
      {!! update_actions() !!}
    </div>
  </form>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#load_data').click(function(e){
        e.preventDefault();

        if( $('#lang').val() && $('#module').val() )
          window.location.href = '{{ route('translator_create') }}/' + $('#lang').val() + '/' + $('#module').val();
      });

      var mc_index = 1;
      $('#addfield').click(function(){
        //
        $('#fields').append('<div class="col-md-6"> <div class="form-group input-group"> <label class="input-group-text col-md-3"> <input class="form-control" name="fields['+mc_index+'][key]" value="" type="text" required=""></label> <input class="form-control" name="fields['+mc_index+'][value]" value="" type="text" required=""> <button type="button" class="btn btn-danger" onclcik="delete_row(this)" style="float: right;">X</button> </div> </div>');

        mc_index++;
      });
    });
  </script>

@endsection