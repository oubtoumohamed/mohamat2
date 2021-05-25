<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model 
{
    protected $fillable = [
        'user_id','leavetype_id','days','state',
    ];

    public function __toString(){
        return $this->id;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('leave_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function getuser_id(){ return $this->user; }
    public function user(){ return $this->belongsTo('App\User','user_id','id'); }

    public function getleavetype_id(){ return $this->type; }
    public function type(){ return $this->belongsTo('App\Leavetype','leavetype_id','id'); }

    public function getdays(){ return $this->days; }
    public function getstate(){ return $this->state ? __('leave.accepted') :  __('leave.refused'); }
    public function states(){ 
        return [
            1 => __('leave.accepted'),
            0 => __('leave.refused'),
        ]; 
    }

}
