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

    public static function UserSprints($id){
        //dd($id);
        return \DB::select(\DB::raw("select s.*,p.name as projectname from projects p inner join sprints s on p.id=s.project_id
                              inner join tasks t on  s.id=t.sprint_id where t.user_id=:id"),['id'=>$id]);
    }

}
