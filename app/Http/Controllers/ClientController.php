<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Client;
use App\Clientcategorie;

class ClientController extends Controller
{
    public $model = 'client';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'mobile'=>[ 'type'=>'text' ],
            'email'=>[ 'type'=>'text' ],
            'gender'=>[ 'type'=>'text' ],
            'country'=>[ 'type'=>'text' ],
            'state'=>[ 'type'=>'text' ],
            'city'=>[ 'type'=>'text' ],
            'adress'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],
            'clientcategorie_id'=>[ 
                'type'=>'select',
                'table'=>'clientcategories',
            ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $clients = Client::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('client.list', [
            'results'=>$clients
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Clientcategorie::all();
        return $this->view_('client.update',[
            'object'=> new Client(),
            'categories'=>$categories
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $client = Client::create([

            'name'=>request('name'),
            'mobile'=>request('mobile'),
            'email'=>request('email'),
            'gender'=>request('gender'),
            'country'=>request('country'),
            'state'=>request('state'),
            'city'=>request('city'),
            'adress'=>request('adress'),
            'description'=>request('description'),
            'clientcategorie_id'=>request('clientcategorie_id'),

        ]);

       return redirect()
                ->route('client_edit', $client->id)
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
        $client = Client::findOrFail($id);
        $categories = Clientcategorie::all();

        return $this->view_('client.update', [
            'object'=>$client,
            'categories'=>$categories,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $client = Client::findOrFail($id);

        $client->name=request('name');
        $client->mobile=request('mobile');
        $client->email=request('email');
        $client->gender=request('gender');
        $client->country=request('country');
        $client->state=request('state');
        $client->city=request('city');
        $client->adress=request('adress');
        $client->description=request('description');
        $client->clientcategorie_id=request('clientcategorie_id');

        $client->save();

        return redirect()
                ->route('client_edit', $client->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $client = Client::findOrFail($id);

        if( $client->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('client')
            ->with($flash_type, __('global.'.$msg));
    }
}