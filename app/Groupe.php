<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model 
{
    protected $fillable = [
        'name','roles'
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('groupe_edit',$this->id).'" target="_blank">'.$this->name.'</a>' : "";
    }

    public function getname(){
        return $this->name;
    }
    public function getroles(){
        return $this->roles;
    }

    public function users(){
        return $this->hasMany('User','usergroupe','groupe_id');
    }
    
    public function get__roles(){
        return array(
            'ACT' => 'Act',
            'APPOINTMENT' => 'Appointment',
            'CASECATEGORIE' => 'Casecategorie',
            'CASEE' => 'Casee',
            'CLIENT' => 'Client',
            'CLIENTCATEGORIE' => 'Clientcategorie',
            'CONTACT' => 'Contact',
            'CONTACTCATEGORIE' => 'Contactcategorie',
            'COURT' => 'Court',
            'COURTCATEGORIE' => 'Courtcategorie',
            'EVENT' => 'Event',
            'LAWYER' => 'Lawyer',
            'LEAVETYPE' => 'Leavetype',
            'STAGE' => 'Stage',
            'TASK' => 'Task',
            'TODO' => 'Todo',
        );
    }
}
