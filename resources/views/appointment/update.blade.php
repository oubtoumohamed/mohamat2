@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('appointment_update',$object->id) }}@else{{ route('appointment_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('appointment.appointment_edit') }}
        @else
          {{ __('appointment.appointment_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('appointment.title') }}</label> 
            <input class="form-control" id="title" name="title" value="@if($object->id){{ $object->title }}@else{{ old("title") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('appointment.contact_id') }}</label>
            <select id="contact_id" name="contact_id" class="form-control" required="">
              @foreach( $contacts as $contact )
              <option value="{{ $contact->id }}" @if( $object->id && $object->contact_id == $contact->id ) selected="selected" @endif>{{ $contact->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('appointment.date') }}</label> 
            <input class="form-control" id="date" name="date" value="@if($object->id){{ $object->date }}@else{{ old("date") }}@endif" type="date" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('appointment.motive') }}</label> 
            <input class="form-control" id="motive" name="motive" value="@if($object->id){{ $object->motive }}@else{{ old("motive") }}@endif" type="text"> 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('appointment.note') }}</label> 
            <input class="form-control" id="note" name="note" value="@if($object->id){{ $object->note }}@else{{ old("note") }}@endif" type="text"> 
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection