<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Court;
use App\Courtcategorie;

class CourtController extends Controller
{
    public $model = 'court';
    public function filter_fields(){
        return [
            'country'=>[ 'type'=>'text' ],
            'state'=>[ 'type'=>'text' ],
            'city'=>[ 'type'=>'text' ],
            'courtcategorie_id'=>[ 
                'type'=>'select', 
                'table'=>'courtcategories', 
            ],
            'location'=>[ 'type'=>'text' ],
            'name'=>[ 'type'=>'text' ],
            'room_number'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $courts = Court::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('court.list', [
            'results'=>$courts
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courtcategories = Courtcategorie::all();
        return $this->view_('court.update',[
            'object'=> new Court(),
            'courtcategories'=>$courtcategories
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $court = Court::create([

            'country'=>request('country'),
            'state'=>request('state'),
            'city'=>request('city'),
            'courtcategorie_id'=>request('courtcategorie_id'),
            'location'=>request('location'),
            'name'=>request('name'),
            'room_number'=>request('room_number'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('court_edit', $court->id)
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
        $court = Court::findOrFail($id);
        $courtcategories = Courtcategorie::all();

        return $this->view_('court.update', [
            'object'=>$court,
            'courtcategories'=>$courtcategories,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $court = Court::findOrFail($id);

        $court->country=request('country');
        $court->state=request('state');
        $court->city=request('city');
        $court->courtcategorie_id=request('courtcategorie_id');
        $court->location=request('location');
        $court->name=request('name');
        $court->room_number=request('room_number');
        $court->description=request('description');

        $court->save();

        return redirect()
                ->route('court_edit', $court->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $court = Court::findOrFail($id);

        if( $court->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('court')
            ->with($flash_type, __('global.'.$msg));
    }
}