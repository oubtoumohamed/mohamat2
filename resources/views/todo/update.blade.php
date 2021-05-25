@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('todo_update',$object->id) }}@else{{ route('todo_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('todo.todo_edit') }}
        @else
          {{ __('todo.todo_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('todo.title') }}</label> 
            <input class="form-control" id="title" name="title" value="@if($object->id){{ $object->title }}@else{{ old("title") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('todo.date') }}</label> 
            <input class="form-control" id="date" name="date" value="@if($object->id){{ $object->date }}@else{{ old("date") }}@endif" type="date"> 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('todo.state') }}</label> 
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