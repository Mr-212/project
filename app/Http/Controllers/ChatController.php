<?php namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;



class ChatController extends Controller{


//    public $redis;
//
//    public function __construct($redis){
//        $this->$redis=Redis::connection();
//    }


    public function getIndex(){
        return view('partials.chat');
    }

    public function postSendmessage(){

        $msg=Input::get('value');
        //dd($msg);


        $name = \Auth::user()->name;
        $data=['message' => $msg, 'username' => $name.': '];

        $redis=\Redis::connection();
        $redis->publish('message', json_encode($data));
        return response()->json([]);
    }

    public function getJoin(){
        //$redis=Redis::connection();
        //dd($redis);
        $data=['name'=>\Auth::user()->name,'id'=>\Auth::id()];
        //$redis->publish('message', json_encode($data));
        return response()->json($data);

    }






    
   
    
    

}
