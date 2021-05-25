<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model 
{
    protected $fillable = [
        'title','contact_id','date','motive','note',
    ];

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('appointment_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }
    
    public function gettitle(){ return $this->title; }
    public function getcontact_id(){ return $this->contact; }
    public function contact(){ return $this->belongsTo('App\Contact','contact_id','id'); }
    public function getdate(){ return $this->date; }
    public function getmotive(){ return $this->motive; }
    public function getnote(){ return $this->note; }

}
