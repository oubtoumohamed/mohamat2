@extends('standard')

@section('content')
  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="{{ route('user_updateprofile') }}">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        {{ __('user.profile') }}
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

      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" id="save_btn" class="btn btn-lg btn-success"> <i class="fa fa-check"></i>&nbsp; {{ __('global.submit') }}</button>
    </div>
  </form>

@endsection