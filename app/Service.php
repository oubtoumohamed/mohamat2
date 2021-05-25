<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model 
{
    protected $fillable = [
        'name','icon','description',
    ];

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('service_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getname(){ return $this->name; }
    public function geticon(){ return $this->icon; }
    public function getdescription(){ return $this->description; }

}
