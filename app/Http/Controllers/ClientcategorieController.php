<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Clientcategorie;

class ClientcategorieController extends Controller
{
    public $model = 'clientcategorie';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],
            'behalf_plaintiff'=>[ 'type'=>'text' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $clientcategories = Clientcategorie::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('clientcategorie.list', [
            'results'=>$clientcategories
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('clientcategorie.update',[
            'object'=> new Clientcategorie(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $clientcategorie = Clientcategorie::create([

            'name'=>request('name'),
            'description'=>request('description'),
            'behalf_plaintiff'=>request('behalf_plaintiff'),

        ]);

       return redirect()
                ->route('clientcategorie_edit', $clientcategorie->id)
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
        $clientcategorie = Clientcategorie::findOrFail($id);

        return $this->view_('clientcategorie.update', [
            'object'=>$clientcategorie,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $clientcategorie = Clientcategorie::findOrFail($id);

        $clientcategorie->name=request('name');
        $clientcategorie->description=request('description');
        $clientcategorie->behalf_plaintiff=request('behalf_plaintiff');

        $clientcategorie->save();

        return redirect()
                ->route('clientcategorie_edit', $clientcategorie->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $clientcategorie = Clientcategorie::findOrFail($id);

        if( $clientcategorie->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('clientcategorie')
            ->with($flash_type, __('global.'.$msg));
    }
}