<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Slider;
use App\Media;

class SliderController extends Controller
{
    public $model = 'slider';
    public function filter_fields(){
        return [
            'image' => null,
            'titre'=>[
                'type'=>'text'
            ],
            'description'=>[
                'type'=>'text'
            ],
            'link'=>[
                'type'=>'text'
            ]
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $sliders = Slider::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['slider'=>null]));
        return $this->view_('slider.list', [
            'results'=>$sliders
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('slider.update',[
            'object'=> new Slider(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $image = null;

        $media = new Media();
        if($request->file('image')){
            $media->_file = $request->file('image');
            $media->_path = 'Image';
            $media = $media->_save();

            if($media)
                $image = $media->id;
        }

        $this->validate(request(), [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'description' => 'required|string|max:255',
        ]);

        $slider = Slider::create([
            'titre'=>request('titre'),
            'link'=> $this->slugify('sliders', 'link', request('titre'), '-') ,
            'contenu'=>request('contenu'),
            'description'=>request('description'),
            'image'=>$image,
        ]);
       

       return redirect()
                ->route('slider_edit', $slider->id)
                ->with('success', __('global.create_succees'));
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
    }

    
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return $this->view_('slider.update', [
            'object'=>$slider,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'titre' => 'required|string|max:255'
        ]);
      
        $slider = Slider::findOrFail($id);

        $slider->titre = request('titre');
        //$slider->link =  $this->slugify('sliders', 'link', request('titre'), '-');
        $slider->contenu = request('contenu');

        $slider->description = request('description');
        
        $media = new Media();
        if($request->file('image')){
            if($slider->image)
                $media = Media::find($slider->image);

            $media->_file = $request->file('image');
            $media->_path = 'Image';
            $media = $media->_save();

            if($media)
                $slider->image = $media->id;
        }

        $slider->save();

        return redirect()
                ->route('slider_edit', $slider->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $slider = Slider::findOrFail($id);

        if( $slider->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('slider')
            ->with($flash_type, __('global.'.$msg));
    }

    public function front($link)
    {
        $slider = Slider::where('link','=',$link)->firstOrFail();
        return $this->view_('frontend.slider.slider', [
            'object'=>$slider,
        ]);
    }

}