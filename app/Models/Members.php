<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Members extends BaseModel
{
    protected $table='members';

    protected $fillable = [
        'user_id', 'project_id',
    ];

//    public function user(){
//        return $this->belongsToMany('\App\Models\Users','project_users');
//    }
//     public static function Userprojects($id){
//         //dd($id);
//         return \DB::select(\DB::raw("select p.* from projects p inner join sprints s on p.id=s.project_id
//                              inner join tasks t on  s.id=t.sprint_id where t.user_id=?"),[$id]);
//     }
    public function user(){

         return $this->belongsTo('\App\Models\User','user_id');
     }
}
