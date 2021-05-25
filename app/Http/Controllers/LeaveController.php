<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Leave;
use App\Leavetype;
use App\User;

class LeaveController extends Controller
{
    public $model = 'leave';
    public function filter_fields(){
        return [
            'user_id'=>[ 
                'type'=>'select',
                'table'=>'users'
            ],
            'leavetype_id'=>[ 
                'type'=>'select',
                'table'=>'leavetypes'
            ],
            'days'=>[ 'type'=>'number' ],
            'state'=>[ 
                'type'=>'select',
                'data'=>[
                    1 => __('leave.accepted'),
                    0 => __('leave.refused'),
                ],
            ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $leaves = Leave::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('leave.list', [
            'results'=>$leaves
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Leavetype::all();
        $users = User::all();
        return $this->view_('leave.update',[
            'object'=> new Leave(),
            'types'=>$types,
            'users'=>$users,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $leave = Leave::create([

            'user_id'=>request('user_id'),
            'leavetype_id'=>request('leavetype_id'),
            'days'=>request('days'),
            'state'=>request('state'),

        ]);

       return redirect()
                ->route('leave_edit', $leave->id)
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
        $leave = Leave::findOrFail($id);
        $types = Leavetype::all();
        $users = User::all();

        return $this->view_('leave.update', [
            'object'=>$leave,
            'types'=>$types,
            'users'=>$users,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $leave = Leave::findOrFail($id);

        $leave->user_id=request('user_id');
        $leave->leavetype_id=request('leavetype_id');
        $leave->days=request('days');
        $leave->state=request('state');

        $leave->save();

        return redirect()
                ->route('leave_edit', $leave->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $leave = Leave::findOrFail($id);

        if( $leave->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('leave')
            ->with($flash_type, __('global.'.$msg));
    }
}