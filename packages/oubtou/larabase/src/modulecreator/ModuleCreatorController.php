<?php

namespace Oubtou\Larabase\ModuleCreator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Oubtou\Larabase\ModuleCreator\ModuleCreator;

class ModuleCreatorController extends Controller
{
    /*
     * Create a new controller instance.
     */

    public function __construct()
    {
        //$this->middleware('auth');

    }

    /*
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ModuleCreator::update');
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $rqst)
    {        
        $this->validate(request(), [
            'name' => 'required|string',
        ]);



        $module = new ModuleCreator();

        $module->name = $rqst->name;
        $module->description = $rqst->description;
        $module->fields = $rqst->fields;


        $module->migration();

        return redirect()->back();
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
        /*$user = User::findOrFail($id);
        return view('user.show', [
            'object'=>$user
        ]);*/
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groupes = Groupe::all();

        return view('user.update', [
            'object'=>$user,
            'groupes'=>$groupes
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = request('name');
        $user->email = request('email');
        $user->cin = request('cin');
        $user->phone = request('phone');
        //$user->role = request('role');
            $media = new Media();
        if($request->file('avatar')){
            if($user->avatar)
                $media = Media::find($user->avatar);

            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar';
            $media = $media->_save();

            if($media)
                $user->avatar = $media->id;
        }

        if(request('password'))
            $user->password = bcrypt(request('password'));
            
        $user->groupes()->sync(request('groupe'));
        
        $user->save();

        return redirect()->route('user_edit', $user->id);
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if( $user->picture )
            $user->picture->delete();
        $user->delete();

        return redirect()->route('user');
    }

}
