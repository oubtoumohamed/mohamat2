@extends('standard')

@section('content')
  <form class="forme_dit" method="POST" enctype="multipart/form-data" categorieion="@if($object->id){{ route('categorie_update',$object->id) }}@else{{ route('categorie_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('categorie.categorie_edit') }}
        @else
          {{ __('categorie.categorie_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('categorie.label') }}</label>
            <input class="form-control" id="label" name="label" value="@if($object->id){{ $object->label }}@else{{ old('label') }}@endif" type="text" required="">
          </div>
        </div>

      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection