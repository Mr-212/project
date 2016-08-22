<?php namespace App\Models\Type;

class Type  extends \Illuminate\Database\Eloquent\Model{
   protected static $records = [];
   
   public function __construct($data){
          if(!empty($data)){
              //dd($data);
              foreach($data as $key=>$value){
                  $this->$key=$value;
              }
          }
      }
   
   
   public static function getList($whitespaces=false){
       
       $return=$whitespaces? [''=>''] : [];    
       foreach(static::$records as $record){
           $return[$record['id']] = $record['name'];
       }
       return $return;
   }
   
   public static function find($id){
       if(array_key_exists($id, static::$records))
       return new static(static::$records[$id]);
       return null;
       
      
       
   
   }
}

