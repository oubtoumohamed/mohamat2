<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Stage;

class StageController extends Controller
{
    public $model = 'stage';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $stages = Stage::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('stage.list', [
            'results'=>$stages
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('stage.update',[
            'object'=> new Stage(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $stage = Stage::create([

            'name'=>request('name'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('stage_edit', $stage->id)
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
        $stage = Stage::findOrFail($id);

        return $this->view_('stage.update', [
            'object'=>$stage,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $stage = Stage::findOrFail($id);

        $stage->name=request('name');
        $stage->description=request('description');

        $stage->save();

        return redirect()
                ->route('stage_edit', $stage->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $stage = Stage::findOrFail($id);

        if( $stage->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('stage')
            ->with($flash_type, __('global.'.$msg));
    }
}