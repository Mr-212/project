<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Tasks extends BaseModel
{
    protected $table='tasks';

    protected $fillable = [
        'name', 'sprint_id','user_id'
    ];

    public function sprint(){
        return $this->belongsTo('\App\Models\Sprints');
    }
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }

    public function attachments(){
        return $this->hasMany('\App\Models\Attachments','task_id');
    }

}
