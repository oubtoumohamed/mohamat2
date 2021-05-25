@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('leavetype_update',$object->id) }}@else{{ route('leavetype_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('leavetype.leavetype_edit') }}
        @else
          {{ __('leavetype.leavetype_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('leavetype.name') }}</label> 
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old("name") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('leavetype.state') }}</label> 
            <select class="form-control select_with_filter" id="state" name="state">
              @foreach( $object->states() as $k=>$v )
              <option value="{{ $k }}" @if($object->id && $object->state == $k) selected="selected" @endif >{{ $v }}</option>
              @endforeach
            </select>
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection