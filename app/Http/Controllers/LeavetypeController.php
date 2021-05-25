<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Leavetype;

class LeavetypeController extends Controller
{
    public $model = 'leavetype';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'state'=>[ 
                'type'=>'select',
                'data'=>[
                    1 => __('leavetype.active'),
                    0 => __('leavetype.deactive'),
                ],
            ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $leavetypes = Leavetype::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('leavetype.list', [
            'results'=>$leavetypes
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('leavetype.update',[
            'object'=> new Leavetype(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $leavetype = Leavetype::create([

            'name'=>request('name'),
            'state'=>request('state'),

        ]);

       return redirect()
                ->route('leavetype_edit', $leavetype->id)
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
        $leavetype = Leavetype::findOrFail($id);

        return $this->view_('leavetype.update', [
            'object'=>$leavetype,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $leavetype = Leavetype::findOrFail($id);

        $leavetype->name=request('name');
        $leavetype->state=request('state');

        $leavetype->save();

        return redirect()
                ->route('leavetype_edit', $leavetype->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $leavetype = Leavetype::findOrFail($id);

        if( $leavetype->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('leavetype')
            ->with($flash_type, __('global.'.$msg));
    }
}