@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('__ModuleLower___update',$object->id) }}@else{{ route('__ModuleLower___store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('__ModuleLower__.__ModuleLower___edit') }}
        @else
          {{ __('__ModuleLower__.__ModuleLower___create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

__ModuleFields__

      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection