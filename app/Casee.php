<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Casee extends Model 
{
    protected $fillable = [
        'number','filenumber','acts','plaintiff','accuesed','behalfof','court_id','categorie_id','refname','refmobile','lawyer_id','stage_id','receiving_date','filing_date','hearing_date','judgement_date','description','media_id',
    ];

    //protected $table = 'cases';

    public function __toString(){
        return $this->number;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('case_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getnumber(){ return $this->number; }
    public function getfilenumber(){ return $this->filenumber; }
    public function getactsstring(){ 
        $str = "";

        foreach ($this->getacts() as $act) {
            $str .= $act->__toHtml() . ', ';
        }

        return $str;
    }
    public function getacts(){ 
        if( !$this->acts )
            return [];

        $acts = Act::whereIn('id', explode(',', $this->acts))
                    ->get();

        return $acts;
    }
    public function getactsArray(){ 
        return explode(',', $this->acts);
    }

    public function getplaintiff(){ return $this->rel_plaintiff; }

    public function rel_plaintiff(){ 
        return $this->belongsTo('App\Client','plaintiff','id'); 
    }

    public function getaccuesed(){ return $this->rel_accuesed; }

    public function rel_accuesed(){ 
        return $this->belongsTo('App\Client','accuesed','id'); 
    }

    public function getbehalfof(){ return $this->behalfof; }

    public function getcourt_id(){ return $this->rel_court; }

    public function rel_court(){ 
        return $this->belongsTo('App\Court','court_id','id'); 
    }

    public function getcategorie_id(){ return $this->rel_categorie; }
    public function rel_categorie(){ 
        return $this->belongsTo('App\Casecategorie','categorie_id','id'); 
    }

    public function getrefname(){ return $this->refname; }
    public function getrefmobile(){ return $this->refmobile; }
    public function getlawyer_id(){ return $this->rel_lawyer; }
    public function rel_lawyer(){ 
        return $this->belongsTo('App\Lawyer','lawyer_id','id'); 
    }

    public function getstage_id(){ return $this->rel_stage; }
    public function rel_stage(){ 
        return $this->belongsTo('App\Stage','stage_id','id'); 
    }

    public function getreceiving_date(){ return $this->receiving_date; }
    public function getfiling_date(){ return $this->filing_date; }
    public function gethearing_date(){ return $this->hearing_date; }
    public function getjudgement_date(){ return $this->judgement_date; }
    public function getdescription(){ return $this->description; }

    public function getmedia_id(){ return $this->media_id; }
    public function rel_media(){ 
        return $this->belongsTo('App\Media','media_id','id'); 
    }

}
