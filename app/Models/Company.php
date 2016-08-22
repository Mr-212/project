<?php
namespace App\Models;

class Company extends \App\Models\BaseModel{
    
    protected $table="company";
    
    protected $fillable=['name','address','address2','city','postal_code','phone','fax'];
    
//    public function getTypeAttribute(){
//        return App\Models\Type\FormFields::find($this->user_type_id);
//    }
    
    public function province(){
        return $this->belongsTo('\App\Models\Province');
    }
    
    public function getFullAddressAttribute()
    {
        $province = $this->province->country_id == 250 ? $this->province->abbr : $this->province->name;
        if ($this->address2) {
            return "{$this->address}, {$this->address2}, {$this->city}, {$province}, {$this->postal_code}";
        } else {
            return "{$this->address}, {$this->city}, {$province}, {$this->postal_code}";
        }
    }

        public function users(){
            return $this->hasMany('App\Models\User');
        }


    
}

