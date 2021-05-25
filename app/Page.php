<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = ['titre','link','contenu'];

    public function __toString(){
        return ( $this->id ) ? $this->titre  : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('page_edit',$this->id).'" target="_blank">'.$this->titre.'</a>' : "";
    }

    public function gettitre(){
        return $this->titre;
    }

    public function getcontenu(){
        return $this->contenu;
    }

    public function getlink(){
        return ( $this->id ) ? '<a href="'.route('page_front',$this->link).'">'.$this->link.'</a>' : "";
    }
}
