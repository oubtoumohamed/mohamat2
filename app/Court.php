<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Court extends Model 
{
    protected $fillable = [
        'country','state','city','courtcategorie_id','location','name','room_number','description',
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('court_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getcountry(){ return $this->country; }
    public function getstate(){ return $this->state; }
    public function getcity(){ return $this->city; }

    public function getcourtcategorie_id(){ return $this->rel_categorie; }
    public function rel_categorie(){ 
        return $this->belongsTo('App\Courtcategorie','courtcategorie_id','id'); 
    }

    public function getlocation(){ return $this->location; }
    public function getname(){ return $this->name; }
    public function getroom_number(){ return $this->room_number; }
    public function getdescription(){ return $this->description; }

}
