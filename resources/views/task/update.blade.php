@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('task_update',$object->id) }}@else{{ route('task_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('task.task_edit') }}
        @else
          {{ __('task.task_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('task.name') }}</label> 
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old("name") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('task.case_id') }}</label> 
            <select class="form-control select_with_filter" id="case_id" name="case_id">
              @foreach( $cases as $case )
              <option value="{{ $case->id }}" @if($object->id && $object->case_id == $case->id ) selected="selected" @endif >{{ $case->number }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('task.user_id') }}</label> 
            <select class="form-control select_with_filter" id="user_id" name="user_id">
              @foreach( $users as $user )
              <option value="{{ $user->id }}" @if($object->id && $object->user_id == $user->id ) selected="selected" @endif >{{ $user->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('task.priority') }}</label> 

            <select class="form-control select_with_filter" id="priority" name="priority" required="">
              @foreach( $object->priorities() as $k=>$v )
              <option value="{{ $k }}" @if($object->id && $object->priority == $k) selected="selected" @endif >{{ $v }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('task.stage_id') }}</label> 
            <select class="form-control select_with_filter" id="stage_id" name="stage_id">
              @foreach( $stages as $stage )
              <option value="{{ $stage->id }}" @if($object->id && $object->stage_id == $stage->id ) selected="selected" @endif >{{ $stage->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('task.date') }}</label> 
            <input class="form-control" id="date" name="date" value="@if($object->id){{ $object->date }}@else{{ old("date") }}@endif" type="date" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('task.description') }}</label> 
            <input class="form-control" id="description" name="description" value="@if($object->id){{ $object->description }}@else{{ old("description") }}@endif" type="text" > 
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection