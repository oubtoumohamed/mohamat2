<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model 
{
    protected $fillable = [
        'title','user_id','location','start_date','end_date','description',
    ];

    public function __toString(){
        return $this->title;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('event_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function gettitle(){ return $this->title; }
    public function getuser_id(){ return $this->user; }
    public function user(){ return $this->belongsTo('App\User','user_id','id'); }
    public function getlocation(){ return $this->location; }
    public function getstart_date(){ return $this->start_date; }
    public function getend_date(){ return $this->end_date; }
    public function getdescription(){ return $this->description; }

}
