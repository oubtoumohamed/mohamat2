<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model 
{
    protected $fillable = [
        'name','case_id','user_id','priority','stage_id','date','description',
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('task_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }
    
    public function getname(){ return $this->name; }
    public function getcase_id(){ return $this->case; }
    public function case(){ return $this->belongsTo('App\Casee','case_id','id'); }

    public function getuser_id(){ return $this->assignee; }
    public function assignee(){ return $this->belongsTo('App\User','user_id','id'); }

    public function getpriority(){ return __('task.'.$this->priority); }
    public function priorities(){ 
        return [
            'high'=> __('task.high'),
            'meduim'=> __('task.meduim'),
            'low'=> __('task.low'),
        ]; 
    }
    public function getstage_id(){ return $this->stage; }
    public function stage(){ return $this->belongsTo('App\Stage','stage_id','id'); }

    public function getdate(){ return $this->date; }
    public function getdescription(){ return $this->description; }

}
