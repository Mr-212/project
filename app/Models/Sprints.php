<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Sprints extends BaseModel
{
    protected $table='sprints';

    protected $fillable = [
        'name', 'project_id',
    ];

    public function project(){
        return $this->belongsTo('\App\Models\Projects');
    }
    public function tasks(){
        return $this->hasMany('\App\Models\tasks','sprint_id');
    }

}
