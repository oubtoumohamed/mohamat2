@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('event_update',$object->id) }}@else{{ route('event_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('event.event_edit') }}
        @else
          {{ __('event.event_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('event.title') }}</label> 
            <input class="form-control" id="title" name="title" value="@if($object->id){{ $object->title }}@else{{ old("title") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('event.user_id') }}</label> 
            <select class="form-control select_with_filter" id="user_id" name="user_id">
              @foreach( $users as $user )
              <option value="{{ $user->id }}" @if($object->id && $object->user_id == $user->id ) selected="selected" @endif >{{ $user->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('event.start_date') }}</label> 
            <input class="form-control" id="start_date" name="start_date" value="@if($object->id){{ $object->start_date }}@else{{ old("start_date") }}@endif" type="date" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('event.end_date') }}</label> 
            <input class="form-control" id="end_date" name="end_date" value="@if($object->id){{ $object->end_date }}@else{{ old("end_date") }}@endif" type="date" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('event.location') }}</label> 
            <input class="form-control" id="location" name="location" value="@if($object->id){{ $object->location }}@else{{ old("location") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('event.description') }}</label> 
            <input class="form-control" id="description" name="description" value="@if($object->id){{ $object->description }}@else{{ old("description") }}@endif" type="text"> 
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection