<?php

namespace Oubtou\Translator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Oubtou\Translator\Translator;

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
    public function index()
    {

    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Translator::update');
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $rqst)
    {        
        $this->validate(request(), [
            'name' => 'required|string',
        ]);

        $module = new Translator();

        $module->name = $rqst->name;
        $module->description = $rqst->description;
        $module->fields = $rqst->fields;


        dd($module);

        $module->migration();

        return redirect()->back();
    }
}
