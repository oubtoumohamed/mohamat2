<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leavetype extends Model 
{
    protected $fillable = [
        'name','state',
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('leavetype_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getname(){ return $this->name; }
    public function getstate(){ return $this->state ? __('leavetype.active') :  __('leavetype.deactive'); }
    public function states(){ 
        return [
            1 => __('leavetype.active'),
            0 => __('leavetype.deactive'),
        ]; 
    }

}
