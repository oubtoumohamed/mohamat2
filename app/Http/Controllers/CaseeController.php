<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Casee;
use App\Act;
use App\Client;
use App\Clientcategorie;
use App\Court;
use App\Casecategorie;
use App\Lawyer;
use App\Stage;
use App\Media;

class CaseeController extends Controller
{
    public $model = 'casee';
    public function filter_fields(){
        return [
            'number'=>[ 'type'=>'text' ],
            'filenumber'=>[ 'type'=>'text' ],
            'plaintiff'=>[ 
                'type'=>'select',
                'table'=>'clients',
            ],
            'accuesed'=>[ 
                'type'=>'select',
                'table'=>'clients',
            ],
            'court_id'=>[ 
                'type'=>'select',
                'table'=>'courts',
            ],
            'categorie_id'=>[ 
                'type'=>'select',
                'table'=>'casecategories',
            ],
            'refname'=>[ 'type'=>'text' ],
            'refmobile'=>[ 'type'=>'text' ],
            'lawyer_id'=>[ 
                'type'=>'select',
                'table'=>'lawyers',
            ],
            'stage_id'=>[ 
                'type'=>'select',
                'table'=>'stages',
            ],

        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $casees = Casee::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('casee.list', [
            'results'=>$casees
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $acts = Act::all();
        $clients = Client::all();
        $clientcategories = Clientcategorie::all();
        $courts = Court::all();
        $casecategories = Casecategorie::all();
        $lawyers = Lawyer::all();
        $stages = Stage::all();

        return $this->view_('casee.update',[
            'object'=> new Casee(),
            'acts'=> $acts,
            'clients'=> $clients,
            'clientcategories'=> $clientcategories,
            'courts'=> $courts,
            'casecategories'=> $casecategories,
            'lawyers'=> $lawyers,
            'stages'=> $stages,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->validate(request(), [ ]);

        //dd($request);

        $casee = Casee::create([
            'number'=>request('number'),
            'filenumber'=>request('filenumber'),
            'acts'=>implode(',', request('acts')),
            'plaintiff'=>request('plaintiff'),
            'accuesed'=>request('accuesed'),
            'behalfof'=>request('behalfof'),
            'court_id'=>request('court_id'),
            'categorie_id'=>request('categorie_id'),
            'refname'=>request('refname'),
            'refmobile'=>request('refmobile'),
            'lawyer_id'=>request('lawyer_id'),
            'stage_id'=>request('stage_id'),
            'receiving_date'=>request('receiving_date'),
            'filing_date'=>request('filing_date'),
            'hearing_date'=>request('hearing_date'),
            'judgement_date'=>request('judgement_date'),
            'description'=>request('description'),

        ]);

        $media = new Media();
        if($request->file('media_id')){
            $media->_file = $request->file('media_id');
            $media->_path = 'Casee';
            $media = $media->_save();

            if($media){
                $casee->media_id = $media->id;
                $casee->save();
            }
        }

       return redirect()
                ->route('casee_edit', $casee->id)
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
        $casee = Casee::findOrFail($id);

        $acts = Act::all();
        $clients = Client::all();
        $clientcategories = Clientcategorie::all();
        $courts = Court::all();
        $casecategories = Casecategorie::all();
        $lawyers = Lawyer::all();
        $stages = Stage::all();

        //dd($casee->getacts());

        return $this->view_('casee.update', [
            'object'=>$casee,
            'acts'=> $acts,
            'clients'=> $clients,
            'clientcategories'=> $clientcategories,
            'courts'=> $courts,
            'casecategories'=> $casecategories,
            'lawyers'=> $lawyers,
            'stages'=> $stages,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$this->validate(request(), [ ]);
      
        $casee = Casee::findOrFail($id);

        $casee->number=request('number');
        $casee->filenumber=request('filenumber');
        $casee->acts= implode(',', request('acts'));
        $casee->plaintiff=request('plaintiff');
        $casee->accuesed=request('accuesed');
        $casee->behalfof=request('behalfof');
        $casee->court_id=request('court_id');
        $casee->categorie_id=request('categorie_id');
        $casee->refname=request('refname');
        $casee->refmobile=request('refmobile');
        $casee->lawyer_id=request('lawyer_id');
        $casee->stage_id=request('stage_id');
        $casee->receiving_date=request('receiving_date');
        $casee->filing_date=request('filing_date');
        $casee->hearing_date=request('hearing_date');
        $casee->judgement_date=request('judgement_date');
        $casee->description=request('description');

        $media = Media::find( $casee->media_id );

        if( !$media && ! $media->id )
            $media = new Media();

        if($request->file('media_id')){
            $media->_file = $request->file('media_id');
            $media->_path = 'Casee';
            $media = $media->_save();

            if($media){
                $casee->media_id = $media->id;
            }
        }

        $casee->save();

        return redirect()
                ->route('casee_edit', $casee->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $casee = Casee::findOrFail($id);

        if( $casee->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('casee')
            ->with($flash_type, __('global.'.$msg));
    }
}