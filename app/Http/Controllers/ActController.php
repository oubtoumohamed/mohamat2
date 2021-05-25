<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Act;

class ActController extends Controller
{
    public $model = 'act';
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
        $acts = Act::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('act.list', [
            'results'=>$acts
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('act.update',[
            'object'=> new Act(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $act = Act::create([

            'name'=>request('name'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('act_edit', $act->id)
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
        $act = Act::findOrFail($id);

        return $this->view_('act.update', [
            'object'=>$act,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $act = Act::findOrFail($id);

        $act->name=request('name');
        $act->description=request('description');

        $act->save();

        return redirect()
                ->route('act_edit', $act->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $act = Act::findOrFail($id);

        if( $act->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('act')
            ->with($flash_type, __('global.'.$msg));
    }
}