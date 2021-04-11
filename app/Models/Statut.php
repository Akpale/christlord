<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    use HasFactory;

    protected $fillable = [
        'statut',
    ];

    // un statut concerne un ou plusieurs users
    public function user(){
        return $this->hasMany(User::class);
    }
}
