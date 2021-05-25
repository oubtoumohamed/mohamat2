<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Lawyer;

class LawyerController extends Controller
{
    public $model = 'lawyer';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'mobile'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $lawyers = Lawyer::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('lawyer.list', [
            'results'=>$lawyers
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('lawyer.update',[
            'object'=> new Lawyer(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $lawyer = Lawyer::create([

            'name'=>request('name'),
            'mobile'=>request('mobile'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('lawyer_edit', $lawyer->id)
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
        $lawyer = Lawyer::findOrFail($id);

        return $this->view_('lawyer.update', [
            'object'=>$lawyer,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $lawyer = Lawyer::findOrFail($id);

        $lawyer->name=request('name');
        $lawyer->mobile=request('mobile');
        $lawyer->description=request('description');

        $lawyer->save();

        return redirect()
                ->route('lawyer_edit', $lawyer->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $lawyer = Lawyer::findOrFail($id);

        if( $lawyer->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('lawyer')
            ->with($flash_type, __('global.'.$msg));
    }
}