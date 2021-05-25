<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model 
{
    protected $fillable = [
        'title','date','state',
    ];

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('todo_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    
    public function gettitle(){ return $this->title; }
    public function getdate(){ return $this->date; }

    public function getstate(){ return $this->state ? __('todo.complete') :  __('todo.noncomplete'); }
    public function states(){ 
        return [
            0 => __('todo.noncomplete'),
            1 => __('todo.complete'),
        ]; 
    }

}
