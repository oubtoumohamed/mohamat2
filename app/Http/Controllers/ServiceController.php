<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public $model = 'service';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'icon'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $services = Service::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('service.list', [
            'results'=>$services
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('service.update',[
            'object'=> new Service(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $service = Service::create([

            'name'=>request('name'),
            'icon'=>request('icon'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('service_edit', $service->id)
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
        $service = Service::findOrFail($id);

        return $this->view_('service.update', [
            'object'=>$service,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $service = Service::findOrFail($id);

        $service->name=request('name');
        $service->icon=request('icon');
        $service->description=request('description');

        $service->save();

        return redirect()
                ->route('service_edit', $service->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $service = Service::findOrFail($id);

        if( $service->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('service')
            ->with($flash_type, __('global.'.$msg));
    }
}