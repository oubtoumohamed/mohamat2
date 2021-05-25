@extends('standard')

@section('content')
  <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('modulecreator_store') }}">
    {{ csrf_field() }}
    <div class="card-body">

      <h3 class="card-title">
        {{ __('modulecreator.create') }}
      </h3>
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('modulecreator.modulename') }}</label>
            <input class="form-control" id="name" name="name" value="" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('modulecreator.moduledescription') }}</label>
            <input class="form-control" id="description" name="description" value="" type="text">
          </div>
        </div>

      </div>

      <h3 class="card-title text-center p-2 m-2" style="background: var(--bs-light);">
        {{ __('modulecreator.fields') }}
      </h3>

      <div class="row" id="fields"></div>
      <span class="btn btn-primary mt-4" id="addfield">{{ __('modulecreator.addfield') }}</span>

    </div>
    <div class="card-footer text-right">
      {!! update_actions() !!}
    </div>
  </form>

  <script type="text/javascript">
    $(document).ready(function(){
      var mc_index = 1;
      $('#addfield').click(function(){
        //
        $('#fields').append('<div class="col-md-3"> <div class="form-group"> <label class="form-label">{{ __('modulecreator.fieldname') }}</label> <input class="form-control" name="fields['+mc_index+'][name]" value="" type="text" required=""> </div> </div> <div class="col-md-3"> <div class="form-group"> <label class="form-label">{{ __('modulecreator.fieldtype') }}</label> <select class="form-control" required="" name="fields['+mc_index+'][type]"> <option value=""></option>  <option value="integer">Integer</option> <option value="boolean">Boolean</option> <option value="string">String</option> <option value="text">Text</option> <option value="mediumText">Medium Text</option> <option value="longText">Long Text</option> <option value="date">Date</option> <option value="time">Time</option> <option value="dateTime">Date Time</option> <option value="float">Float</option> <option value="decimal">Decimal</option> <option value="double">Double</option> </select> </div> </div> <div class="col-md-3"> <div class="form-group"> <label class="form-label">{{ __('modulecreator.fieldtitle') }}</label> <input class="form-control" name="fields['+mc_index+'][title]" value="" type="text"> </div> </div> <div class="col-md-3"> <div class="form-group"> <label class="form-label">{{ __('modulecreator.fieldnullable') }}</label> <div class="form-check form-switch"> <input class="form-check-input" name="fields['+mc_index+'][nullable]" type="checkbox" id="fs'+mc_index+'" checked=""> <label class="form-check-label" for="fs'+mc_index+'"></label> <button type="button" class="btn btn-danger" style="float: right;">X</button> </div> </div> </div>');

        mc_index++;
      });
    });
  </script>

@endsection