<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model 
{
    protected $fillable = [
        'name','mobile','description',
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('lawyer_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }
    
    public function getname(){ return $this->name; }
    public function getmobile(){ return $this->mobile; }
    public function getdescription(){ return $this->description; }

}
