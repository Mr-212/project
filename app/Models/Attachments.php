<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Attachments extends BaseModel
{
    protected $table='attachments';

    protected $fillable = [
        'task_id','name', 'description',
    ];

    //--hasOne--//
    public function task(){
        return $this->belongsTo('\App\Models\Tasks');
    }

    public static function addFile($files,$id){

        if (!empty($files)) {
            foreach ($files as $file) {
                //$name=$file->getClientOriginalName() .'.'. $file->getClientOriginalExtension();

                $attachment = new Attachments();
                $attachment->task_id = $id;
                $attachment->name = $file->getClientOriginalName();
                $attachment->extention = $file->getClientOriginalExtension();
                $attachment->mime = $file->getMimeType();
                $attachment->size = $file->getSize();
                $attachment->save();
                //$file=\File::put($file);
                \Storage::disk('local')->put($file->getClientOriginalName(), \File::get($file));

            }
        }

    }
}
