<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Categorie;
use App\Media;

class ArticleController extends Controller
{
    public $model = 'article';
    public function filter_fields(){
        return [
            'titre'=>[
                'type'=>'text'
            ],
            'info'=>[
                'type'=>'text'
            ],
            'created_at'=>[
                'type'=>'datepicker'
            ],
            'categorie'=>[
                'type'=>'select',
                'table'=>'categories',
                'fields' => ['id as key_','label as value_'],
            ],
            'auteur'=>[
                'type'=>'select',
                'table'=>'users',
                'fields' => ['id as key_','name as value_'],
            ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $articles = Article::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['article'=>null]));

        return $this->view_('article.list', [
            'results'=>$articles
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Categorie::all();

        return $this->view_('article.update',[
            'object'=> new Article(),
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avatar = null;

        $media = new Media();
        if($request->file('image')){
            $media->_file = $request->file('image');
            $media->_path = 'Article';
            $media = $media->_save();

            if($media)
                $avatar = $media->id;
        }

        $this->validate(request(), [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'categorie' => 'required|integer',
        ]);

        $article = Article::create([
            'titre'=>request('titre'),
            'info'=>request('info'),
            'lien'=>request('titre'),
            'contenu'=>request('contenu'),
            'auteur'=> auth()->user()->id,
            'categorie'=>request('categorie'),
            'image'=>$avatar,
        ]);
       

       return redirect()
                ->route('article_edit', $article->id)
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
        $article = Article::findOrFail($id);

        $users = User::all();

        $categories = Categorie::all();

        return $this->view_('article.update', [
            'object'=>$article,
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'categorie' => 'required|integer', 
        ]);
      
        $article = Article::findOrFail($id);

        $article->titre = request('titre');
        $article->info = request('info');
        $article->contenu = request('contenu');
        $article->categorie = request('categorie');

        $media = new Media();
        if($request->file('image')){
            $media->_file = $request->file('image');
            $media->_path = 'Article';
            $media = $media->_save();

            if($media)
                $article->image = $media->id;
        }

        $article->save();

        return redirect()
                ->route('article_edit', $article->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $article = Article::findOrFail($id);

        if( $article->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('article')
            ->with($flash_type, __('global.'.$msg));
    }
}