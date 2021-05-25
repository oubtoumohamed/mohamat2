@extends('standard')

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('casee_update',$object->id) }}@else{{ route('casee_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('casee.casee_edit') }}
        @else
          {{ __('casee.casee_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.number') }}</label> 
            <input class="form-control" id="number" name="number" value="@if($object->id){{ $object->number }}@else{{ old("number") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.filenumber') }}</label> 
            <input class="form-control" id="filenumber" name="filenumber" value="@if($object->id){{ $object->filenumber }}@else{{ old("filenumber") }}@endif" type="text" required="" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.acts') }}</label> 
            <select class="form-control select_with_filter" multiple="multiple" id="acts[]" name="acts[]" >
              @foreach( $acts as $act )
              <option value="{{ $act->id }}" @if($object->id && in_array( $act->id, $object->getactsArray() ) ) selected="selected" @endif >{{ $act->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.behalfof') }}</label> 
            <select class="form-control select_with_filter" id="behalfof" name="behalfof" >
              @foreach( $clientcategories as $ccat )
              <option value="{{ $ccat->id }}" @if($object->id && $object->behalfof == $ccat->id ) selected="selected" @endif >{{ $ccat->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.plaintiff') }}</label> 
            <select class="form-control select_with_filter" id="plaintiff" name="plaintiff" required="" >
              @foreach( $clients as $client )
              <option value="{{ $client->id }}" @if($object->id && $object->plaintiff == $client->id ) selected="selected" @endif >{{ $client->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.accuesed') }}</label> 
            <select class="form-control select_with_filter" id="accuesed" name="accuesed" required="" >
              @foreach( $clients as $client )
              <option value="{{ $client->id }}" @if($object->id && $object->accuesed == $client->id ) selected="selected" @endif >{{ $client->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.court_id') }}</label> 
            <select class="form-control select_with_filter" id="court_id" name="court_id">
              @foreach( $courts as $court )
              <option value="{{ $court->id }}" @if($object->id && $object->court_id == $court->id ) selected="selected" @endif >{{ $court->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.categorie_id') }}</label> 
            <select class="form-control select_with_filter" id="categorie_id" name="categorie_id">
              @foreach( $casecategories as $ccategorie )
              <option value="{{ $ccategorie->id }}" @if($object->id && $object->categorie_id == $ccategorie->id ) selected="selected" @endif >{{ $ccategorie->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.refname') }}</label> 
            <input class="form-control" id="refname" name="refname" value="@if($object->id){{ $object->refname }}@else{{ old("refname") }}@endif" type="text" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.refmobile') }}</label> 
            <input class="form-control" id="refmobile" name="refmobile" value="@if($object->id){{ $object->refmobile }}@else{{ old("refmobile") }}@endif" type="text" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.lawyer_id') }}</label> 
            <select class="form-control select_with_filter" id="lawyer_id" name="lawyer_id">
              @foreach( $lawyers as $lawyer )
              <option value="{{ $lawyer->id }}" @if($object->id && $object->lawyer_id == $lawyer->id ) selected="selected" @endif >{{ $lawyer->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.stage_id') }}</label> 
            <select class="form-control select_with_filter" id="stage_id" name="stage_id">
              @foreach( $stages as $stage )
              <option value="{{ $stage->id }}" @if($object->id && $object->stage_id == $stage->id ) selected="selected" @endif >{{ $stage->name }}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.receiving_date') }}</label> 
            <input class="form-control" id="receiving_date" name="receiving_date" value="@if($object->id){{ $object->receiving_date }}@else{{ old("receiving_date") }}@endif" type="date" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.filing_date') }}</label> 
            <input class="form-control" id="filing_date" name="filing_date" value="@if($object->id){{ $object->filing_date }}@else{{ old("filing_date") }}@endif" type="date" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.hearing_date') }}</label> 
            <input class="form-control" id="hearing_date" name="hearing_date" value="@if($object->id){{ $object->hearing_date }}@else{{ old("hearing_date") }}@endif" type="date" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.judgement_date') }}</label> 
            <input class="form-control" id="judgement_date" name="judgement_date" value="@if($object->id){{ $object->judgement_date }}@else{{ old("judgement_date") }}@endif" type="date" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.description') }}</label> 
            <input class="form-control" id="description" name="description" value="@if($object->id){{ $object->description }}@else{{ old("description") }}@endif" type="text" > 
          </div> 
        </div> 
        <div class='col-md-6'> 
          <div class='form-group'> 
            <label class='form-label'>{{ __('casee.media_id') }}</label> 
            <input class="form-control" id="media_id" name="media_id" value="@if($object->id){{ $object->media_id }}@else{{ old("media_id") }}@endif" type="file" > 
          </div> 
        </div> 


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

@endsection