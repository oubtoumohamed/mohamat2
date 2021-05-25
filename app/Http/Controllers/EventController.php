<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Event;
use App\User;

class EventController extends Controller
{
    public $model = 'event';
    public function filter_fields(){
        return [
            'title'=>[ 'type'=>'text' ],
            'user_id'=>[ 
                'type'=>'select',
                'table'=>'users',
            ],
            'location'=>[ 'type'=>'text' ],
            'start_date'=>[ 'type'=>'datepicker' ],
            'end_date'=>[ 'type'=>'datepicker' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $events = Event::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('event.list', [
            'results'=>$events
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return $this->view_('event.update',[
            'object'=> new Event(),
            'users'=>$users,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $event = Event::create([

            'title'=>request('title'),
            'user_id'=>request('user_id'),
            'location'=>request('location'),
            'start_date'=>request('start_date'),
            'end_date'=>request('end_date'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('event_edit', $event->id)
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
        $event = Event::findOrFail($id);
        $users = User::all();

        return $this->view_('event.update', [
            'object'=>$event,
            'users'=>$users,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $event = Event::findOrFail($id);

        $event->title=request('title');
        $event->user_id=request('user_id');
        $event->location=request('location');
        $event->start_date=request('start_date');
        $event->end_date=request('end_date');
        $event->description=request('description');

        $event->save();

        return redirect()
                ->route('event_edit', $event->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $event = Event::findOrFail($id);

        if( $event->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('event')
            ->with($flash_type, __('global.'.$msg));
    }
}