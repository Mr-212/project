<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Projects extends BaseModel
{
    protected $table='projects';

    protected $fillable = [
        'name', 'description', 'team_members',
    ];

//    public function user(){
//        return $this->belongsToMany('\App\Models\Users','project_users');
//    }
}
