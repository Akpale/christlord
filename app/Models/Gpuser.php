<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpuser extends Model
{
    use HasFactory;

     protected $fillable = [
        'profil',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
