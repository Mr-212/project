<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type\TaskStatus;

class Tasks extends BaseModel
{
    protected $table='tasks';

    protected $fillable = [
        'name', 'sprint_id','user_id','status','project_id'
    ];
    protected $appends=['expiry','taskstatus'];

    public function user(){
        return $this->belongsTo('\App\Models\User','user_id');
    }
    public function sprint(){
        return $this->hasOne('\App\Models\Sprints','id','sprint_id');
    }
    public function project(){
            return $this->belongsTo('\App\Models\Projects','project_id');
        }

    public function attachments(){
        return $this->hasMany('\App\Models\Attachments','task_id');
    }

    public function getTaskStatusAttribute(){
        return TaskStatus::find($this->status)->name;
    }

    public function getExpiryAttribute(){
            if($this->status==TaskStatus::EXPIRED ) {
                return  date('y-m-d', strtotime($this->task_end));
            }
            if($this->status==TaskStatus::CLOSED ) {
                return  date('y-m-d', strtotime($this->closed_at));
            }
            else {
                    $task_end = new \DateTime($this->task_end);
                    $date = $task_end->diff(new \DateTime());
                    return $date->format('Month:%m Days:%d Hour:%H: Minutes:%i Seconds:%s');

            //return $date->d . " days\n " . $date->h ."hours: " . $date->m ."month: " . $date->s;
        }
    }
    public static function Projectmembers($id){
        //dd($id);
        return \DB::select(\DB::raw("select u.* from users u inner join members m on u.id=m.user_id
                            inner join projects p on p.id=m.project_id
                            inner join sprints s on p.id=s.project_id
                            inner join tasks t on  s.id=t.sprint_id where t.id=:id "),['id'=>$id]);
    }




}
