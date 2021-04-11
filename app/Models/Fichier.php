<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;
   
    protected $guarded=[];

    public function groupe(){
    	return $this->belongsTo(Groupe::class,'groupe_id');
    }

    public function doc(){
        return $this->hasOne(Doc::class,'doc_id');
    }
}
