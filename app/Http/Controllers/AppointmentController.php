<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Appointment;
use App\Contact;

class AppointmentController extends Controller
{
    public $model = 'appointment';
    public function filter_fields(){
        return [
            'title'=>[ 'type'=>'text' ],
            'contact_id'=>[ 
                'type'=>'select',
                'table'=>'contacts',
            ],
            'date'=>[ 'type'=>'datepicker' ],
            'motive'=>[ 'type'=>'text' ],
            'note'=>[ 'type'=>'text' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $appointments = Appointment::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('appointment.list', [
            'results'=>$appointments
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contacts = Contact::all();
        return $this->view_('appointment.update',[
            'object'=> new Appointment(),
            'contacts'=>$contacts
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $appointment = Appointment::create([

            'title'=>request('title'),
            'contact_id'=>request('contact_id'),
            'date'=>request('date'),
            'motive'=>request('motive'),
            'note'=>request('note'),

        ]);

       return redirect()
                ->route('appointment_edit', $appointment->id)
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
        $appointment = Appointment::findOrFail($id);
        $contacts = Contact::all();
        
        return $this->view_('appointment.update', [
            'object'=>$appointment,
            'contacts'=>$contacts
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $appointment = Appointment::findOrFail($id);

        $appointment->title=request('title');
        $appointment->contact_id=request('contact_id');
        $appointment->date=request('date');
        $appointment->motive=request('motive');
        $appointment->note=request('note');

        $appointment->save();

        return redirect()
                ->route('appointment_edit', $appointment->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $appointment = Appointment::findOrFail($id);

        if( $appointment->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('appointment')
            ->with($flash_type, __('global.'.$msg));
    }
}