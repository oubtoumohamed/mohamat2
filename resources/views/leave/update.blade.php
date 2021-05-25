@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('leave_update',$object->id) }}@else{{ route('leave_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('leave.leave_edit') }}
        @else
          {{ __('leave.leave_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('leave.user_id') }}</label> 
            <select class="form-control select_with_filter" id="user_id" name="user_id" required="">
              @foreach( $users as $user )
              <option value="{{ $user->id }}" @if($object->id && $object->user_id == $user->id ) selected="selected" @endif >{{ $user->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('leave.leavetype_id') }}</label> 
            <select class="form-control select_with_filter" id="leavetype_id" name="leavetype_id">
              @foreach( $types as $type )
              <option value="{{ $type->id }}" @if($object->id && $object->leavetype_id == $type->id ) selected="selected" @endif >{{ $type->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('leave.days') }}</label> 
            <input class="form-control" id="days" name="days" value="@if($object->id){{ $object->days }}@else{{ old("days") }}@endif" type="number" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('leave.state') }}</label> 
            <select class="form-control select_with_filter" id="state" name="state" required="" >
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