<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'departement_id',
        'gpusers_id',
        'statut_id',
        'name',
        'pseudo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // un utilisateur à un seul avatar
    public function avatar(){
        return $this->hasOne(Avatar::class);
    }

// un user à un seul profil
    public function gpuser(){
        return $this->belongsTo(Gpuser::class,'gpusers_id');
    }

// un user à un seul statut
    public function statut(){
        return $this->belongsTo(Statut::class,'statut_id');
    }

    // un user à un seul groupe
    //public function groupe(){
        //return $this->belongsTo(Groupe::class);
    //}

    // un user à un seul departement
    public function departement(){
        return $this->belongsTo(Departement::class,'departement_id');
    }

}
