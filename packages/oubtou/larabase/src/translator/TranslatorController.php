<?php

namespace Oubtou\Larabase\Translator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Oubtou\Larabase\Translator\Translator;
use Illuminate\Support\Facades\File;

class TranslatorController extends Controller
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

    public function create(Request $rqst, $lang, $module)
    {
        $data = [];
        $modules = [];
        
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

        return $this->view_('Translator::update',[
            'data'=>$data,
            'modules'=>$modules,
            'lang'=>$lang,
            'module'=>$module,
        ]);

    }


    public function store()
    {

        $lang = request('lang');
        $module = request('module');
        $trans = request('trans');
        $fields = request('fields');

        if( $lang and $module and count($trans) ){

            $path = app_path('../resources/lang/'.$lang.'/'.$module.'.php');
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

            File::put($path, $contents);
        }

        return redirect()
                ->route('translator_create', [$lang, $module] )
                ->with('success', __('global.create_succees'));

    }


}
