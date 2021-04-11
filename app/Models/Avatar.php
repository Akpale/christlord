<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $guarded=[];

    // un avatar appartient à un seul utilisateur
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
