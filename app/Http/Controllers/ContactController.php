<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contact;
use App\Contactcategorie;

class ContactController extends Controller
{
    public $model = 'contact';
    public function filter_fields(){
        return [
            'name'=>[ 'type'=>'text' ],
            'mobile'=>[ 'type'=>'text' ],
            'email'=>[ 'type'=>'text' ],
            'description'=>[ 'type'=>'text' ],
            'contactcategorie_id'=>[ 
                'type'=>'select',
                'table'=>'contactcategories',
            ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $contacts = Contact::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('contact.list', [
            'results'=>$contacts
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Contactcategorie::all();
        return $this->view_('contact.update',[
            'object'=> new Contact(),
            'categories'=>$categories
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        $contact = Contact::create([

            'name'=>request('name'),
            'mobile'=>request('mobile'),
            'email'=>request('email'),
            'description'=>request('description'),
            'contactcategorie_id'=>request('contactcategorie_id'),

        ]);

       return redirect()
                ->route('contact_edit', $contact->id)
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
        $contact = Contact::findOrFail($id);
        $categories = Contactcategorie::all();

        return $this->view_('contact.update', [
            'object'=>$contact,
            'categories'=>$categories,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $contact = Contact::findOrFail($id);

        $contact->name=request('name');
        $contact->mobile=request('mobile');
        $contact->email=request('email');
        $contact->description=request('description');
        $contact->contactcategorie_id=request('contactcategorie_id');

        $contact->save();

        return redirect()
                ->route('contact_edit', $contact->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $contact = Contact::findOrFail($id);

        if( $contact->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('contact')
            ->with($flash_type, __('global.'.$msg));
    }
}