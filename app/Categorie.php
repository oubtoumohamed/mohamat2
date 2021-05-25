<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
	protected $fillable = ['label'];

    public function getlabel(){
        return $this->label;
    }

    public function __toString(){
        return ( $this->id ) ? $this->label  : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('categorie_edit',$this->id).'" target="_blank">'.$this->label.'</a>' : "";
    }
}
