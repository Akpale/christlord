<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

     protected $guarded=[];

    // dans un groupe il peut avoir plusieurs users
    //public function user(){
        //return $this->hasMany(User::class);
    //}
   // pour un groupe on a un seul departement 
    public function departement(){
    	return $this->belongsTo(Departement::class,'departement_id');
    }

    public function membre(){
        return $this->hasMany(Membre::class);
    }

    public function fichier(){
        return $this->hasMany(Fichier::class);
    }
}
