<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{
    protected $fillable = [
        'name','mobile','email','gender','country','state','city','adress','description','clientcategorie_id',
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('client_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getname(){ return $this->name; }
    public function getmobile(){ return $this->mobile; }
    public function getemail(){ return $this->email; }
    public function getgender(){ return $this->gender ? __('client.man') : __('client.women'); }
    public function getcountry(){ return $this->country; }
    public function getstate(){ return $this->state; }
    public function getcity(){ return $this->city; }
    public function getadress(){ return $this->adress; }
    public function getdescription(){ return $this->description; }
    public function getclientcategorie_id(){ return $this->categorie; }
    public function categorie(){ return $this->belongsTo('App\Clientcategorie','clientcategorie_id','id'); }

}
