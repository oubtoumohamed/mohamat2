<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EtudientController;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = [];
        $modules = ['user','appointment','casee','client','contact','court','event','lawyer','leave','stage','task','todo'];
        $icons = ['user'=>'users','appointment'=>'target','casee'=>'award','client'=>'users','contact'=>'bookmark','court'=>'package','event'=>'calendar','lawyer'=>'flag','leave'=>'briefcase','stage'=>'layers','task'=>'check-square','todo'=>'list'];

        foreach ($modules as $module) {
            //
            $results[$module] = DB::table($module.'s')->count();
        }

        return $this->view_('home',[
            'results'=>$results,
            'icons'=>$icons,
        ]);
    }
   

    public function admin()
    {
        return $this->view_('home');
    }
    
}
