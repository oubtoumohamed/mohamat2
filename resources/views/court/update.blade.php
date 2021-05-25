@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('court_update',$object->id) }}@else{{ route('court_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('court.court_edit') }}
        @else
          {{ __('court.court_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.country') }}</label> 
            <input class="form-control" id="country" name="country" value="@if($object->id){{ $object->country }}@else{{ old("country") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.state') }}</label> 
            <input class="form-control" id="state" name="state" value="@if($object->id){{ $object->state }}@else{{ old("state") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.city') }}</label> 
            <input class="form-control" id="city" name="city" value="@if($object->id){{ $object->city }}@else{{ old("city") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.courtcategorie_id') }}</label> 
            <select class="form-control select_with_filter" id="courtcategorie_id" name="courtcategorie_id">
              @foreach( $courtcategories as $courtcategorie )
              <option value="{{ $courtcategorie->id }}" @if($object->id && $object->courtcategorie_id == $courtcategorie->id ) selected="selected" @endif >{{ $courtcategorie->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.location') }}</label> 
            <input class="form-control" id="location" name="location" value="@if($object->id){{ $object->location }}@else{{ old("location") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.name') }}</label> 
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old("name") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.room_number') }}</label> 
            <input class="form-control" id="room_number" name="room_number" value="@if($object->id){{ $object->room_number }}@else{{ old("room_number") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('court.description') }}</label> 
            <input class="form-control" id="description" name="description" value="@if($object->id){{ $object->description }}@else{{ old("description") }}@endif" type="text" required="" > 
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection