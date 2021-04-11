<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
     
     //protected $guarded = [];

     protected $fillable = [
        'libelle',
    ];

     // dans un departement il peut avoir plusieurs users
    public function user(){
        return $this->hasMany(User::class,'user_id');
    }

     // pour un departement on a un seul groupe 
    public function groupe(){
        return $this->hasOne(Groupe::class,'groupe_id');
    }
}
