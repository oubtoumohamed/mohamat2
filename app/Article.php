<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $fillable = [
        'titre','contenu','categorie','auteur','lien','info','image'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->titre : "";
    }
   	
    public function gettitre(){
        return $this->titre;
    }

    public function categorieRelation(){
        return $this->belongsTo('App\Categorie','categorie','id');
    }
    
    public function getcategorie(){
        return $this->categorieRelation->__toHtml();
    }
    
    public function categorie(){
        return $this->categorieRelation->__toString();
    }
    
    public function getcontenu(){
        return $this->contenu;
    }
    
    public function getinfo(){
        return $this->info;
    }
    
    public function getcreated_at(){
        return $this->created_at;
    }
    
    public function getDate(){
        $dt = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);

        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
    

        return $months[$dt->format('M')] . "<span>". $dt->format('d')."</span>". $dt->format('Y');
    }
    
    public function getDate2(){
        $dt = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);

        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
    

        return $dt->format('d') . "-". $dt->format('m')."-". $dt->format('Y');
    }
    
    public function createdBy(){
        return $this->belongsTo('App\User','auteur','id');
    }
    
    public function getauteur(){
        return $this->createdBy->__toHtml();
    }

    public function imageRelation(){
        return $this->belongsTo('App\Media','image','id');
    }

    public function getImage(){
        return ($this->imageRelation) ? $this->imageRelation->picture() : "";
    }

    public function getImageLink(){
        return ($this->imageRelation) ? $this->imageRelation->link() : asset('no_image.jpg');
    }

    public function getexcerpt( $length = 80 ) {
        $more = '...';
        $excerpt = strip_tags( trim( $this->contenu  ) );
        $words = str_word_count( $excerpt, 2 );
        
        return substr($excerpt, 0, 200) . $more;

        /*if ( count( $words ) > $length ) {
            $words = array_slice( $words, 0, $length, true );
            end( $words );
            //$position = key( $words ) + strlen( current( $words ) );
            //$excerpt = substr( $excerpt, 0, $position ) . $more;
        }
        return $excerpt;*/
    }
}
