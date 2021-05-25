<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Team;
use App\Media;

class TeamController extends Controller
{
    public $model = 'team';
    public function filter_fields(){
        return [
            'picture'=> null,
            'name'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $teams = Team::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('team.list', [
            'results'=>$teams
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('team.update',[
            'object'=> new Team(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $picture = null;

        $media = new Media();
        if($request->file('picture')){
            $media->_file = $request->file('picture');
            $media->_path = 'Team';
            $media = $media->_save();

            if($media)
                $picture = $media->id;
        }

        $team = Team::create([
            'name'=>request('name'),
            'picture'=>$picture,
            'description'=>request('description'),
        ]);

       return redirect()
                ->route('team_edit', $team->id)
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
        $team = Team::findOrFail($id);

        return $this->view_('team.update', [
            'object'=>$team,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $team = Team::findOrFail($id);

        $team->name=request('name');

        $media = new Media();
        if($request->file('picture')){
            if($team->picture)
                $media = Media::find($team->picture);

            $media->_file = $request->file('picture');
            $media->_path = 'Team';
            $media = $media->_save();

            if($media)
                $team->picture = $media->id;
        }

        $team->description=request('description');

        $team->save();

        return redirect()
                ->route('team_edit', $team->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $team = Team::findOrFail($id);

        if( $team->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('team')
            ->with($flash_type, __('global.'.$msg));
    }
}