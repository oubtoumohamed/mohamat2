@extends('standard')

@section('head')
<script src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')

  <form class="forme_dit" method="POST" enctype="multipart/form-data" sliderion="@if($object->id){{ route('slider_update',$object->id) }}@else{{ route('slider_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('slider.slider_edit') }}
        @else
          {{ __('slider.slider_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('slider.titre') }}</label>
            <input class="form-control" id="titre" name="titre" value="@if($object->id){{ $object->titre }}@else{{ old('titre') }}@endif" type="text" required="">
          </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">{{ __('slider.description') }}</label>
                <input class="form-control" id="description" name="description" value="@if($object->id){{ $object->description }}@else{{ old('description') }}@endif" type="text" required="">
            </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('slider.image') }}</label>
            @if($object->id){!! $object->getImage() !!}@endif
            <input class="form-control" id="image" name="image" type="file">
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('slider.contenu') }}</label>
            <textarea class="form-control" rows="15" id="contenu" name="contenu">@if($object->id){{ $object->contenu }}@else{{ old('contenu') }}@endif</textarea>
          </div>
        </div>

      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

    <script src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

<script>
  var editor_config = {
    path_absolute : "{{ env('APP_URL', '') }}",
    selector: "textarea#contenu",
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media embed iframe fullpage | forecolor backcolor emoticons PDF POWERPOINT',

    media_url_resolver: function (data, resolve/*, reject*/) {
      if (
        data.url.indexOf('.ppt') !== -1 ||
        data.url.indexOf('.pptx') !== -1 ||
        data.url.indexOf('.pdf') !== -1 ||
        data.url.indexOf('.doc') !== -1 ||
        data.url.indexOf('.docx') !== -1 ||
        data.url.indexOf('.xls') !== -1 ||
        data.url.indexOf('.xlsx') !== -1
      ) {
        var url = data.url.replace('https://docs.google.com/gview?url=','');
        url = url.replace('&embedded=true','');
        var embedHtml = '<iframe datasrc="docs" src="https://docs.google.com/gview?url='+url+'&embedded=true" height="600px" width="100%" frameborder="0" class="ifrm"></iframe>';
        resolve({html: embedHtml});
      } else {
        resolve({html: ''});
      }
    },
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'File Manager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    },
    setup: function (editor) {
      editor.addButton('PDF', {
        text: 'PDF',
        icon: false,
        onclick: function() {
          editor.execCommand('mceMedia');

        }
      });
      editor.addButton('POWERPOINT', {
        text: 'Power Point',
        icon: false,
        onclick: function() {
          editor.execCommand('mceMedia');
        }
      });
    },
  };
  tinymce.init(editor_config);

  function apply_editor(selector){
    var editor_config_textarea = {
      selector: selector,
       menubar:false,
    statusbar: false,
      plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
        'wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'save table contextmenu directionality emoticons template paste textcolor'
      ],
      content_css: 'css/content.css',
      toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link forecolor backcolor'
    };

    tinymce.init(editor_config_textarea);

  }
  apply_editor("textarea.QQUE_TEXTAREA");
</script>
@endsection