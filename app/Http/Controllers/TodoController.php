<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public $model = 'todo';
    public function filter_fields(){
        return [
            'title'=>[ 'type'=>'text' ],
            'date'=>[ 'type'=>'datepicker' ],
            'state'=>[ 
                'type'=>'select',
                'data'=>[
                    0 => __('todo.noncomplete'),
                    1 => __('todo.complete'),
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
        $todos = Todo::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('todo.list', [
            'results'=>$todos
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('todo.update',[
            'object'=> new Todo(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $todo = Todo::create([

            'title'=>request('title'),
            'date'=>request('date'),
            'state'=>request('state'),

        ]);

       return redirect()
                ->route('todo_edit', $todo->id)
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
        $todo = Todo::findOrFail($id);

        return $this->view_('todo.update', [
            'object'=>$todo,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $todo = Todo::findOrFail($id);

        $todo->title=request('title');
        $todo->date=request('date');
        $todo->state=request('state');

        $todo->save();

        return redirect()
                ->route('todo_edit', $todo->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $todo = Todo::findOrFail($id);

        if( $todo->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('todo')
            ->with($flash_type, __('global.'.$msg));
    }
}