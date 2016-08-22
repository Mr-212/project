<?php

namespace App\Models\Type;

class TaskStatus extends Type {
   const ALL        = -1;
   
   const OPEN    =  1;
   const CLOSED  =  2;
   const EXPIRED =  3;
   
   protected static $records = [
       SELF::OPEN    =>['id'=>SELF::ADMIN,      'name'=>'Open'      ],
       SELF::CLOSED  =>['id'=>SELF::CLOSED,     'name'=>'Closed'    ],
       SELF::EXPIRED =>['id'=>SELF::EXPIRED,    'name'=>'Expired'   ],
   ];
    
}
