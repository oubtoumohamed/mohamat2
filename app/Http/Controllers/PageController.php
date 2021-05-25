<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    public $model = 'page';
    public function filter_fields(){
        return [
            'titre'=>[
                'type'=>'text'
            ],
            'link'=>[
                'type'=>'text'
            ]
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $pages = Page::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));
        return $this->view_('page.list', [
            'results'=>$pages
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('page.update',[
            'object'=> new Page(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $this->validate(request(), [
            'titre' => 'required|string|max:255',
        ]);

        $page = Page::create([
            'titre'=>request('titre'),
            'link'=> $this->slugify('pages', 'link', request('titre'), '-') ,
            'contenu'=>request('contenu'),
        ]);
       

       return redirect()
                ->route('page_edit', $page->id)
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
        $page = Page::findOrFail($id);

        return $this->view_('page.update', [
            'object'=>$page,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'titre' => 'required|string|max:255'
        ]);
      
        $page = Page::findOrFail($id);

        $page->titre = request('titre');
        //$page->link =  $this->slugify('pages', 'link', request('titre'), '-');
        $page->contenu = request('contenu');

        $page->save();

        return redirect()
                ->route('page_edit', $page->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $page = Page::findOrFail($id);

        if( $page->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('page')
            ->with($flash_type, __('global.'.$msg));
    }


    public function front($link)
    {
        $page = Page::where('link','=',$link)->firstOrFail();;
        return $this->view_('frontend.page.page', [
            'object'=>$page,
        ]);
    }
}