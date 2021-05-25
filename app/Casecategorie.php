<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casecategorie extends Model 
{
    protected $fillable = [
        'name','description',
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('casecategorie_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }
    
    public function getname(){ return $this->name; }
    public function getdescription(){ return $this->description; }

}
