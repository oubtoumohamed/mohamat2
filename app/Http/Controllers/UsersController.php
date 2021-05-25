<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Etudient;
use App\Prof;
use App\Groupe;
use App\Media;

class UsersController extends Controller
{
    /*
     * Create a new controller instance.
     */

    public $model = 'user';
    public function filter_fields(){
        return [
            'avatar'=>null,
            'name'=>[
                'type'=>'text',
            ],
            'role'=>[
                'type'=>'select',
                'data'=>[
                    'EMPLOYE'=>'EMPLOYE',
                    'ADMIN'=>'ADMIN',
                ]
                /*'table' => 'users',
                'distinct' => 'role',
                'fields' => ['role as key_','role as value_'],*/
            ],
            'email'=>[
                'type'=>'text',
            ],
            'phone'=>[
                'type'=>'text',
            ],
            'groupes' => [
                'type' => 'select',
                'operation'=>null,
                'data' => [],
                'table' => 'groupes',
                'fields' => ['id as key_','name as value_'],
                'where' => [],
            ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }

    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where($this->filter(false))
                    ->orderBy($this->orderby, 'desc')
                    ->paginate($this->perpage())
                    ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('user.list', [
            'results'=>$users
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupes = Groupe::all();
        
        return $this->view_('user.update',[
            'object'=> new User(),
            'groupes'=>$groupes
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avatar = null;

        $media = new Media();
        if($request->file('avatar')){
            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar';
            $media = $media->_save();

            if($media)
                $avatar = $media->id;
        }

        $user = User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'datebirth'=>request('datebirth'),
            'adress'=>request('adress'),
            'avatar'=>$avatar,
            'password'=>bcrypt( request('password') ),
        ]);

           
        $user->groupes()->sync(request('groupe'));

        return redirect()->route('user_edit', $user->id);
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
        /*$user = User::findOrFail($id);
        return $this->view_('user.show', [
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

        return $this->view_('user.update', [
            'object'=>$user,
            'groupes'=>$groupes
        ]);
    }

    public function profile()
    {
        $user = User::findOrFail(auth()->user()->id);

        return $this->view_('user.profile', [
            'object'=>$user,
        ]);
    }

    public function updateprofile(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $user->name = request('name');
        $user->email = request('email');
        $user->datebirth = request('datebirth');
        $user->adress = request('adress');
        $user->phone = request('phone');
        
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

        $user->save();

        return redirect()->route('userprofile');
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = request('name');
        $user->email = request('email');
        $user->datebirth = request('datebirth');
        $user->adress = request('adress');
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
