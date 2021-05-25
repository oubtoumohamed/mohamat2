<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Task;
use App\Casee;
use App\User;
use App\Stage;

class TaskController extends Controller
{
    public $model = 'task';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'case_id'=>[ 
                'type'=>'select',
                'table'=>'casees',
                'fields' => ['id as key_','number as value_'],
            ],
            'user_id'=>[ 
                'type'=>'select',
                'table'=>'users',
            ],
            'priority'=>[ 
                'type'=>'select',
                'data'=>[
                    'high'=> __('task.high'),
                    'meduim'=> __('task.meduim'),
                    'low'=> __('task.low'),
                ],
            ],
            'stage_id'=>[ 
                'type'=>'select',
                'table'=>'stages',
            ],
            'date'=>[ 'type'=>'datepicker' ],
            'description'=>[ 'type'=>'text' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $tasks = Task::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('task.list', [
            'results'=>$tasks
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cases = Casee::all();
        $users = User::all();
        $stages = Stage::all();

        return $this->view_('task.update',[
            'object'=> new Task(),
            'cases'=> $cases,
            'users'=> $users,
            'stages'=> $stages,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);
        $task = Task::create([

            'name'=>request('name'),
            'case_id'=>request('case_id'),
            'user_id'=>request('user_id'),
            'priority'=>request('priority'),
            'stage_id'=>request('stage_id'),
            'date'=>request('date'),
            'description'=>request('description'),

        ]);

       return redirect()
                ->route('task_edit', $task->id)
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
        $task = Task::findOrFail($id);
        
        $cases = Casee::all();
        $users = User::all();
        $stages = Stage::all();

        return $this->view_('task.update', [
            'object'=>$task,
            'cases'=> $cases,
            'users'=> $users,
            'stages'=> $stages,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $task = Task::findOrFail($id);

        $task->name=request('name');
        $task->case_id=request('case_id');
        $task->user_id=request('user_id');
        $task->priority=request('priority');
        $task->stage_id=request('stage_id');
        $task->date=request('date');
        $task->description=request('description');

        $task->save();

        return redirect()
                ->route('task_edit', $task->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $task = Task::findOrFail($id);

        if( $task->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('task')
            ->with($flash_type, __('global.'.$msg));
    }
}