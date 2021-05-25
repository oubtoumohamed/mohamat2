<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contactcategorie;

class ContactcategorieController extends Controller
{
    public $model = 'contactcategorie';
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
        $contactcategories = Contactcategorie::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('contactcategorie.list', [
            'results'=>$contactcategories
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('contactcategorie.update',[
            'object'=> new Contactcategorie(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $contactcategorie = Contactcategorie::create([

            'name'=>request('name'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('contactcategorie_edit', $contactcategorie->id)
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
        $contactcategorie = Contactcategorie::findOrFail($id);

        return $this->view_('contactcategorie.update', [
            'object'=>$contactcategorie,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $contactcategorie = Contactcategorie::findOrFail($id);

        $contactcategorie->name=request('name');
        $contactcategorie->description=request('description');

        $contactcategorie->save();

        return redirect()
                ->route('contactcategorie_edit', $contactcategorie->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $contactcategorie = Contactcategorie::findOrFail($id);

        if( $contactcategorie->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('contactcategorie')
            ->with($flash_type, __('global.'.$msg));
    }
}