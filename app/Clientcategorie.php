<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientcategorie extends Model 
{
    protected $fillable = [
        'name','description','behalf_plaintiff',
    ];
    
    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('clientcategorie_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getname(){ return $this->name; }
    public function getdescription(){ return $this->description; }
    public function getbehalf_plaintiff(){ return __('global.bool'.$this->behalf_plaintiff); }

}
