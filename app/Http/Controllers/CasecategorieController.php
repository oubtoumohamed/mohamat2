<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Casecategorie;

class CasecategorieController extends Controller
{
    public $model = 'casecategorie';
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
        $casecategories = Casecategorie::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('casecategorie.list', [
            'results'=>$casecategories
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('casecategorie.update',[
            'object'=> new Casecategorie(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $casecategorie = Casecategorie::create([

            'name'=>request('name'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('casecategorie_edit', $casecategorie->id)
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
        $casecategorie = Casecategorie::findOrFail($id);

        return $this->view_('casecategorie.update', [
            'object'=>$casecategorie,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $casecategorie = Casecategorie::findOrFail($id);

        $casecategorie->name=request('name');
        $casecategorie->description=request('description');

        $casecategorie->save();

        return redirect()
                ->route('casecategorie_edit', $casecategorie->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $casecategorie = Casecategorie::findOrFail($id);

        if( $casecategorie->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('casecategorie')
            ->with($flash_type, __('global.'.$msg));
    }
}