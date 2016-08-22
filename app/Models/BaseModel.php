<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function __construct(){

    }

    public function loadData($array){

        foreach($array as $k=>$v){
            if($this->isFillable($k)){
                $this->$k=$v;
            }
        }
    }


}
