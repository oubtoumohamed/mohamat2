<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Courtcategorie;

class CourtcategorieController extends Controller
{
    public $model = 'courtcategorie';
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
        $courtcategories = Courtcategorie::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('courtcategorie.list', [
            'results'=>$courtcategories
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('courtcategorie.update',[
            'object'=> new Courtcategorie(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $courtcategorie = Courtcategorie::create([

            'name'=>request('name'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('courtcategorie_edit', $courtcategorie->id)
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
        $courtcategorie = Courtcategorie::findOrFail($id);

        return $this->view_('courtcategorie.update', [
            'object'=>$courtcategorie,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $courtcategorie = Courtcategorie::findOrFail($id);

        $courtcategorie->name=request('name');
        $courtcategorie->description=request('description');

        $courtcategorie->save();

        return redirect()
                ->route('courtcategorie_edit', $courtcategorie->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $courtcategorie = Courtcategorie::findOrFail($id);

        if( $courtcategorie->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('courtcategorie')
            ->with($flash_type, __('global.'.$msg));
    }
}