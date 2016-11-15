<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Type\User as TypeUser;

class User extends Authenticatable
{

    protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    public function project(){
//        return $this->belongsToMany('\App\Models\Projects','project_users');
//    }

    //--hasOne--//

    public function company(){
        return $this->belongsTo('\App\Models\Company');
    }
    //--hasMany fk in task--//
    public function tasks(){
        return $this->hasMany('\App\Models\Tasks');
    }

    public function getTypeAttribute(){
        return TypeUser::find($this->user_type)->name;
    }
}
