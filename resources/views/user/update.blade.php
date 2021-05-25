@extends('standard')

@section('content')
  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('user_update',$object->id) }}@else{{ route('user_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('user.user_edit') }}
        @else
          {{ __('user.user_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->getname() }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.role') }}</label>
            <select class="form-control select_with_filter" id="role" name="role" required="">
              @foreach( App\User::$roles__ as $k =>$v)
              <option value="{{ $k }}" @if($object->id && $object->role == $k) selected="selected" @endif >{{ $v }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.email') }}</label>
            <input class="form-control" id="email" name="email" value="@if($object->id){{ $object->getemail() }}@else{{ old('email') }}@endif" type="email">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.password') }}</label>
            <input class="form-control" id="password" name="password" value="" type="password">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.phone') }}</label>
            <input class="form-control" id="phone" value="@if($object->id){{ $object->getphone() }}@else{{ old('phone') }}@endif" name="phone" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.datebirth') }}</label>
            <input class="form-control" id="datebirth" value="@if($object->id){{ $object->getdatebirth() }}@else{{ old('datebirth') }}@endif" name="datebirth" value="" type="date">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.adress') }}</label>
            <input class="form-control" id="adress" value="@if($object->id){{ $object->getadress() }}@else{{ old('adress') }}@endif" name="adress" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.avatar') }}</label>
            @if($object->id){!! $object->getavatar() !!}@endif
            <input class="form-control" id="avatar" name="avatar" type="file">
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.groupes') }}</label>
            @php 
              $usergroupes = [];

              if($object and $object->groupes){
                foreach ($object->groupes as $ug) {
                  $usergroupes[$ug->id] = $ug->id;
                }
              }
            @endphp
            @foreach($groupes as $groupe)
              @php 
                if(in_array($groupe->id, $usergroupes))
                  $check_ = 'checked="checked"';
                else
                  $check_ = '';
              @endphp
              <div class="form-check">
                <input type="checkbox" {{ $check_ }} id="groupe{{$groupe->id}}" name="groupe[{{$groupe->id}}]" value="{{$groupe->id}}" class="form-check-input">
                <label for="groupe{{$groupe->id}}">{{$groupe->name}}</label>
              </div>
            @endforeach
          </div>
        </div>


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection