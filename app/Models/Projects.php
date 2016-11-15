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

    public function member(){
        return $this->hasMany('\App\Models\Members','project_id');
    }
     public static function Userprojects($id){
         //dd($id);
         return \DB::select(\DB::raw("select p.* from projects p inner join sprints s on p.id=s.project_id
                              inner join tasks t on  s.id=t.sprint_id where t.user_id=:id"),['id'=>$id]);
     }

}
