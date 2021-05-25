@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('contact_update',$object->id) }}@else{{ route('contact_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('contact.contact_edit') }}
        @else
          {{ __('contact.contact_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('contact.name') }}</label> 
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old("name") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('contact.contactcategorie_id') }}</label>
            <select id="contactcategorie_id" name="contactcategorie_id" class="form-control select_with_filter">
              <option value=""></option>
              @foreach( $categories as $cat )
              <option value="{{ $cat->id }}" @if($object->id && $object->contactcategorie_id == $cat->id ) selected="selected" @endif >{{ $cat->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('contact.mobile') }}</label> 
            <input class="form-control" id="mobile" name="mobile" value="@if($object->id){{ $object->mobile }}@else{{ old("mobile") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('contact.email') }}</label> 
            <input class="form-control" id="email" name="email" value="@if($object->id){{ $object->email }}@else{{ old("email") }}@endif" type="text"> 
          </div> 
        </div> 
        <div class='col-md-12'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('contact.description') }}</label> 
            <textarea class="form-control" id="description" name="description">@if($object->id){{ $object->description }}@else{{ old("description") }}@endif</textarea>
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection