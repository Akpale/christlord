<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $guarded=[];


    public function membre(){
        return $this->belongsTo(Membre::class,'membre_id');
    }
}
