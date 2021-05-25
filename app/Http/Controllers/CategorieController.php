<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Categorie;
use App\User;
use App\Media;

class CategorieController extends Controller
{
    public $model = 'categorie';
    public function filter_fields(){
        return [
            'label'=>[
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
        $categories = Categorie::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['categorie'=>null]));
        return $this->view_('categorie.list', [
            'results'=>$categories
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return $this->view_('categorie.update',[
            'object'=> new Categorie(),
            'users' => $users,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'label' => 'required|string|max:255',
            
        ]);

        $categorie = Categorie::create([
            'label'=>request('label'),
        ]);
       

       return redirect()
                ->route('categorie_edit', $categorie->id)
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
        $categorie = Categorie::findOrFail($id);

        $users = User::all();

        return $this->view_('categorie.update', [
            'object'=>$categorie,
            'users' => $users,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'label' => 'required|string|max:255'
        ]);
      
        $categorie = Categorie::findOrFail($id);

        $categorie->label = request('label');
       

        $categorie->save();

        return redirect()
                ->route('categorie_edit', $categorie->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $categorie = Categorie::findOrFail($id);

        if( $categorie->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('categorie')
            ->with($flash_type, __('global.'.$msg));
    }
}