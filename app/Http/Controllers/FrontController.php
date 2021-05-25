<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EtudientController;
use App\Article;
use App\Categorie;
use App\Slider;
use App\Service;
use App\Team;
use Illuminate\Support\Facades\File;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        \Session::put('applocale', 'ar');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $articles = Article::limit(12)->orderBy('id', 'desc')->get();
        $sliders = Slider::limit(4)->orderBy('id', 'desc')->get();
        $categories = Categorie::all();
        $services = Service::all();
        $teams = Team::all();

        return $this->view_('frontend.home',[
            'articles'=>$articles,
            'categories'=>$categories,
            'sliders'=>$sliders,
            'services'=>$services,
            'teams'=>$teams
        ]);
    }

    public function articles(Request $request)
    {
        $articles = Article::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate(12);

        $categories = Categorie::all();

        return $this->view_('frontend.article.all',[
            'articles'=>$articles,
            'categories'=>$categories
        ]);
    }

    public function cat_articles(Request $request, $label)
    {
        $categorie = Categorie::where('label',$label)->firstOrFail();

        $articles = Article::where('categorie', $categorie->id)
                        ->orderBy($this->orderby, 'desc')->paginate(12);

        $categories = Categorie::all();

        return $this->view_('frontend.article.all',[
            'articles'=>$articles,
            'categories'=>$categories
        ]);
    }

    
    public function article($lien)
    {
        $article = Article::where('lien',$lien)->firstOrFail();

        return $this->view_('frontend.article.article',[
            'article'=>$article
        ]);
    }


    public function admin()
    {
        return $this->view_('home');
    }


    // setting


    /*
     * Display a listing of the resource.
     */
    public function scan_path( $path, &$modules){
        foreach ( scandir($path) as $mdl) {
            if( $mdl != '.' && $mdl != '..'  ){
                $mdl =  str_replace('.php', '', $mdl);
                $modules[ $mdl ] = $mdl;
            }
        }

        return $modules;
    }

    public function get_file_data( $path ){
        $data = [];
        if( file_exists($path) ) {
            $contents = File::get($path);

            $contents = str_replace("<?php", '', $contents);
            $contents = str_replace('return ', '$data = ', $contents);

            eval($contents);
        }

        return $data;
    }

    public function setting(Request $rqst)
    {
        $data = [];
        $modules = [];

        $lang = "ar";
        $module = "setting";
        
        $path = app_path('../resources/lang/');

        if( $lang ){
            $this->scan_path($path.$lang , $modules);
            $modules[] = '-----------------';
        }
        
        $this->scan_path($path.'en', $modules);

        //dd($modules);

        if( $lang && $module ){
            $path = app_path('../resources/lang/'.$lang.'/'.$module.'.php');
            $data = $this->get_file_data($path);

            $path = app_path('../resources/lang/en/'.$module.'.php');
            $sourcedata = $this->get_file_data($path);

            foreach ($sourcedata as $key => $value) {
                if( !array_key_exists($key, $data) )
                    $data[ $key ] = $value;
            }

        }

        //File::put($path, $contents);

        return $this->view_('frontend.setting',[
            'data'=>$data,
            'modules'=>$modules,
            'lang'=>$lang,
            'module'=>$module,
        ]);

    }


    public function store()
    {
        $lang = 'ar';
        $module = 'setting';
        $trans = request('trans');
        $fields = request('fields');

        if( $lang and $module and count($trans) ){

            $path = app_path('../resources/lang/'.$lang.'/'.$module.'.php');
            $en_path = app_path('../resources/lang/en/'.$module.'.php');
            $contents = "<?php \n return [ \n";

            foreach ($trans as $key => $value) {
                $contents .= "'$key'=>'$value', \n";
            }

            if( $fields ){
                foreach ($fields as $k => $v) {
                    $contents .= "'".$v['key']."'=>'".$v['value']."', \n";
                }
            }

            $contents .= "\n];";

            File::put($en_path, $contents);
            File::put($path, $contents);
        }

        return redirect()
                ->route('front_setting' )
                ->with('success', __('global.create_succees'));

    }

}
