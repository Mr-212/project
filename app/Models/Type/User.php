<?php

namespace App\Models\Type;

class User extends Type {
   const ALL        = -1;
   
   const ADMIN      =  1;
   const USER       =  2;
   const DISPATCHER =  3;
   
   protected static $records = [
       SELF::ADMIN      =>['id'=>SELF::ADMIN,      'name'=>'Admin'     ],
       SELF::USER       =>['id'=>SELF::USER,       'name'=>'User'      ],   
       SELF::DISPATCHER =>['id'=>SELF::DISPATCHER, 'name'=>'Dispatcher'],
   ];
    
}
