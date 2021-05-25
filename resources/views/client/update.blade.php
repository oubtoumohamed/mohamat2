@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('client_update',$object->id) }}@else{{ route('client_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('client.client_edit') }}
        @else
          {{ __('client.client_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.name') }}</label> 
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old("name") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.mobile') }}</label> 
            <input class="form-control" id="mobile" name="mobile" value="@if($object->id){{ $object->mobile }}@else{{ old("mobile") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.email') }}</label> 
            <input class="form-control" id="email" name="email" value="@if($object->id){{ $object->email }}@else{{ old("email") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.gender') }}</label>
            <select id="gender" name="gender" class="form-control select_with_filter">
              <option value="1" @if($object->id && $object->gender == 1) selected="selected" @endif >{{ __('client.man') }}</option>
              <option value="0" @if($object->id && $object->gender == 0) selected="selected" @endif >{{ __('client.women') }}</option>
            </select> 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.country') }}</label> 
            <input class="form-control" id="country" name="country" value="@if($object->id){{ $object->country }}@else{{ old("country") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.state') }}</label> 
            <input class="form-control" id="state" name="state" value="@if($object->id){{ $object->state }}@else{{ old("state") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.city') }}</label> 
            <input class="form-control" id="city" name="city" value="@if($object->id){{ $object->city }}@else{{ old("city") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.adress') }}</label> 
            <input class="form-control" id="adress" name="adress" value="@if($object->id){{ $object->adress }}@else{{ old("adress") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.description') }}</label> 
            <input class="form-control" id="description" name="description" value="@if($object->id){{ $object->description }}@else{{ old("description") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('client.clientcategorie_id') }}</label> 
            <select id="clientcategorie_id" name="clientcategorie_id" class="form-control select_with_filter">
              <option value=""></option>
              @foreach( $categories as $cat )
              <option value="{{ $cat->id }}" @if($object->id && $object->clientcategorie_id == $cat->id ) selected="selected" @endif >{{ $cat->name }}</option>
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