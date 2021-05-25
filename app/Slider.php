<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	protected $fillable = ['titre','contenu','description','link','image'];

    public function __toString(){
        return ( $this->id ) ? $this->titre  : "";
    }


    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('slider_edit',$this->id).'" target="_blank">'.$this->titre.'</a>' : "";
    }


    public function gettitre(){
        return $this->titre;
    }

    public function getcontenu(){
        return $this->contenu;
    }

    public function getdescription(){
        return $this->description;
    }

    public function imageRelation(){
        return $this->belongsTo('App\Media','image','id');
    }

    public function getImage(){
        return ($this->imageRelation) ? $this->imageRelation->picture() : "";
    }

    public function getImageLink(){
        return ($this->imageRelation) ? $this->imageRelation->link() : "";
    }

    public function getlink(){
        return ( $this->id ) ? '<a href="'.route('slider_front',$this->link).'">'.$this->link.'</a>' : "";
    }


}
