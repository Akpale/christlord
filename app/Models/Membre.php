<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

   protected $fillable = [
   	    'groupe_id',
        'civilite',
        'nom',
        'prenoms',
        'email',
        'date_naissance',
        'profession',
        'contact',
        'email',
    ];

    public function groupe(){
        return $this->belongsTo(Groupe::class,'groupe_id');
    }

    public function photo(){
        return $this->hasOne(Photo::class);
    }
}
