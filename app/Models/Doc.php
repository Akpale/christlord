<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function fichier(){
    	return $this->belongsTo(Fichier::class);
    }
}
