<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{
    protected $fillable = [
        'name','mobile','email','description','contactcategorie_id',
    ];
    
    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('contact_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }
    
    public function getname(){ return $this->name; }
    public function getmobile(){ return $this->mobile; }
    public function getemail(){ return $this->email; }
    public function getdescription(){ return $this->description; }
    public function getcontactcategorie_id(){ return $this->categorie; }
    public function categorie(){ return $this->belongsTo('App\Contactcategorie','contactcategorie_id','id'); }

}
