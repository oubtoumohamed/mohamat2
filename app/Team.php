<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model 
{
    protected $fillable = [
        'name','picture','description',
    ];

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('team_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getname(){ return $this->name; }
    public function getpicture(){ 
    	return $this->picture__rel ? $this->picture__rel->picture() : '';
    }
    public function getdescription(){ return $this->description; }


    public function picture__rel(){
        return $this->belongsTo('App\Media','picture','id');
    }
    public function getavatarfulllink(){
        return $this->picture__rel ? $this->picture__rel->link() : '';
    }

}
