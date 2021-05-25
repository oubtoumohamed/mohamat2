@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('clientcategorie_update',$object->id) }}@else{{ route('clientcategorie_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('clientcategorie.clientcategorie_edit') }}
        @else
          {{ __('clientcategorie.clientcategorie_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('clientcategorie.name') }}</label> 
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old("name") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('clientcategorie.description') }}</label> 
            <input class="form-control" id="description" name="description" value="@if($object->id){{ $object->description }}@else{{ old("description") }}@endif" type="text"> 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'><input id="behalf_plaintiff" name="behalf_plaintiff" @if($object->id && $object->behalf_plaintiff ) checked="checked" @endif type="checkbox" value="1"> 
            {{ __('clientcategorie.behalf_plaintiff') }}</label> 
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection